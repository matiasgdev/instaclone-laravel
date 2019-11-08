<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class HomeController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$images = Image::orderBy('id', 'desc')->paginate(5);
			
		return view('home', ['images' => $images]);
		
	}
}
