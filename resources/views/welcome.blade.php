@extends('layouts.landing.landing')

@section('content')

    {{--homepage navigation--}}
    @include('layouts.landing.partials._navigation')

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
                    <li style="color: #81ccba">&copy; All Rights Reserved. <span style=""> @php echo date('Y') @endphp</span></li>
                    <li><a href="#" data-toggle="modal" data-target="#aboutUsModal">About us</a></li>
                    <li><a href="#"  data-toggle="modal" data-target="#services">Services</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#contactUs">Contact us</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#newletterModal" class="btn btn-success">Join our newsletter</a></li>

                </ul>
            </div>
        </div>
    </div>

@section('content')







