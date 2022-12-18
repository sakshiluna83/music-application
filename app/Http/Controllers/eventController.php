<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Genres;
use App\Models\artist;

use App\Models\User;
use DB;
use File;
use Storage;

class eventController extends Controller
{
    public function index(Request $request)
    {
        $artist = empty($request->artist) ? null : $request->artist;
        $venue = empty($request->venue) ? null : $request->venue;
        $genre = empty($request->genres) ? null : $request->genres;
        $date = empty($request->date) ? null : $request->date;
        $search = empty($request->search) ? null : $request->search;

        $events = events::when(!empty($artist), function ($query) use ($artist) {
            $query->where('artist', 'LIKE', '%' . $artist . '%');
        })->when(!empty($venue), function ($query) use ($venue) {
            $query->where('venue', 'LIKE', '%' . $venue . '%');
        })->when(!empty($genre), function ($query) use ($genre) {
            $query->where('genres', 'LIKE', '%' . $genre . '%');
        })->when(!empty($date), function ($query) use ($date) {
            $query->where('date', 'LIKE', '%' . $date . '%');
        })->when(!empty($search), function ($query) use ($search) {
            $query->where('artist', 'LIKE', '%' . $search . '%')
                ->orWhere('venue', 'LIKE', '%' . $search . '%')
                ->orWhere('genres', 'LIKE', '%' . $search . '%')
                ->orWhere('date', 'LIKE', '%' . $search . '%');
        })->paginate(4);
        $artist = events::getArtist();
        $venue = events::getVenue();
        $genres = events::getGenre();
        $date = events::getDate();

        $data['artist'] = @json_decode($artist, true);
        $data['genres'] = @json_decode($genres, true);
        $data['date'] = @json_decode($date, true);
        $data['venue'] = @json_decode($venue, true);

        return view('events', compact('events', 'data'));
    }
    public function listEvents(Request $request)
    {
        if ($request->all()) {
            $search = $request->search;
        }
        $user_id = Auth::id();
        $user_data = User::where('id', $user_id)->get();
        $events   = events::orderBy('date', 'desc')->get();
        $pagetitle  = 'Events List';

        return view('admin.listEvents', compact('events', 'pagetitle', 'user_data'));
    }

    public function EventDetails(Request $request, $id)
    {
        $pagetitle     = 'Event  Details';
        $eventDetail   = events::where('id', $id)->get();
        $eventss = '';
        if (isset($eventDetail[0]->id) != '' &&  is_int($eventDetail[0]->id)) {
            $eventss           = $eventDetail[0];
        }
        // print_r($eventss);
        return view('admin.addEvents', compact('eventss', 'pagetitle', 'id'));
    }
    public function listGenre(Request $request)
    {
        if ($request->all()) {
            $search = $request->search;
        }
        $user_id = Auth::id();
        $user_data = User::where('id', $user_id)->get();
        $genres   = Genres::orderBy('genres', 'desc')->get();
        $pagetitle  = 'Genres List';

        return view('admin.listGenre', compact('genres', 'pagetitle', 'user_data'));
    }

    public function listArtist(Request $request)
    {
        if ($request->all()) {
            $search = $request->search;
        }
        $user_id = Auth::id();
        $user_data = User::where('id', $user_id)->get();
        $artist   = artist::get();
        $pagetitle  = 'Artist List';

        return view('admin.listArtist', compact('artist', 'pagetitle', 'user_data'));
    }
    public function genreDetails(Request $request, $id)
    {
        $pagetitle     = 'genre  Details';
        $genreDetail   = genres::where('id', $id)->get();
        $genre = '';
        if (isset($genreDetail[0]->id) != '' &&  is_int($genreDetail[0]->id)) {
            $genre           = $genreDetail[0];
        }
        return view('admin.addGenres', compact('genre', 'pagetitle', 'id'));
    }

    public function ArtistDetails(Request $request, $id)
    {
        $pagetitle     = 'Artist  Details';
        $artistDetail   = artist::where('id', $id)->get();
        $artists = '';
        if (isset($artistDetail[0]->id) != '' &&  is_int($artistDetail[0]->id)) {
            $artists           = $artistDetail[0];
        }
        return view('admin.addArtist', compact('artists', 'pagetitle', 'id'));
    }
    public function artistDelete(Request $request, $id)
    {
        artist::where('id', $id)->delete();
        return redirect('artist-list');
    }
    public function eventDelete(Request $request, $id)
    {
        events::where('id', $id)->delete();
        return redirect('events-list');
    }
    public function genreDelete(Request $request, $id)
    {
        Genres::where('id', $id)->delete();
        return redirect('genre-list');
    }

    public function UpdateEventData(Request $request)
    {
        $data1    = $request->all();
        $validator = Validator::make($data1, [
            'id'        => 'integer',
            'title'    => 'string',
            'artist'    => 'string',
            'genres'    => 'string',
            'contact_no' => 'integer',
            'date'         => 'date',
            'image' => 'required',
            'amount'  => 'integer'
        ]);
        if ($validator->fails()) {
            return ['validate' => $validator->errors()->all()];
            echo "validation error";
            return false;
        }
        $image = $request->file('image');
        $name = $image->getClientOriginalName();

        $path = Storage::disk('public')->put($name, File::get($image));

        $updateArr   = [

            'title'          => $data1['title'],
            'artist'         => $data1['artist'],
            'genres'         => $data1['genres'],
            'date'           => $data1['date'],
            'venue'          => $data1['venue'],
            'contact_no'     => $data1['contact_no'],
            'amount'         => $data1['amount'],
            'description'     => $data1['description'],
            'image'           => $path,
            'image_name'    => $name,
        ];
        print_r($updateArr);
        if ($data1['id'] == 0) {
            $updateArr['created_at'] = date("Y-m-d h:i:s");
            $resp = events::insert($updateArr);
        } else {
            $updateArr['updated_at'] = date("Y-m-d h:i:s");
            $resp = events::where('id',  $data1['id'])->update($updateArr);
            print_r($resp);
        }
        if ($resp) {
            echo 'done';
            return redirect('/events-list');
        } else {
            echo 'An error occurred';
            return back();
        }
    }
    public function UpdateArtistData(Request $request)
    {
        $data1    = $request->all();
        $validator = Validator::make($data1, [
            'id'        => 'integer',
            'artist_name'    => 'string',
        ]);
        if ($validator->fails()) {
            return ['validate' => $validator->errors()->all()];
            echo "validation error";
            return false;
        }


        $updateArr   = [
            'artist_name'         => $data1['artist_name'],
        ];
        if ($data1['id'] == 0) {
            $updateArr['created_at'] = date("Y-m-d h:i:s");
            $resp = artist::insert($updateArr);
        } else {
            $updateArr['updated_at'] = date("Y-m-d h:i:s");
            $resp = artist::where('id',  $data1['id'])->update($updateArr);
            print_r($resp);
        }
        if ($resp) {
            echo 'done';
            return redirect('/artist-list');
        } else {
            echo 'An error occurred';
            return back();
        }
    }

    public function UpdateGenreData(Request $request)
    {
        $data1    = $request->all();
        $validator = Validator::make($data1, [
            'id'        => 'integer',
            'genres'    => 'string',
        ]);
        if ($validator->fails()) {
            return ['validate' => $validator->errors()->all()];
            echo "validation error";
            return false;
        }


        $updateArr   = [
            'genres'         => $data1['genres'],
        ];
        if ($data1['id'] == 0) {
            $updateArr['created_at'] = date("Y-m-d h:i:s");
            $resp = genres::insert($updateArr);
        } else {
            $updateArr['updated_at'] = date("Y-m-d h:i:s");
            $resp = genres::where('id',  $data1['id'])->update($updateArr);
            print_r($resp);
        }
        if ($resp) {
            echo 'done';
            return redirect('/genre-list');
        } else {
            echo 'An error occurred';
            return back();
        }
    }
}
