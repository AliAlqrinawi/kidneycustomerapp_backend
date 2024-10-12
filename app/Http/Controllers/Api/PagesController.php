<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PagesRepository;
use App\Http\Resources\Pages\PageResource;
use App\Traits\ResponseTrait;
class PagesController extends Controller
{
    //

    use ResponseTrait;

    private $pages;

    public function __construct(PagesRepository $pages)
    {
        $this->pages = $pages;
    }

    public function single($slug)
    {
        $item = $this->pages->getBySlug($slug);

        return $this->successResponse(
            __('done'),
            200,
            true,
            [
                'item' => new  PageResource($item)
            ]
        );


    }

}
