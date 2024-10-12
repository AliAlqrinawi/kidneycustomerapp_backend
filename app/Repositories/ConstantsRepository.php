<?php

namespace App\Repositories;

use App\Models\Constant;
use Yajra\DataTables\DataTables;

class ConstantsRepository
{

    public function getAll($parent)
    {
        $data = Constant::select("id", "parent", "value","created_at")
            ->with('translations:constant_id,name,locale')
            ->orderByDesc("created_at")
            ->where('parent', $parent)
            ->get();

        return $data;
    }
    public function getDataTable($parent)
    {
        $data = Constant::select("id", "parent")
            ->with('translations:constant_id,name,locale')
            ->orderByDesc("created_at")
            ->where('parent', $parent)
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
                    '<a href="' . route("panel.constants.edit.index", ["id" => $item->id, 'parent' => $item->parent]) . '"
                                class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 edit-new-mdl"
                               >
                                <!--begin::Svg Icon | path: icons/duotone/Interface/Settings-02.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                                <a
                                href="javascript:void(0)"
                                data-url="' . route("panel.constants.delete", ["id" => $item->id, 'parent' => $item->parent]) . '"
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


    public function store($request, $parent)
    {

        $request['parent'] = $parent;

        $value = Constant::select('id', 'key', 'parent', 'value')
            ->where('parent', $parent)->withTrashed()
            ->max('value');

        $request['value'] = $value + 1;

        Constant::updateOrCreate(['id' => 0], $request->all())->createTranslation($request);

        $message = __("message.operation_accomplished_successfully");
        $status = true;

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }

    public function edit($id, $parent)
    {

        $data['item'] = Constant::where('id', $id)
            ->where('parent', $parent)
            ->first();
        if ($data['item'] == '') {
            abort(404);
        }

        return $data;
    }

    public function update($id, $parent, $request)
    {
        Constant::updateOrCreate(['id' => $id], $request->all())->createTranslation($request);

        $message = __("message.operation_accomplished_successfully");
        $status = true;

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }


    public function delete($id, $parent)
    {
        $item = Constant::find($id);
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
