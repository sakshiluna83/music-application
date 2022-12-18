<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class events extends Model
{
    use HasFactory;


    protected $table = 'events';

    protected $fillable = [
        'title', 'genres', 'description', 'amount', 'date', 'venue', 'image', 'artist'
    ];

    public static function getArtist()
    {
        $res = DB::table('events')
            ->select('artist')
            ->groupByRaw('artist')
            ->get();
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }
    public static function getGenre()
    {
        $res = DB::table('events')
            ->select('genres')
            ->groupByRaw('genres')
            ->get();
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }
    public static  function getDate()
    {
        $res = DB::table('events')
            ->select('date')
            ->groupByRaw('date')
            ->get();
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }
    public static  function getvenue()
    {
        $res = DB::table('events')
            ->select('venue')
            ->groupByRaw('venue')
            ->get();
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }
}
