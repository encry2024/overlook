<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pool extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name', 'min_capacity', 'max_capacity', 'file_location', 'description', 'price'];

    public static function updatePool($updatePoolRequest)
    {
        if(!$updatePoolRequest->hasFile('fileToUpload')) {
            $pool_image_location = "/pictures/image_null/image-not-available.png";
        } else {
            $pool_image = $updatePoolRequest->file('fileToUpload');
            $pool_image->move(public_path() . '/pictures/pools', $pool_image->getClientOriginalName());
            $pool_image_location = '/pictures/pools/'.$pool_image->getClientOriginalName();
        }

        $pool = Pool::find($updatePoolRequest->get('pool_id'));
        $pool->update([
            'name' => $updatePoolRequest->get('name'),
            'min_capacity' => $updatePoolRequest->get('min_capacity'),
            'max_capacity' => $updatePoolRequest->get('max_capacity'),
            'file_location' => $pool_image_location,
            'description' => $updatePoolRequest->get('description'),
            'price' => $updatePoolRequest->get('price')
        ]);

        $message = 'Pool: ' . $pool->name . ' was successfully updated';
        $alert_icon = 'check';
        $alert_type = 'success';

        return redirect()->back()->with('message', $message)->with('alert-icon', $alert_icon)->with('alert-type', $alert_type);
    }
}
