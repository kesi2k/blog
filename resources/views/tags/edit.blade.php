@extends('main')

@section('title', 'Edit Tag')

@section('content')
	
	{{ Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'Put']) }}

		{{ Form::label('name', "Title:") }}
		{{ Form::text('name', null, ['class' => 'form-control']) }}

		{{ Form::submit('Save Changes', ['class' => 'btn-success form-spacing-top'])}}


	{{ Form::close() }}



@endsection