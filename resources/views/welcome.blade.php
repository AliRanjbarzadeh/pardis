<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>
</head>
<body class="antialiased">
<form method="post" enctype="multipart/form-data">
	@csrf
	<input type="file" name="file">
	<button type="submit">Upload</button>
</form>
</body>
</html>
