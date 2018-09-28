@extends('main')

@section('title', 'create post')

@section('content')
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h1>Create post</h1>
              <!-- Creating forms with Laravel. 
              Instead of passing in URl, pass in route with Name of method specified.
              Obtained from vagrant terminal with: php artisan route:list
              Form label's first entry should match the column name of the DB
              null entry specifies no default value shown in the input box
              Form validation with Parsley. Set parsley equal to an empty string.
              -->

              {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => 'true']) !!}

                <!-- Title of post -->
                {{Form::label('title','Title: ')}}
                {{Form::text('title', null, array('class' => 'form-control', 'required' => '', 'max-length' => '300'))}}

                <!-- Inputting slug info -->
                {{Form::label('slug', 'Slug: ')}}
                {{Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255'))}}

                <!--  Place post in category, saving with category ID-->
                {{ Form::label('category_id', 'Category:')}}
                <select class='form-control' name='category_id'>
                  @foreach($categories as $category)
                   <option value='{{ $category->id}}'> {{ $category->name}}</option>
                  @endforeach

                </select>

                <!-- Tags feature added with select 2-->
                {{ Form::label('tags', 'Tags:')}}
                <select class='form-control select2-multi' multiple='multiple' name='tags[]'>
                  @foreach($tags as $tag)
                   <option value='{{ $tag->id}}'> {{ $tag->name}}</option>
                  @endforeach

                </select>


                <!-- Body of post -->
                {{Form::label('body', 'Body: ')}}
                {{Form::textarea('body', null, array('class' => 'form-control', 'required' => ''))}}

                <!-- Button for submitting blog post-->
                <div class="col-md-12 ">
                {{Form::submit('Create post', array('class' => 'btn btn-success ', 'style' => 'margin-top: 20px;', ))}}
                </div>






                <!-- Form for submitting a photo -->
                <div class="col-md-12 ">
                {{ Form::label('featured_image', 'Upload Featured Image:', array('class' => 'form-spacing-top', 'style' => 'margin-top: 20px;')) }}
                {{ Form::file ('featured_image') }}
                </div>
              
              {!! Form::close() !!}



            <!-- Creating form with HTML
            <hr>
              <form method="POST" action="{{route('posts.store')}}">

                <div class="form-group">
                  <label name="subject">Title:</label>
                  <input id="title" name="title" class="form-control">
                </div>

                <div class="form-group">
                  <label name="body">Body:</label>
                  <textarea id="body" name="body" rows="10" class="form-control">Type your message here...</textarea>
                </div>

                <input type="submit" value="Create Post" class="btn btn-success">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
              </form>
             </div>
            </div>
            -->
            </div><!-- End of container -->
          </div>

@endsection








