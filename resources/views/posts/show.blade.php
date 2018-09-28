@extends('main')

@section('title', 'view posts')

@section('content')

  <div class="row">
      <div class="col-md-8">
        <h1> {{ $post->title }}</h1>
        <p class="lead"> {{ $post->body}}</p>
        <div class="">
          @foreach($post->tags as $tag)
            <span style="margin-left:5px;" class="label label-default"> {{$tag->name}} </span>
          @endforeach
        </div>


        <img src="{{asset('images/'.$post->image) }}" class="form-spacing-top" height="300" width="600">





        <div id="edit-comments">
          <h3> {{ $post->comments()->count() }} Comments </h3>
        </div>
        <table class="table">
          <thead> 
            <tr>
              <th> Name </th>
              <th> Email </th>
              <th> Comment </th>
              <th>  </th>
            </tr>
          </thead>
          <tbody>
            @foreach($post->comments as $comment)
              <tr>
                <td> {{ $comment->name }} </td>
                <td> {{ $comment->email }}</td>
                <td> {{ $comment->comment }} </td>
                <td><a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary "><span class="glyphicon glyphicon-pencil"></span></a> 
                <a href="{{ route('comments.delete', $comment->id)}}" class="btn btn-danger "><span class="glyphicon glyphicon-trash"></span></a> 
                </td>
              </tr>

            @endforeach
          </tbody>
        </table>

      </div>
      <div class="col-md-4">
        <div class="well">
          <dl class="dl-horizontal">
            <label>URL:</label>
            <p><a href="{{route('blog.single', $post->slug)}}">{{route('blog.single', $post->slug)}}</a></p>
          </dl>
          <dl class="dl-horizontal">
            <label>Category:</label>
            <p>{{ $post->category ? $post->category->name : 'No category' }}</p>
          </dl>
          <dl class="dl-horizontal">
            <label>Created at:</label>
            <p>{{$post->created_at}}</p>
          </dl>
          <dl class="dl-horizontal">
            <label>Last updated:</label>
            <p>{{$post->updated_at}}</p>
          </dl>
          <hr>
          <div class="row">
             <div class="col-sm-6">
             <!-- Laravel way to link routes
             <a href="#" class="btn btn-primary btn-block">Edit</a>
             <a href="#" class="btn btn-danger btn-block">Delete</a>

             First value: where we are going, Second: Value of the anchor tags and parameters the URL expects.
             Even if no variable is expected by the URL, passing in an empty array is still required. -->

                {!! Html::linkRoute('posts.edit','Edit',array($post->id), array('class'=>'btn btn-primary btn-block')) !!}
             </div>

             <div class="col-sm-6">
                {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'Delete'])  !!}

                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

                {!! Form::close() !!}
                
             </div>


             <div class="col-sm-12">
                {!! Html::linkRoute('posts.index','View all posts',[], array('class'=>'btn btn-primary btn-block form-spacing-top')) !!}
             </div>


          </div>

        </div>
      </div>
  </div>

@endsection