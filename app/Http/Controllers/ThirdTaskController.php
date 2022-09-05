<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ThirdRequest;
use App\Services\ParseHtmlService;

class ThirdTaskController extends Controller
{
    public function index() {
        return view('task3');
    }

    public function showHtmlTags(ThirdRequest $req, ParseHtmlService $service) {
        $response = Http::get($req->input('url'));
        $html = $response->body();
        $data = $service->start($html, 'getTegs');

        return view('task3')->withData($data);
    }
}
