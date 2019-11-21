<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Language;
use App\Localization;
use App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class GalleriesController extends Controller
{

    public function index() {

        
        return view('backend.gallery.index');
    }

    public function create() {
        
    }

    public function store(Request $request) {
        

    }

    
}
