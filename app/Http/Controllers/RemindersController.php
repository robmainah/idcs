<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemindersController extends Controller
{
    public function index () {

    	return view('pages.reminders');
    }
}
