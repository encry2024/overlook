<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Room;

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

    public function createRoom(Category $category)
    {
        return view('room_category.create_room', compact('category'));
    }

    public function postCreate(Request $request, Category $category)
    {
        $post_create = Room::postCreate($request, $category);

        return $post_create;
    }
}
