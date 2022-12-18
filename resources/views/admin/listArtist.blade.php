@extends('layouts.adminLayout')
@section('css')

<head>
    <title>Artist list</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
@endsection

@section('content')

<body>
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card"><br>
            <div class="card-body">
                <h4 class="card-title">{{$pagetitle}}</h4>

                <a type="button" class="btn btn-primary mb-2 " href="artist/0">Add Artist</a><br>
                <table class="table table-bordered data-table">
                    <tr>
                        <td>ID</td>
                        <td>Artist</td>
                        <td colspan=" 2">Action</td>

                    </tr>
                    @foreach ($artist as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->artist_name}}</td>
                        <td><button class="btn btn-primary" onclick="pageRedirect(<?= $event->id ?>)">Edit</button>
                            <button class="btn btn-primary" onclick="pageRedirect1(<?= $event->id ?>)">Delete</button>
                        </td>

                    </tr>
                    @endforeach
                </table>

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
        window.location.href = url + '/' + 'artist/' + id;
    }

    function pageRedirect1(id) {
        var url = '<?php echo env('APP_URL') ?>';
        window.location.href = url + '/' + 'artist/delete/' + id;
    }
</script>
@endsection