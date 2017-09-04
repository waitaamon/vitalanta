<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.min.css">

    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        window.amontube = {

            url: '{{ config('app.url') }}',

            user: {
                id: {{ Auth::check() ? Auth::user()->id : 'null' }},
                authenticated: {{ Auth::check() ? 'true' : 'false' }}
            }
        };
    </script>
</head>
<body>

    <div id="app">
        <div class="wrapper">
            @if(Auth::user())
                @include('layouts.partials._side_nav')
            @endif

            <div class="main-panel">
                @include('layouts.partials._navigation')
                <div class="content">
                    @yield('content')
                </div>

            </div>


        </div>


    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
