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
                <table class="table table-bordered data-table">
                    <tr>
                        <!-- <td>ID</td> -->
                        <td>Genre Name</td>
                        <td colspan=" 2">Action</td>

                    </tr>
                    @foreach ($genres as $genre)
                    <tr>
                        <td>{{ $genre->genres}}</td>
                        <td><button class="btn btn-primary" onclick="pageRedirect(<?= $genre->id ?>)">Edit</button>
                            <button class="btn btn-primary" onclick="pageRedirect1(<?= $genre->id ?>)">Delete</button>
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
        window.location.href = url + '/' + 'genre/' + id;
    }

    function pageRedirect1(id) {
        var url = '<?php echo env('APP_URL') ?>';
        window.location.href = url + '/' + 'genre/delete/' + id;
    }
</script>
@endsection