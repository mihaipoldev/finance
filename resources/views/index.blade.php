@extends('layouts.master')

@section('title')
	Finance
@endsection

@section('main')
	<main>
		<div class="container container-custom">
			<section class="row">
				<div class="col-xs-12">
					<h2 class="page-title">
						@if(isset($category) and $category != null)
							{{ ucfirst($category->title) }}
						@else
							All Posts
						@endif
						<a href="#" id="btn-add" data-url="{{ route('post.create', ['id'=>$post->id]) }}">add</a>
					</h2>
				</div>
				<div class="col-md-9 posts">
					<div class="top-bar">
						<div class="form-group">
							<input class="search form-control" type="text" name="search" placeholder="Search"/>
						</div>
						<form class="filters" method="post" action="{{ route('index') }}">
							<div class="form-group form-inline">
								<label for="filter-category">Category: </label>
								<select class="form-control" id="filter-category" name="filter_category">
									<option value="0">All Posts</option>
									@foreach($post_categories as $post_category)
										<option value="{{ $post_category->id }}" @if (Request::get('filter_category') == $post_category->id) selected @endif>
											{{ $post_category->title }}
										</option>
									@endforeach
								</select>
								<button class="btn btn-primary">Filter</button>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</div>
						</form>
					</div>
					@foreach($posts as $post)
						<article id="post{{ $post->id }}" class="post {{ strtolower($post->category->title) }}" data-token="{{ csrf_token() }}">
							<h4 class="title">{{ $post->title }}</h4>
							<span class="category hidden" data-category-id="{{ $post->category->id }}"></span>
							<div class="amount">{{ $post->amount }}</div>
							<div class="tools">
								<a href="#" class="tool-wrapper edit" data-post-id="{{ $post->id }}" data-url="{{ route('post.edit', ['id'=>$post->id]) }}">
									<i class="fa fa-pencil"></i>
								</a>
								<div class="tool-wrapper delete" data-post-id="{{ $post->id }}" data-url="{{ route('post.delete', ['id'=>$post->id]) }}">
									<i class="fa fa-remove"></i>
								</div>
							</div>
							<span class="date">{{ $post->date }}</span>
						</article>
					@endforeach
				</div>

				<div class="col-md-3 statistics-container">
					{{--Statistics--}}
					<div class="statistics">
						<h3 class="title">Statistics</h3>
						<h4 class="subtitle">Total:</h4>
						<span>{{ $totalAmount }}</span>
						<br/>
						<div class="last-months-amount">
							<h4>All Months:</h4>
							@foreach($lastMonthsTotalAmount as $key => $amount)
								<div class="month-amount">
									<label>{{ $key }}</label><span>{{ $amount }}</span>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>

	{{--Edit Modal--}}
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form id="editForm" method="post" action="">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit Post</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="post-title">Title</label>
									<input class="form-control" type="text" id="post-title" name="post_title" value=""/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="post-category">Category</label>
									<select class="form-control" id="post-category" name="post_category">
										@foreach($post_categories as $post_category)
											<option value="{{ $post_category->id }}">{{ $post_category->title }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 no-padding">
								<div class="form-group">
									<label for="post-date">Date</label>
									<input class="form-control" type="date" id="post-date" name="post_date" value=""/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="post-amount">Amount</label>
									<input class="form-control" type="number" id="post-amount" name="post_amount" value=""/>
								</div>
							</div>
						</div>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="post-save">Save changes</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{--Delete Modal--}}
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Delete Post</h4>
				</div>
				<div class="modal-body">
					Are you sure you want to delete this post?
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-primary" id="post-delete">Save changes</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@endsection