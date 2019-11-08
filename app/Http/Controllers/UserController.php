<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller {

	//redirect 
	public function __construct() {
		$this->middleware('auth');
	}

	public function config() {

		return view('user.config');
	}

	public function update(Request $request) {

		$user = \Auth::user();

		$id = $user->id;

		$validate = $this->validate($request, [
				'name' => ['required', 'string', 'max:255'],
				'surname' => ['required', 'string', 'max:255'],
				'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id],
				'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
		]);

		$name = $request->input('name');
		$surname = $request->input('surname');
		$email = $request->input('email');
		$nick = $request->input('nick');

		

		// update
		$user->name = $name;
		$user->surname = $surname;
		$user->nick = $nick;
		$user->email = $email;

		//update image
		$image_path = $request->file('image_path');
		
		if ($image_path) {
			//unique name
			$image_path_name = time().$image_path->getClientOriginalName();
			//save on storage folder "storage/app/users"
			Storage::disk('users')->put($image_path_name, File::get($image_path));
			//set image's name in object
			$user->image = $image_path_name;
		}


		$user->update();

		return redirect()
			->route('config')
			->with(['message' => 'Usuario actualizado correctamente']);

	}

	public function getImage($filename) {
		$file = Storage::disk('users')->get($filename);

		return new Response($file, 200);
	}
}
