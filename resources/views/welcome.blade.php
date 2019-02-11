<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Student Portal</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        
        <script type="text/javascript" src="{{ URL::asset('js/anime.min.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('js/animation.js') }}"></script>

        <link rel="stylesheet" href="{{ URL::asset('css/local.css') }}" /> 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>


        <script type="text/javascript" src="{{ URL::asset('js/jquery.backstretch.min.js') }}"></script>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>



    </head>
    <body>
        <div class="container-fluid">
            <div class= "nav-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light" style="z-index: 1;" >
                    
                        <a class="navbar-brand logo" href="#">
                            <img src="http://emekaonyebuchi.com/wp-content/uploads/2018/07/logo_personal.png" width="30" height="30" class="d-inline-block align-top" alt="">
                            Emeka
                        </a>
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        
                            <ul class="navbar navbar-nav ">
                                @if (Route::has('login'))
                                    @auth
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                                        </li>
                                        @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                                        </li>
                                        @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                                        @endif
                                    @endauth
                                @endif
                            </ul>
                        
                    </div>
                </nav>
                <div>
                    <div>
    
                        <div class="row">
                            <div class='col-md-8'>

                            </div>
                            <div class='col-md-4'>
                           
                            <div class="salute">
                                <h1 class="ml8">
                                    <span class="letters-container">
                                        <span class="letters letters-left">Hi</span>
                                        <span class="letters bang">!</span>
                                    </span>
                                    <span class="circle circle-white"></span>
                                    <span class="circle circle-dark"></span>
                                    <span class="circle circle-container"><span class="circle circle-dark-dashed"></span></span>
                                </h1>
                            </div>
                            <div class='nav-slider'>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><img src="http://emekaonyebuchi.com/wp-content/uploads/2018/07/logo_personal.png" width="40" height="40" class="d-inline-block align-top" alt=""></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Student Portal</h6>
                                        <p class="card-text">Welcome to the Student Portal</p>
                                        <a href="{{ route('login') }}" class="card-link">Login</a>
                                        <a href="{{ route('register') }}" class="card-link">Register</a>
                                    </div>
                                </div>
                            

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </body>

    <script>
          $.backstretch("img/school.webp");
    </script>
</html>



