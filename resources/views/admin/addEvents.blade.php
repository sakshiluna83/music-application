<!DOCTYPE html>
<html>

<head>
    <title>Events </title>
</head>

<body>
    <form action="{{ route('UpdateEventData') }}" id="eventForm" method="post" enctype="multipart/form-data">
        <input type=" hidden" name="id" id="id" value="{{$id}}">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <table>
            <tr>
                <td>Event Name</td>
                <td>
                    <input type='text' name='title' id='title' value="<?= (isset($eventss->title) != '') ? $eventss->title : ''; ?>" />
                </td>
            </tr><br>
            <tr>
                <td>Artist</td>
                <td>
                    <input type='text' name='artist' id='artist' value='<?= (isset($eventss->artist) != '') ? $eventss->artist : ''; ?>' />
                </td>
            </tr><br>
            <td>Genre</td>
            <td>
                <input type='text' name='genres' id='genres' value='<?= (isset($eventss->genres) != '') ? $eventss->genres : ''; ?>' />
            </td>
            </tr><br>

            <tr>
                <td>Date</td>
                <td>
                    <input type='date' name='date' id="date" value='<?= (isset($eventss->date) != '') ? $eventss->date : ''; ?>' />
                </td>
            </tr><br>
            <tr>
                <td>Venue</td>
                <td>
                    <input type='text' name='venue' id="venue" value='<?= (isset($eventss->venue) != '') ? $eventss->venue : ''; ?>' />
                </td>
            </tr><br>
            <tr>
                <td>Amount</td>
                <td>
                    <input type='text' name='amount' id="amount" value='<?= (isset($eventss->amount) != '') ? $eventss->amount : ''; ?>' />
                </td>
            </tr><br>
            <tr>
                <td>Description</td>
                <td>
                    <textarea type='text' name='description' id="description"> {{(isset($eventss->description) != '') ? $eventss->description : ''; }} </textarea>

                </td>
            </tr><br>
            <td>Image</td>
            <td>
                <input type='file' name='image' id="image" Placeholde="upload Image" value='<?= (isset($eventss->imege_name) != '') ? $eventss->image_name : ''; ?>' }}>
            </td>
            </tr><br>

            <tr>
                <td>Phone Number</td>
                <td>
                    <input type='number' name='contact_no' id="contact_no" value='<?= (isset($eventss->contact_no) != '') ? $eventss->contact_no : ''; ?>' />
                </td>
            </tr><br>

            <tr>
                <td colspan='2'>
                    <input type='submit' id="update_btn" value="Update Event" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>