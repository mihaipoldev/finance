<?php
/**
 * Created by PhpStorm.
 * User: Mihai Pol
 * Date: 11/14/2016
 * Time: 10:45 PM
 */

namespace App\Http\Controllers;

use App\Post;
use App\PostCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

	public function getIndex(Request $request)
	{
		$posts                 = Post::all();
		$totalAmount           = getTotalAmount();
		$lastMonthsTotalAmount = getLastMonthsTotalAmount();

		return view('index', [
			'posts'                 => $posts,
			'totalAmount'           => $totalAmount,
			'lastMonthsTotalAmount' => $lastMonthsTotalAmount
		]);
	}

	public function postIndex(Request $request)
	{
		$category = PostCategory::find(1);
		if ($request->has('filter_category') && $request->get('filter_category') != 0) {
			$category = PostCategory::find($request['filter_category']);
		}
		else {
			return redirect()->route('index');
		}

		$posts                 = Post::where('category_id', $category->id)->get();
		$totalAmount           = getTotalAmount($category);
		$lastMonthsTotalAmount = getLastMonthsTotalAmount($category);

		return view('index', [
			'category'              => $category,
			'posts'                 => $posts,
			'totalAmount'           => $totalAmount,
			'lastMonthsTotalAmount' => $lastMonthsTotalAmount
		]);
	}


	public function postCreate(Request $request)
	{
		// validation
		$post = new Post();

		$post->title       = $request['post_title'];
		$post->date        = $request['post_date'];
		$post->amount      = $request['post_amount'];
		$post->category_id = $request['post_category'];

		$request->user()->posts()->save($post);

		return redirect()->route('index');
	}

	public function postEdit($id, Request $request)
	{
		// validation
		$post = Post::find($id);

		$post->title       = $request['post_title'];
		$post->date        = $request['post_date'];
		$post->amount      = $request['post_amount'];
		$post->category_id = $request['post_category'];

		$post->save();

		return redirect()->back();
	}

	public function getDelete($id)
	{
		$post = Post::find($id);
		$post->delete();

		return redirect()->route('index')->with(['message' => 'Successfully deleted!']);
	}
}