@extends('main')

@section('title', 'Delete Comment')

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1> Delete this comment </h1>
				<p> Name: {{ $comment->name }}</p><br>
				<p> Comment: {{ $comment->comment}}</p><br>

				{{ Form::open(['route' => ['comments.destroy', $comment->id] , 'method' => 'delete']) }}
					{{ Form::submit('Yes Delete !', ['class' => 'btn btn-danger'])}}
				{{ Form::close() }}
		</div>
	</div>




@endsection