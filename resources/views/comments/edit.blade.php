@extends('main')

@section('title', 'Edit comment')

@section('content')

	<h3> Edit Comment </h3>
		<div class="row">
			<div class="col-md-8 col-md-offset-2 form-spacing-top">

			{{ Form::model ($comment, ['route' => ['comments.update', $comment->id], 'method' => 'Put']) }}

				{{ Form::label('name', 'Name:') }}
				{{ Form::text('name', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}

				{{ Form::label('email', 'Email: ')}}
				{{ Form::text('email', null, ['class' => 'form-control', 'disabled' => '']) }}

				{{ Form::label('comment', 'Comment: ') }}
				{{ Form::textarea('comment', null, ['class' => 'form-control']) }}

				{{ Form::submit('Update Comment', ['class' => 'btn btn-success form-spacing-top']) }}


			{{ Form::close() }}
			</div>
		</div>
@endsection 