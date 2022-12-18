@extends('layouts.adminLayout')
@section('css')

<head>
    <title>Events Record</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
@endsection

@section('content')

<body>
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card"><br>
            <div class="card-body">
                <h4 class="card-title">{{$pagetitle}}</h4>

                <a type="button" class="btn btn-primary mb-2 " href="events/0">Add Events</a><br>
                <!-- <div class="table-responsive pt-1"> -->
                <table class="table table-bordered data-table" border="1">
                    <tr>
                        <td>Event Name</td>
                        <td>Artist</td>
                        <td> Genre </td>
                        <td>Venue</td>
                        <td>Date</td>
                        <td>Amount</td>
                        <td>Image </td>
                        <td>Description </td>

                        <td>phone Number</td>
                        <td colspan=" 1">Action</td>

                    </tr>
                    @foreach ($events as $event)
                    <tr>
                        <td width="5%">{{ $event->title }}</td>
                        <td width="5%">{{ $event->artist}}</td>
                        <td width="5%">{{ $event->genres}}</td>
                        <td width="10%">
                            {{ $event->venue }}
                        </td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->amount }}</td>
                        <td>
                            <img src="{{ url('storage/app/public/'.$event->image_name) }}" width="80" height="60" alt=''>

                        </td>
                        <td width="10%"> {{ $event->description }}</td>
                        <td width="5%">{{ $event->contact_no }}</td>
                        <td><button class="btn btn-primary" onclick="pageRedirect(<?= $event->id ?>)">Edit</button>
                            <button class="btn btn-primary" onclick="pageRedirect1(<?= $event->id ?>)">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <!-- </div> -->
            </div>
        </div>
    </div>
</body>

</html>
@endsection
@section('script')
<script>
    function pageRedirect(id) {
        var url = '<?php echo env('APP_URL') ?>';
        window.location.href = url + '/' + 'events/' + id;
    }

    function pageRedirect1(id) {
        var url = '<?php echo env('APP_URL') ?>';
        window.location.href = url + '/' + 'events/delete/' + id;
    }
</script>
@endsection