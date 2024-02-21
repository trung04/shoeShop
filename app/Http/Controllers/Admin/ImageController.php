<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function index()
    {
        return view('be.image.index');
    }
    public function add()
    {
        return view('be.image.add');
    }
}
