<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class FirstTaskController extends Controller
{
    public function index() {
        $contacts = Contact::all();
        // dd($contacts);
        // $a = array_swap();
        return view('task1', ['data' => $contacts]);
        // return view('task1', ['data' => [$a]]);
    }
}
