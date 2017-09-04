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

    @include('layouts.partials._homepage_nav')
    <div class="homepage-wrapper">

        <div class="row">
            <div class="container">
                <div class="homepage-upper">
                    <h1 >Arts and talents house</h1>
                    <p>Vitalanta is all about Revitalizing Experiences through Sounds , Sights and Digital Content.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
                    <div class="search-form">
                        <form role="form" action="/search" method="get">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-group input-group-lg">
                                        <input type="text" name="q" class="form-control" value="{{ Request::get('q') }}" placeholder="Search here... (eg: Artists, MCs, Djs, Dancers,Comedians, Photographers )">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn">Search</button>
                                        </div><!-- /btn-group -->
                                    </div><!-- /input-group -->
                                </div><!-- /.col-xs-12 -->
                            </div><!-- /.row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="social-media">
                    <ul class="list-inline">
                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook" class="facebook"><i class="fa fa-facebook-square"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter" class="twitter"><i class="fa fa-twitter-square"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram" class="instagram"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Youtube" class="youtube"><i class="fa fa-youtube-square"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="homepage-bottom">
                    <ul class="list-inline">
                        <li style="color: #cccccc">&copy; All Rights Reserved. <span style="text-decoration: underline;">VITALANTA INC.</span></li>
                        <li><a href="#" data-toggle="modal" data-target="#aboutUsModal">About us</a></li>
                        <li><a href="#"  data-toggle="modal" data-target="#services">Services</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#contactUs">Contact us</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#newletterModal" class="btn btn-success">Join our newsletter</a></li>

                    </ul>
            </div>
        </div>
    </div>


</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
</body>
</html>


@include('layouts.partials._nav_modals')