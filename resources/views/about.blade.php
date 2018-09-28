@extends('main')

@section('content')
          <div class="row">
            <div class="col-md-12">
              <div class="">
              <h1>About me</h1>
                <p>This is a filler paragraph!</p>
            </div>
          </div> <!-- End of header -->
      </div><!-- End of container -->

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    About {{$data['name']}}
                </div>
                <p>My first Laravel full stack app</p>
                <p>Email me @ {{$data['email']}}</p>
            </div>
        </div>
    </body>
</html>

@endsection
