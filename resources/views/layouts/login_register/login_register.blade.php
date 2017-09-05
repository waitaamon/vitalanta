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

    <div class="login-register-wrapper">

        {{--login register navigation--}}
        @include('layouts.login_register.partials._navigation')

        {{--alerts--}}
        <div class="row text-center">
            <div class="col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 ">
                @include('partials._alerts')
            </div>
        </div>

        {{--content--}}
        @yield('content')

    </div>

</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
</body>
</html>
