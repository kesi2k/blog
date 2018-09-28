@extends('main')

@section('title', 'view posts')

@section('content')

  <div class="row">
  <!-- Form::model(), connects a form to a model. Regular Form::open() is format for a regular form 
  Double curly braces is a command for PHP to echo out -->

    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'Put', 'files' => true]) !!}

        <div class="col-md-8">
          {{ Form::label('title', 'Title:')}}
          {{ Form::text('title', null, ["class" => 'form-control'])}}

          {{Form::label('slug', 'Slug: ', ['class' => 'form-spacing-top'])}}
          {{ Form::text('slug', null, ["class" => 'form-control'])}}


          <!-- Manually create categories-->
          {{Form::label('category_id', 'Category: ', ['class' => 'form-spacing-top'])}}
          {{ Form::select('category_id', $categories, null, ['class' => 'form-control ']) }}

          {{Form::label('tags', 'Tags: ', ['class' => 'form-spacing-top'])}}
          {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple'])}}


          {{ Form::label('title', 'Body:',['class' => 'form-spacing-top']) }}
          {{ Form::textarea('body', null, ['class' => 'form-control'] )}}

          <!-- Photos section -->
          {{ Form::label('featured_image', 'Update Featured Image: ', ['class' => 'form-spacing-top'] ) }}
          {{ Form::file('featured_image') }}

        </div>
        <div class="col-md-4">
          <div class="well">
            <dl class="dl-horizontal">
              <dt>Created at:</dt>
              <dd>{{$post->created_at}}</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt>Last updated:</dt>
              <dd>{{$post->updated_at}}</dd>
            </dl>
            <hr>
          <div class="row">
             <div class="col-sm-6">
             <!-- Laravel way to link routes
             <a href="#" class="btn btn-primary btn-block">Edit</a>
             <a href="#" class="btn btn-danger btn-block">Delete</a>

             First value: where we are going, Second: Value of the anchor tags and parameters the URL expects.
             Even if no variable is expected by the URL, passing in an empty array is still required. -->

                {!! Html::linkRoute('posts.show','Cancel',array($post->id), array('class'=>'btn btn-danger btn-block')) !!}
             </div>

             <div class="col-sm-6">
                {{ Form::submit('Save Changes', ['class' => 'btn btn-success' ]) }}

             
             </div>
          </div>

          </div>
        </div>
    {!! Form::close() !!}
  </div><!-- End of form -->

@endsection