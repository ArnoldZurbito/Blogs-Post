@extends('main')

@section('title','| Blog')

@section('content')
<div class="row">
	<div class="col-md-8 col-offset-2">
			<h2>Blog</h2>
	</div>
</div>

@foreach ($posts as $post)
	{{-- expr --}}

<div class="row">
	<div class="col-md-8 col-offset-2">
		<h2>{{ $post->title }}</h2>
		<h5>Published Date: {{ date('M j, Y', strtotime($post->created_at)) }}</h5>
		<p>{{ substr($post->body,0,250) }}{{ strlen($post->bod) > 250 ? "..." : ""}}</p>

		<a href="{{ route('blog.single', $post->id) }}" class="btn btn-primary btn-sm">Read more</a>
		<hr>
	</div>
</div>

@endforeach

<div class="row">
	<div class="col-md-12">
			<div class="text-center">
				{!! $posts->links() !!}
			</div>
	</div>
</div>
@endsection