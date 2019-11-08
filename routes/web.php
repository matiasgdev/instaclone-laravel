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

Route::get('/configuracion', 'UserController@config')->name('config');

Route::post('/user/edit', 'UserController@update')->name('user.update');

Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');

Route::get('/subir-imagen/', 'ImageController@create')->name('image.create');

Route::post('/image/save', 'ImageController@save')->name('image.save');

Route::get('/post/file/{filename}', 'ImageController@getImage')->name('image.file');

Route::get('/post/{id}', 'ImageController@detail')->name('image.detail');

Route::post('/comment/save', 'CommentController@save')->name('comment.save');

Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');

Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');

Route::get('/likes', 'LikeController@index')->name('like.index');



