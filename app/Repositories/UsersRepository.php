<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UsersRepository
{

    public function getDataTable()
    {
        $data = User::select("id", "name", "email" , "created_at")
            ->orderByDesc("created_at")
            ->latest();

        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->filled('search')) {
                    $query->filter(request()->get('search'));
                }
            })
            ->editColumn("created_at" , function($item){
                return changeDateFormate($item->created_at);
            })
            ->addColumn("ai_results" , function($item){
                return "<i class='bi bi-record-circle-fill' style='color: #ff69b4; font-size: 2rem; line-height: 0;'></i>";
            })
            ->addColumn("ai_tests" , function($item){
                return '<a href="' . route("panel.aiTest.show.index" , ["id" => $item->id]) . '"
                            class="btn btn-icon btn-active-light-primary w-30px h-30px edit-new-mdl">
                            <span class="svg-icon svg-icon-3">
                                <i class="bi bi-file-earmark-bar-graph-fill" style="color: #83C1F1; font-size: 2rem; line-height: 0;"></i>
                            </span>
                        </a>';
            })
            ->addColumn("action", function ($item) {
                $return =
                    '<a href="' . route("panel.users.edit.index", ["id" => $item->id]) . '"
                                class="btn btn-icon btn-active-light-primary w-30px h-30px me-2 edit-new-mdl"
                               >
                                <!--begin::Svg Icon | path: icons/duotone/Interface/Settings-02.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="' . route("panel.aiTest.show.index" , ["id" => $item->id]) . '"
                                class="btn btn-icon btn-active-light-primary w-30px h-30px edit-new-mdl">
                                <span class="svg-icon svg-icon-3">
                                    <i class="bi bi-exclamation-circle"></i>
                                </span>
                            </a>
                                <a
                                href="javascript:void(0)"
                                data-url="' . route("panel.users.delete", ["id" => $item->id]) . '"
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
            ->rawColumns(["created_at" , "ai_results" , "ai_tests" , "action"])
            ->make(true);
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {


            if (filled($request['password'])) {
                $request['password'] = Hash::make($request['password']);
            }

            $user = User::create($request->all());

            DB::commit();
            $message = __("message.operation_accomplished_successfully");
            $status = true;
        } catch (\Exception $e) {
            $message = __("message.unexpected_error");
            $status = false;
            DB::rollback();
        }

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }

    public function edit($id)
    {
        $item = User::find($id);

        return $item;
    }




    public function update($id, $request)
    {
        DB::beginTransaction();
        try {

            if (!filled($request->image)) {
                $request->image = 'users\avatar.png';
            }

            if (($request['password']) != null) {
                $request['password'] = Hash::make($request['password']);
            } else {
                unset($request['password']);
            }
            $user = User::find($id);

            if (isset($user)) {
                $user->update($request->all());
            }

            DB::commit();
            $message = __("message.operation_accomplished_successfully");
            $status = true;
        } catch (\Exception $e) {
            $message = __("message.unexpected_error");
            $status = false;
            DB::rollback();
        }

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }

    public function delete($id)
    {
        $item = User::find($id);
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


    public function getById($id)
    {
        return User::find($id);
    }
    public function updateProfile($request, $user_id)
    {
        $user = $this->getById($user_id);
        $user->update($request->all());
        return $response = [
            'message' => __('message.modified_successfully'),
            'status' => true,
        ];
    }
    public function chnagePassword($request, $user, $is_web = true)
    {
        DB::beginTransaction();

        try {

            $current_password = $request->get('current_password');
            $new_password = $request->get('new_password');

            //check old password
            if (!Hash::check($current_password, $user->getAuthPassword())) {
                return $response = [
                    'message' => __('message.worng_current_password'),
                    'status' => false,
                ];
            }

            $user->password = Hash::make($new_password);
            $user->update();


            $message = __('message.operation_accomplished_successfully');
            $status = true;

            $response = [
                'message' => $message,
                'status' => $status,
            ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $message = __('message.unexpected_error');
            $status = false;
            $response = [
                'message' => $message,
                'status' => $status,
            ];
        }
        return $response;
    }

}
