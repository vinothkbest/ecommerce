<?php
namespace App\Helper;
use Str;
use Image;
use Illuminate\Support\Facades\Storage;
Class BlogClass{
	public static function seo($object, $formdata, $path, $image){
		$object->title = ucfirst($formdata->input('seo-title'));
        $object->keyword = strtolower($formdata->keyword);
        $object->description = $formdata->description;
        if(!empty($image)) self::image($object, $image, $path);
	}
	public static function image($object, $image, $path){
        $fileName   = uniqid() . '.' . $image->extension();
        $img = Image::make($image->getRealPath());
        $img->resize(256, 256, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        Storage::disk('local')->put($path . '/'.$fileName, $img);
        $object->image=$fileName;
	}
	
}
?>