<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecondTaskController extends Controller
{
    public function index() {
        $array = [4, 5, 8, 9, 1, 7, 2];
        return view('task2', ['data' => array_swap($array, 3)]);
    }
}
