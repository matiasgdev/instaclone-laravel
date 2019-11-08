<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function save(Request $request) {

		$validate = $request->validate([
			'image_id' => ['required', 'integer'],
			'comment' => ['required']
		]);

		$user = \Auth::user();

		$image_id = $request->input('image_id');
		$commentContent = $request->input('comment');

		$comment = new Comment();

		$comment->user_id = $user->id;
		$comment->image_id = $image_id;
		$comment->content = $commentContent;

		//save comment
		$comment->save();

		//redirect
		return redirect()
			->route('image.detail', ['id' => $image_id]);


	}

	public function delete($id) {
		//data of authenticated user
		$user = \Auth::user();

		//get object comment
		$comment = Comment::find($id);

		// Check if I own the comment or post
		if ($user && ($comment->user_id == $user->id || $comment->image->user_id  == $user->id)) {
			
			$comment->delete();

			return redirect()
				->route('image.detail', ['id' => $comment->image->id]);
		} else {
			return redirect()
				->route('image.detail', ['id' => $comment->image->id]);
		}
	}

}
