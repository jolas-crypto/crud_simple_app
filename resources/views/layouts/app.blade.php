<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resoureces/css/app.css', 'resources/js/app.js'])
    @stach('script')
</head>
<body>
    <div id="app" class="bg-gray-300">
        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>