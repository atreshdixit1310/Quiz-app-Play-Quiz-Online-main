<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    private static $category, $image, $imageName, $directory, $imgURL;
    use HasFactory;

    public static function saveCategory($request){
        $category = new self();
        $category->cat_name = $request->cat_name;
        $category->cat_anim = $request->cat_anim;
        $category->cat_img = self::saveImage($request);
        $category->save();
    }

    private static function saveImage($request){
        self::$image = $request->file('cat_img');
        self::$imageName = rand().'.'. self::$image->getClientOriginalExtension();
        self::$directory = 'images/';
        self::$imgURL =  self::$directory. self::$imageName;
        self::$image->move( self::$directory. '/' .self::$imageName);
        return  self::$imgURL;
    }
}
