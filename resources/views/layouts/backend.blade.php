<!--
|--------------------------------------------------------------------------
| resources/views/layouts/backend.blade.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
-->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin panel</title>
    <link href="https://bootswatch.com/3/readable/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" src="{{ asset('css/app.css')}}">
    <link rel="stylesheet" src="{{ asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" src="{{ asset('css/bootstrap.min.css')}}">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">  <!-- Lecture 5  -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        var base_url = '{{ url('/admin') }}';
        <?php
        if (isset($_COOKIE['scroll_val'])) {
            echo 'var scroll_val =' . '"' . (int)$_COOKIE['scroll_val'] . '";';
            setcookie('scroll_val', '', -3000);
        }
        ?>
    </script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Enjoy the trip!</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><span class="button__badge">2</span> <span
                            class="glyphicon glyphicon-envelope"></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="unread_notification"><a href="#">John Doe reserved room number 26 in X object on
                                10/20/2017</a></li>
                        <li><a href="#">John Doe canceled his reservation for room number 4 in X object on
                                010/15/201</a></li>
                        <li class="unread_notification"><a href="#">John Doe reserved room number 7 in X object on
                                09/30/2017</a></li>
                        <li><a href="#">Your reservation for room number 6 in the X object on 09/12/2017 has been
                                confirmed</a></li>
                        <li><a href="#">Your reservation for room number 9 in the X object on 08/29/2017 has been
                                canceled</a></li>
                        <li><a href="#">Your reservation for room number 10 in the X object on 08/28/2017 has been
                                canceled</a></li>
                    </ul>
                </li>
                <li><p class="navbar-text">{{Auth::user()->FullName}}</p></li>
                <li><a href="{{ route('profile') }}">Profile</a></li>
                <li class="nav-item dropdown"><a href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">  @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="{{ route('adminHome') }}">Booking calendar <span
                            class="sr-only">(current)</span></a></li>
                @if(Auth::user()->hasRole(['owner','admin']))
                    <li><a href="{{ route('myObjects') }}">My tourist objects</a></li>
                    <li><a href="{{ route('saveObject') }}">Add a new tourist object</a></li>
                @endif
                @if(Auth::user()->hasRole(['admin']))
                    <li><a href="{{ route('cities.index') }}">Cities</a></li>
                @endif
            </ul>
        </div>
        <div style="padding-top:20px" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            @if(Session::has('message'))
                <br>
                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ Session::get('message') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error )
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script> <!-- Lecture 5 -->
<script src="{{ asset('js/admin.js') }}"></script> <!-- Lecture 5 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script> <!-- Lecture 5 -->
<script src="{{ asset('js/bootstrap2.min.js') }}"></script> <!-- Lecture 5 -->
<script src="{{ asset('js/jquery-ui.js') }}"></script> <!-- Lecture 5 -->
<script src="{{ asset('js/popper.min.js') }}"></script> <!-- Lecture 5 -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $(".datepicker").datepicker();
    });
</script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src={{asset('js/app.js')}}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('additional_js')
@stack('scripts')
<script>
    if (typeof scroll_val !== 'undefined') {
        $(window).scrollTop(scroll_val);
    }

    function scroll_value() {
        document.cookie = 'scroll_val' + '=' + $(window).scrollTop();
    }

    $(document).on('click', '.keep_pos', function () {
        scroll_value();
    });

</script>
</body>
</html>
