<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();

        return view('room_category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('room_category.show', compact('category'));
    }

    public function showRooms(Category $category)
    {
        return view('room_category.rooms', compact('category'));
    }
}
