<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vineyard Check-In') }}</title>

    <!-- Scripts -->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>

    <!-- MDBootstrap Masonry  -->
    <script type="text/javascript" src="/js/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="/js/imagesloaded.pkgd.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet"></head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark primary-color shadow-sm">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(\App\Event::activeEventExists())
                                    <a class="dropdown-item" onclick="event.preventDefault(); endCheckin();
                                                      document.getElementById('logout-form').submit();">
                                         End Check-in & {{ __('Logout') }}
                                     </a>
                                    @endif
                                     <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
        </nav>
        <div class="container">
            <div class="grid">
                <div class="grid-sizer col-2"></div>
                @section('sidenav')

        @show
        <div class="grid-item col-10 my-4">
            @yield('content')
        </div>
    </div>
</div>
</div>
<!-- Start Check-In Modal -->
<div class="modal fade" id="startCheckInModal" tabindex="-1" role="dialog" aria-labelledby="startCheckInLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="startCheckInLabel">Start Check-In</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="md-form form-lg">
                    <input type="text" placeholder="Service Name" name="checkin" id="txt-start-checkin" class="form-control form-control-lg" />
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="javascript:startCheckin()">Start</button>
            </div>
          </div>
        </div>
      </div>
      @stack('modals')
      @stack('javascript')

        </body>
        <script type="text/javascript">
$('.grid').masonry({
  itemSelector: '.grid-item',
  columnWidth: '.grid-sizer',
  percentPosition: true
});

function startCheckin()
{
    // get the service name
    let eventName = $('#txt-start-checkin').val();
    // and start the service
    $.post('/api/checkin/start', { event: eventName, api_token: "{{ Auth::user() ? Auth::user()->api_token : '' }}" }, function (res) {
        // redirect to the checkin screen
        window.location = '/checkin';
    }, "json");
}

function endCheckin()
{
    // get the service name
    let eventName = $('#txt-start-checkin').val();
    // and start the service
    $.post('/api/checkin/end', { event: eventName, api_token: "{{ Auth::user() ? Auth::user()->api_token : '' }}" }, function (res) {
        // redirect to the home screen
        window.location = '/';
    }, "json");
}
        </script>
</html>
