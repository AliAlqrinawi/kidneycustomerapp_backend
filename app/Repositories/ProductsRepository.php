<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockLog;
use Yajra\DataTables\DataTables;
use App\Repositories\StockLogRepository;
use App\Http\Resources\Products\ProductResource;

class ProductsRepository
{

    private $stock_log;

    public function __construct(
        StockLogRepository $stock_log_repository
    ) {
        $this->stock_log = $stock_log_repository;
    }

    public function getByPaginate($request)
    {
        $page_number = \request()->get('page_number') ?? 1;
        $page_size = \request()->get('page_size') ?? 10;
        $is_paginate = \request()->get('is_paginate') ?? true;

        $category_id = $request->get('category_id');

        $title = $request->get('title');

        $items = Product::with('category')
            ->orderByDesc('created_at')
            ->where('is_active', 1);


        if ($category_id != '') {
            $items = $items->where('category_id', $category_id);
        }
        if ($title != '') {
            $items = $items->whereHas('translations', function ($q) use ($title) {
                return $q->where('title', 'like', '%' . $title . '%')
                    ->orWhere('text', 'like', '%' . $title . '%');
            });
        }

        ///////////////
        $data['category_id'] = $category_id;
        $data['title'] = $title;



        if ($is_paginate == true) {
            $total_records = $items->count();
            $total_pages = ceil($total_records / $page_size);
            $items = $items->skip(($page_number - 1) * $page_size)
                ->take($page_size)->get();

            $data['page_number'] = $page_number;
            $data['total_pages'] = $total_pages;
            $data['total_records'] = $total_records;
        } else {
            $items = $items->get();
        }
        $data['items'] = ProductResource::collection($items);

        return $data;

    }

    public function getDataTable()
    {
        $data = Product::select("id", "quantity_available", "price")
            ->with('translations:product_id,title,locale')
            ->orderByDesc("created_at")
            ->latest();
        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->filled('search')) {
                    $query->filter(request()->get('search'));
                }
            })
            ->addColumn("action", function ($item) {
                $return =
                    '<a href="' . route("panel.products.edit.index", ["id" => $item->id]) . '"
                                class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 edit-new-mdl"
                               >
                                <!--begin::Svg Icon | path: icons/duotone/Interface/Settings-02.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </a>';
                $return .= '
                                <a
                                href="javascript:void(0)"
                                data-url="' . route("panel.products.delete", ["id" => $item->id]) . '"
                                class="btn btn-icon btn-active-light-primary w-30px h-30px delete-item" >
                                <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <path
                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>';

                return $return;
            })
            ->rawColumns(["action"])
            ->make(true);
    }





    public function store($request)
    {

        $product = Product::updateOrCreate(['id' => 0], $request->all())->createTranslation($request);

        if ($request->quantity) {
            $this->stock_log->add($product->id, StockLog::ADD, $request->quantity);
        }

        $message = __("message.operation_accomplished_successfully");
        $status = true;

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }

    public function edit($id)
    {

        $item = Product::where('id', $id)->first();
        if ($item == '') {
            abort(404);
        }

        return $item;
    }




    public function update($id, $request)
    {
        $product = Product::updateOrCreate(['id' => $id], $request->all())->createTranslation($request);

        if ($request->quantity) {
            $this->stock_log->add($product->id, StockLog::ADD, $request->quantity);
        }

        $message = __("message.operation_accomplished_successfully");
        $status = true;

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }


    public function delete($id)
    {
        $item = Product::where('id', $id)->first();
        if ($item) {
            $item->delete();
            $message = __('message.deleted_successfully');
            $status = true;
            $response = [
                'message' => $message,
                'status' => $status,
            ];
            return $response;
        }
        $message = __("message.unexpected_error");
        $status = false;

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }
}
