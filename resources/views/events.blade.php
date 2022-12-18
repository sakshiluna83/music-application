<!DOCTYPE html>
<html>

<head>
    <title>Music Concerts</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
            overflow: hidden;
            background-color: #e9e9e9;
        }

        .topnav a {
            float: left;
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #2196F3;
            color: white;
        }

        .topnav .search-container {
            float: right;
        }

        .topnav input[type=text] {
            padding: 6px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
        }

        .topnav .search-container button {
            float: right;
            padding: 6px 10px;
            margin-top: 8px;
            margin-right: 16px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
        }

        .topnav .search-container button:hover {
            background: #ccc;
        }

        @media screen and (max-width: 600px) {
            .topnav .search-container {
                float: none;
            }

            .topnav a,
            .topnav input[type=text],
            .topnav .search-container button {
                float: none;
                display: block;
                text-align: left;
                width: 100%;
                margin: 0;
                padding: 14px;
            }

            .topnav input[type=text] {
                border: 1px solid #ccc;
            }
        }
    </style>

</head>

<body>

    <div class="container">
        <h1>Music Concerts</h1>
        <div class="topnav">
            <form action="{{ url('events') }}" method="get">
                <select name="artist">
                    <option name="artist " value="">Artist</option>
                    @foreach($data['artist'] as $artist)

                    <option name="artist" id="artist" value="{{$artist['artist']}}">{{$artist['artist'] }}</option>
                    @endforeach

                </select>

                <select name="genres">
                    <option value="">Genre</option>
                    @foreach($data['genres'] as $genres)

                    <option name="genres" id="genres" value="{{$genres['genres']}}">{{$genres['genres'] }}</option>
                    @endforeach

                </select>
                <select name="date">
                    <option name="date " value="">Date</option>

                    @forelse($data['date'] as $date)

                    <option name="date" value="{{$date['date']}}">{{$date['date'] }}</option>
                    @empty
                    <tr>
                        <td colspan="3">No event of this artist.</td>
                    </tr>
                    @endforelse

                </select>
                <select name="venue">
                    <option value="">Venue</option>

                    @forelse($data['venue'] as $venue)

                    <option name="venue" value="$venue['venue']">{{$venue['venue'] }}</option>
                    @empty
                    <tr>
                        <td colspan="3">No event of this artist.</td>
                    </tr>
                    @endforelse

                </select>
                <button type="submit">Filter Results</button>

            </form>

            <div class="search-container">
                <form action="{{ url ('events')}}" method="get">
                    <input type="text" placeholder="Search.." id="search" name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <a href="{{url('/signout')}}">Sign Out</a>

        </div>

        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Event Name</th>
                    <th>Artist</th>
                    <th>Venue</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Image</th>

                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->artist }}</td>
                    <td>{{ $event->venue }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->amount }}</td>
                    <td>
                        <img src="{{ url('storage/app/public/'.$event->image_name) }}" width="80" height="60" alt=''>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="3">There are no events.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {!! $events->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>

</body>

</html>
<script>
    // $(document).ready(function() {
    //     $('#ajaxSubmit').click(function(e) {
    //         e.preventDefault();
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //             }
    //         });
    //         jQuery.ajax({
    //             url: "{{ url('events') }}",
    //             method: "get",
    //             data: {
    //                 artist: jQuery('#artist').val(),
    //                 venue: jQuery('#venue').val(),
    //                 genres: jQuery('#genres').val(),
    //                 date: jQuery('#date').val(),

    //             },
    //             success: function(result) {
    //                 console.log(result);
    //             }
    //         });
    //     });
    // });
</script>