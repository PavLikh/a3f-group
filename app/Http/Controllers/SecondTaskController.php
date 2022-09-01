<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SecondRequest;

class SecondTaskController extends Controller
{
    public function index() {
        return view('task2', ['data' => 0]);
    }

    public function sortArr(SecondRequest $req) {
        // dd($req->input('length'));
        $array = [];
        for($i = 0; $i < $req->input('length'); $i++) {
            $array[$i] = rand(0, 100);
        }
        // dd($array);
        // $array = [3,2,8];
        $arrayBase = $array;
        ft_array_sort($array);
        return view('task2', ['data' =>
                [
                    $arrayBase, $array
                ]
        ]);
    }
}
