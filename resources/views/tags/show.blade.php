@extends('main')

@section('title', "$tag->name tag")

@section('content')

		<div class='row'>
			<div class="col-md-8">
				<h1>{{$tag->name}} 
				<small>{{ $tag->posts()->count() }} posts </small>
				</h1>
			</div>
		</div>
		<div class='row'>
			<div class="col-md-7">
				<div class="col-md-2">
					<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-small btn-primary"> Edit tag</a>
				</div>
				<div class="col-md-2">
				<!-- <form class="btn btn-small btn-danger btn-block">Delete</form> -->
				{{ Form::open (['route' => ['tags.destroy', $tag->id], 'method' => 'Delete']) }}
					{{ Form::submit('Delete tag', ['class' => 'btn btn-small btn-danger']) }}
				{{ Form::close() }}
				</div>
			</div>
		</div>

		<div class='row'>
				<div class="col-md-12 form-spacing-top">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Posts with {{ $tag->name }} tag</th>
								<th> Post's tags</th>
								<th>View post</th>
							</tr>
						</thead>
						<tbody>
					
							@foreach($tag->posts as $post)
							<tr>

									<th>{{ $post->id }}</th>
									<td>{{ $post->title }}</td>
									<td >@foreach ($post->tags as $tag)
											<span style="margin-left:5px;" class="label label-default"> {{ $tag->name }} </span>
										@endforeach	
									</td>
									<td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs) "> View </a></td>
							@endforeach
							</tr>
						</tbody>
					</table>
				</div>
		</div>

	</div>

@endsection