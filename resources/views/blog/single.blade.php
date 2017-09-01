@extends('main')

<?php $titleTag = htmlspecialchars($post->title); ?>

@section('title', "$titleTag")

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1> {{$post->title}}</h1>
			<p> {{$post->body}}</p>
			<br>
			<p> Posted in: {{$post->category->name}} </p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<img src="{{ asset('images/' . $post->image )}}"" height="300" width="400">
			
		</div>
	</div>

	<hr>
	<hr>
	<hr>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class=''>
				<h3> {{ $post->comments()->count() }} Comments </h3>
					@foreach($post->comments as $comment)
						<div class="comment">
								<div class="author-info"> 
									<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) }}" class="author-image">
									<div class="author-name">
										<h4>{{ $comment->name }} </h4>
										<p> {{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }} </p>
									</div>
								</div>
								<div class="comment-content"> 
									{{ $comment->comment }} 
								</div>
						</div>				
					@endforeach
			</div>
		</div>
	</div>

	<div class="row">
		<div id="comments-form" class="col-md-8 col-md-offset-2 form-spacing-top" >
			{{ Form::open (['route' => ['comments.store', $post->id], 'method' => 'Post']) }}

				<div class="row">
					<div class="col-md-6">
						{{ Form::label('name', "Name:") }}
						{{ Form::text('name', null, ['class' => 'form-control']) }}
					</div>
					<div class="col-md-6">
						{{ Form::label('email', 'Email: ') }}
						{{ Form::text('email', null, ['class'=> 'form-control']) }}
					</div>
					<div class="col-md-12">
						{{ Form::label('comment', "Comment:") }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 5]) }}

						{{ Form::submit('Add Comment', ['class' => 'btn btn-success form-spacing-top']) }}

					</div>
				</div>


			{{ Form::close() }}
		</div>
	</div>


@endsection