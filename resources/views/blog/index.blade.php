@extends('main')

@section('title', 'Blog')

@section('content')

	@foreach ($posts as $post)
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<h2> {{$post->title}} </h2>

			<h5> Published: {{ date('M j, Y', strtotime($post->created_at)) }} </h5>

			<p>{{ substr($post->body, 0, 100)}}{{strlen($post->body) > 100 ? '...': ""}}</p>

			<a href = "{{ route('blog.single', $post->slug)}}" class="btn btn-primary"> Click for post</a>
			</div>
		<hr>
		</div>
	@endforeach

@endsection
