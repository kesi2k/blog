@extends('main')

@section('title', 'front page')

@section('content')

          <div class="row">
            <div class="col-md-12">
              <div class="jumbotron">
                  <h1>Its the Laravel blog!</h1>
                  <p>Post and comment without hesitation.</p>
                  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular post</a></p>
                </div>
            </div>
          </div> <!-- End of header -->
          <div class="row">
              <div class="col-md-8">

                @foreach($posts as $post)

                  <div class="post">
                      <h3>{{ $post->title }}</h3>
                      <p>{{ $post->body }}</p>
                      <p><a class="btn btn-primary" href={{url('blog/'.$post->slug)}} role="button">Read more</a></p>
                  </div>
                  <hr>

                @endforeach

              </div>

              <div class="col-md-4">
                <h3> Sidebar Content will go here. </h3>
              </div>



          </div>
@endsection