<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StackedWithBooksBefore extends Controller
{
    public function BookShowBefore() {
        return view('Stack_home');
    }
}