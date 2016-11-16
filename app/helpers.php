<?php

use App\Post;
use App\PostCategory;
use App\User;

function ceva(){
	return Post::find(3);
}


function getTotalAmount($category = null)
{
	$total = 0;
	$currentDate = new DateTime();

	$postsQuery = Post::where('date', '<', $currentDate);
	if($category) {
		$postsQuery->where('category_id', $category->id);
	}
	$posts = $postsQuery->get();

	foreach ($posts as $post) {
		$total += $post->amount;
	}
	return $total;
}

function getLastMonthsTotalAmount($category = null)
{
	$currentDate = new DateTime();
	$yearAgoDate = new DateTime();
	$yearAgoDate->modify('-366 days');

	$postsQuery = Post::orderBy('date', 'desc')->where('date', '<', $currentDate)->where('date', '>', $yearAgoDate);
	if($category) {
		$postsQuery->where('category_id', $category->id);
	}
	$posts = $postsQuery->get();

	$last12Months = [];
	foreach ($posts as $post) {
		$date = new DateTime($post->date);
		$last12Months[$date->format('F')] += $post->amount;
	}
	return $last12Months;
}
