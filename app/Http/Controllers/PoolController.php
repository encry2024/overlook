<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pool;

class PoolController extends Controller
{
    //
    public function index()
    {
        $pools = Pool::all();

        return view('pool.index', compact('pools'));
    }
}
