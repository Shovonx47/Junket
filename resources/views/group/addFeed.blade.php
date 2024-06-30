<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add to Feed</title>
</head>
<body>
    <form action="{{ url('group/feed/create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label>Feed Image</label><br>
        <input type="file" name="image"><br>
        <label>Feed Heading</label><br>
        <input type="text" name="heading"><br>
        <label>Feed Short Description</label><br>
        <textarea name="short_description"></textarea><br>
        <label>Feed long Description</label><br>
        <textarea name="long_description"></textarea><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>


