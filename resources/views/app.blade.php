<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div id="app"></div>
    @php
        $config = [
            'appName' => config('app.name'),
            'locale' => $locale = app()->getLocale(),
            'translations' => json_decode(file_get_contents(resource_path("lang/{$locale}.json")),true)
        ]
    @endphp
    <script>window.config = {!! json_encode($config); !!}</script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>