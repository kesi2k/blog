@extends('main')

@section('title','all posts')

@section('content')
	
	<div class="row">
		<div class="col-md-10">
			<h1> All posts</h1>
		</div>
		<div class="col-md-2">
			<a href="{{route('posts.create')}}" class="btn btn-lg btn-primary btn-block"> Create post</a>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th> #</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created at</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($posts as $post)
						<tr>
							<th>{{$post->id}}</th>
							<td>{{$post->title}}</td>
							<td>{{substr($post->body, 0, 20)}}{{strlen($post->body) > 20 ? "...":"" }}</td>
							<td>{{$post->created_at}}</td>
							<td>
							<a href="{{route('posts.show', $post->id)}}" class="btn btn-default"> View </a> 
							<a class="btn btn-default" href="{{route('posts.edit', $post->id)}}"> Edit </a></td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="text-center">
				{!! $posts->links() !!} <!-- Available because of the paginate command -->
			</div>


		</div>
	</div>

@endsection