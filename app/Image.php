<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images'; //indicar tabla

    // Relacion One to Many
    public function comments() {
			return $this->hasMany('App\Comment');
		}
		
		//Relacion One to Many
		public function likes() {
			return $this->hasMany('App\Like');
		}

		//Relacion Many to One
		public function user() {
			return $this->belongsTo('App\User', 'user_id');
		}
		

}
