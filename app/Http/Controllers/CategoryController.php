<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Room;
use App\Http\Requests\UpdateCategoryRequest;

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

    public function updateCategory(UpdateCategoryRequest $updateCategoryRequest)
    {
        $updateCategory = Category::updateCategory($updateCategoryRequest);

        return $updateCategory;
    }

    public function editCategory(Category $category)
    {
        return view('room_category.edit', compact('category'));
    }

    public function deleteCategory(Category $category)
    {
        if($category->delete()) {
            return redirect()->route('room_category_index')->with('message', 'You have successfully deleted ' . $category->name . ' Category');
        }
    }
}
