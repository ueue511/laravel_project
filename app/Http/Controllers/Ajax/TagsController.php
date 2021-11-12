<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index() {
        return \App\tag::all();
    }
}