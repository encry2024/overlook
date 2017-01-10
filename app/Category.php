<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name', 'min_capacity', 'max_capacity', 'price', 'description', 'file_location'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public static function updateCategory($updateCategoryRequest)
    {
        if(!$updateCategoryRequest->hasFile('fileToUpload')) {
            $category_image_location = "/pictures/image_null/image-not-available.png";
        } else {
            $category_image = $updateCategoryRequest->file('fileToUpload');
            $category_image->move(public_path() . '/pictures/rooms', $category_image->getClientOriginalName());
            $category_image_location = '/pictures/rooms/'.$category_image->getClientOriginalName();
        }

        $category = Category::find($updateCategoryRequest->get('category_id'));
        $category->update([
            'name' => ucwords($updateCategoryRequest->get('name'), ' '),
            'min_capacity' => $updateCategoryRequest->get('min_capacity'),
            'max_capacity' => $updateCategoryRequest->get('max_capacity'),
            'description' => ucfirst($updateCategoryRequest->get('description')),
            'price' => $updateCategoryRequest->get('price'),
            'file_location' => $category_image_location
        ]);

        $message = 'Category: ' . $category->name . ' was successfully updated';
        $alert_icon = 'check';
        $alert_type = 'success';

        return redirect()->back()->with('message', $message)->with('alert-icon', $alert_icon)->with('alert-type', $alert_type);
    }
}
