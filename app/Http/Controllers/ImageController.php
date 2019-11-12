<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
  public function __construct() {
		$this->middleware('auth');
	}


	public function create() {
		return view('image.create');
	}

	public function save(Request $request) {


		$validate = $request->validate([
			'image_path' => ['required', 'image'],
			'description' => ['required', 'min:5']
		]);
		
		$image_path = $request->file('image_path');
		$description = $request->input('description');

		//create object
		$image = new Image();
		
		$user = \Auth::user();

		$image->user_id = $user->id;
			
		$image->description = $description;

		//upload

		if ($image_path) {
			$image_path_name = time().$image_path->getClientOriginalName();
			Storage::disk('images')->put($image_path_name, File::get($image_path));
			$image->image_path = $image_path_name;
		}
		
		$image->save();

		return redirect()
			->route('home')
			->with([
				'message' => 'La foto fue cargada correctamente'
			]);
		
	}

	public function getImage($filename) {
		$file = Storage::disk('images')->get($filename);

		return new Response($file, 200);
	}

	public function detail($id) {
		$image = Image::find($id);

		return view('image.detail', [
			'image' => $image
		]);
	}

	public function delete($id) {
		$user = \Auth::user();
		$image = Image::find($id);
		$comments = Comment::where('image_id', $id)->get();
		$likes = Like::where('image_id', $id)->get();

		if ($user && $image && $image->user->id == $user->id) {
			//delete comments
			if ($comments && count($comments) >= 1) {
				foreach($comments as $comment) {
					$comment->delete();
				}
			}
			//delete likes
			if ($likes && count($likes) >= 1) {
				foreach($likes as $like) {
					$like->delete();
				}
			}
			//delete image's file
			Storage::disk('images')->delete($image->image_path);
			//delete db register
			$image->delete();

			$message = array('message' => 'Imagen borrada correctamente');
		} else {
				$message = array('message' => 'La imagen no se ha borrado');
		}

		return redirect()->route('home')->with($message);
	}

	public function edit($id) {
		$user = \Auth::user();
		$image = Image::find($id);

		if ($user && $image && $image->user->id === $user->id) {
			return view('image.edit', ['image' => $image]);
		} else {
				return redirect()->route('home');
		}

	}

	public function update(Request $request) {

		$validate = $request->validate([
			'image_id' => ['required'],
			'image_path' => ['image'],
			'description' => ['required', 'min:5']
		]);

		$image_id = $request->input('image_id');
		$image_path = $request->file('image_path');
		$description = $request->input('description');

		//Get image object
		$image = Image::find($image_id);
		$image->description = $description;


		if ($image_path) {
			$image_path_name = time().$image_path->getClientOriginalName();
			Storage::disk('images')->put($image_path_name, File::get($image_path));
			$image->image_path = $image_path_name;
		}

		$image->update();

		return redirect()->route('image.detail', ['id' => $image_id]);
		
	}
} 
