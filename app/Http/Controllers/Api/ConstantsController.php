<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ConstantsRepository;
use App\Http\Resources\Constants\ConstantsResource;
use App\Traits\ResponseTrait;


class ConstantsController extends Controller
{
    //
    use ResponseTrait;

    private $constants;

    public function __construct(ConstantsRepository $constants)
    {
        $this->constants = $constants;
    }

    public function getAll($parent, Request $request)
    {
        $items = $this->constants->getAll($parent);

        return $this->successResponse(
            __('done'),
            200,
            true,
            [
                'items' => ConstantsResource::collection($items)
            ]
        );


    }
}
