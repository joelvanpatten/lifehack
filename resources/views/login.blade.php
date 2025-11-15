<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifish Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/login.js')
</head>
<body>
<div id="app" class="container">
    <login-form />
</div>
</body>
</html>
