<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>

    <h1>Upload Image</h1>
    @if (@errors->())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
    </div>
    @endif
    <form action="/uploadImage" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" accept="image/*">
        <button type="submit">Upload</button>
    </form>
</body>
</html>