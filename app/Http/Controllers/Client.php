<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Client extends Controller
{
    public function index(){

        return response()->json(['message' => 'Client is working']);

    }
}
