<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\UserCompetition;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;

class ImageHandlerController
{
    public function getPublicImage($size, $path, $id)
    {

        $id = str_replace('-', '/', $id);

        $path = storage_path('app/uploads/images/' . $path . '/' . $id);

        if (!File::exists($path)) {
            $path = public_path('assets/default_image.jpg');
        }

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $sizes = explode("x", $size);

        if (is_numeric($sizes[0]) && is_numeric($sizes[1])) {

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($file);

            $image->resize($sizes[0], $sizes[1], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $response = Response::make($image->encodeByMediaType(), 200);

            $response->header("CF-Cache-Status", 'HIF');
            $response->header("Cache-Control", 'max-age=604800, public');
            $response->header("Content-Type", $type);

            return $response;
        } else {
            abort(404);
        }
    }


    public function getDefaultImage($path, $id)
    {

        $id = str_replace('-', '/', $id);

        $path = storage_path('app/uploads/images/' . $path . '/' . $id);

        if (!File::exists($path)) {
            $path = public_path('assets/default_image.jpg');
        }

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);


        if ($type != 'image/svg') {
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($file);

            //base64_decode
            $response = Response::make($image->encodeByMediaType(), 200);
            $response->header("CF-Cache-Status", 'HIF');
            $response->header("Cache-Control", 'max-age=604800, public');
            $response->header("Content-Type", $type);
            return $response;
        } else {
            return response([$file], 200);
        }
    }

}
