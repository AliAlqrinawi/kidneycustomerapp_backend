<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PostsRepository;
use App\Http\Resources\Posts\PostResource;
use App\Traits\ResponseTrait;

class PostsController extends Controller
{
    //

    use ResponseTrait;

    private $posts;

    public function __construct(PostsRepository $posts)
    {
        $this->posts = $posts;
    }

    public function all(Request $request)
    {
        $data = $this->posts->getByPaginate($request);

        return $this->successResponse(
            __('done'),
            200,
            true,
            $data
        );


    }

    public function single($id)
    {
        $item = $this->posts->edit($id);

        return $this->successResponse(
            __('done'),
            200,
            true,
            [
                'item' => new PostResource($item)
            ]
        );


    }

}
