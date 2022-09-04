<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ThirdRequest;

class ThirdTaskController extends Controller
{
    public function index() {
        $response = Http::get('http://my01.st/');
        $html = $response->body();
        // dd($response->body());
        // dd(strlen($response));
        $array = [];
        $i = 0;
        $teg_nb = 0;
        $k = 0;
        $start = -1;
        $end = -1;
        while($i < strlen($html)){
            if($html[$i] == '<' && ($html[$i+1] != ' ' && $html[$i+1] != '!' && $html[$i+1] != '/')){
                $start = 1;
                // echo 'asdasdasd<br>';
            }
            if($start == 1){
                if(!($html[$i] == '<' && $k == 0)){
                    $array[$teg_nb][$k++] = $html[$i];
                }
                // if ($html[$i] == '<' && $k-1 >  0) {
                //     $k = 0;
                // }
            }
            if($start > 0 && ($html[$i] == '>' || $html[$i] == ' ')){
                $start = -1;
                $teg_nb++;
                $k = 0;
            }
            $i++;
        }
        // dd($array);
        return view('task3');
    }

    public function showHtmlTags(ThirdRequest $req) {
        return view('task3');
    }
}
