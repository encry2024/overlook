<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pool;
use App\Http\Requests\UpdatePoolRequest;

class PoolController extends Controller
{
    //
    public function index()
    {
        $pools = Pool::all();

        return view('pool.index', compact('pools'));
    }

    public function showPool(Pool $pool)
    {
        return view('pool.show', compact('pool'));
    }

    public function editPool(Pool $pool)
    {
        return view('pool.edit', compact('pool'));
    }

    public function updatePool(UpdatePoolRequest $updatePoolRequest)
    {
        $updatePool = Pool::updatePool($updatePoolRequest);

        return $updatePool;
    }

    public function deletePool(Pool $pool)
    {
        if($pool->delete()) {
            return redirect()->route('pool_index')->with('message', 'You have successfully deleted ' . $pool->name);
        }
    }
}
