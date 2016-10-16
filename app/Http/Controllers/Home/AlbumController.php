<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Redirect;
use Hash;
use Auth;

class AlbumController extends Controller {
	public function index() {
		return view('home.album.index');
	}
}
