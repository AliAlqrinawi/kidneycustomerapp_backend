<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;

class ImageController extends Controller
{
    //
    public $image;
    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }

    public function uploadImage()
    {


        $photo = \Input::all();
        $response = $this->image->upload($photo, 'image');
        return $response;
    }
}
