<!DOCTYPE html>
<html>

<head>
    <title>Events </title>
</head>

<body>
    <form action="{{ route('UpdateGenreData') }}" id="eventForm" method="post" enctype="multipart/form-data">
        <input type=" hidden" name="id" id="id" value="{{$id}}">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <table>
            <tr>
                <td>Genre Name</td>
                <td>
                    <input type='text' name='genres' id='genres' value="<?= (isset($genre->genres) != '') ? $genre->genres : ''; ?>" />
                </td>
            </tr><br>

            <tr>
                <td colspan='2'>
                    <input type='submit' id="update_btn" value="Update Artist" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>