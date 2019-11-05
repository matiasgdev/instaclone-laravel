<?php

// use App\Image;

Route::get('/', function () {

		/*
		$images = Image::all();
		foreach($images as $image) {
			echo $image->image_path . '<br>';
			echo $image->description . '<br>';
			echo $image->user->name . ' ' .  $image->user->surname . '<br>';

			if (count($image->comments) >= 1) {
				echo "<strong>Comentarios:</strong> <br>";
				foreach($image->comments as $comment) {
					echo $comment->user->name . ': ' . $comment->content . '<br>';
				}
			}

			if (count($image->likes) >= 1) {
				echo "<p>Likes: " . count($image->likes) .  "</p>";
			}

			echo "<hr>";
		}
		exit();
		*/

    return view('welcome');
});



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
