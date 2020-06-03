<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{$basePath}}css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{$basePath}}css/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{$basePath}}css/dataTables.bootstrap4.min.css"/>

    <link rel="stylesheet" type="text/css" href="{{$basePath}}css/issue-add.css"/>
    <title>{{ $title }}</title>

    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            @if($isLoggedIn)
                <a class="nav-link my-2 my-lg-0" href="/logout/">Logout</a>
            @else
                <a class="nav-link my-2 my-lg-0" href="/login/">Login</a>
            @endif
        </div>
    </nav>
</header>
<main class="container">
    <h1 class="mt-5">{{$controller}}</h1>
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-md-9 col-sm-12 col-xs-12">

            @if (count($errors) > 0)
                <div class="alert alert-warning">

                    @foreach ($errors as $error)
                        <p>{{ $error }}</p>
                    @endforeach

                </div>
            @endif
            @if(isset($success))
                <div class="alert alert-success" role="alert">
                    <a href="/issue/list/">{{$success}}</a>
                </div>
            @endif

            @yield('content')
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
            @yield('right_sidebar')
        </div>

    </div>

</main>

<div class="wrapper">
    @include('footer')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="{{$basePath}}js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{$basePath}}js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{$basePath}}js/datatables.min.js"></script>

<script type="text/javascript" src="{{$basePath}}js/issue-list.js"></script>

</body>
</html>