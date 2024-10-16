<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminRepository
{

    public function getDataTable($type = "admins")
    {
        $data = Admin::when($type == "admins", function ($query) {
            $query->select("id", "name", "email");
        }, function ($query) {
            $query->select("id", "name", "email", "phone", "description");
        })->orderByDesc("created_at")
            ->latest();

        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->filled('search')) {
                    $query->filter(request()->get('search'));
                }
            })
            ->editColumn('description', function ($row) {
                $description = '<textarea class="form-control" disabled="" style="width:250px; display:inline;">' . $row->description . '</textarea>';
                return $description;
            })
            ->addColumn("action", function ($item) use($type) {
                $return =
                    '<a href="' . route("panel.".$type.".edit.index", ["id" => $item->id]) . '"
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
                                data-url="' . route("panel.".$type.".delete", ["id" => $item->id]) . '"
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
            ->rawColumns(["description", "action"])
            ->make(true);
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {


            if (filled($request['password'])) {
                $request['password'] = Hash::make($request['password']);
            }

            //role
            $role_id = $request->get('role_id');
            $role = Role::find($role_id);



            $admin = Admin::create($request->all());

            $admin->assignRole($role);

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
        $data['item'] = Admin::find($id);
        $data['roles'] = DB::table('roles')->where("show", 1)->get();

        return $data;
    }




    public function update($id, $request)
    {
        DB::beginTransaction();
        try {

            if (!filled($request->image)) {
                $request->image = 'admins\avatar.png';
            }

            if (($request['password']) != null) {
                $request['password'] = Hash::make($request['password']);
            } else {
                unset($request['password']);
            }
            $admin = Admin::find($id);

            if (isset($admin)) {

                //role
                $role_id = $request->get('role_id');
                $role = Role::find($role_id);
                $admin->roles()->detach();
                $admin->assignRole($role);
                $admin->update($request->all());
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
        $item = Admin::find($id);
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
        return Admin::find($id);
    }
    public function updateProfile($request, $admin_id)
    {
        $admin = $this->getById($admin_id);
        $admin->update($request->all());
        return $response = [
            'message' => __('message.modified_successfully'),
            'status' => true,
        ];
    }
    public function chnagePassword($request, $admin, $is_web = true)
    {
        DB::beginTransaction();

        try {

            $current_password = $request->get('current_password');
            $new_password = $request->get('new_password');

            //check old password
            if (!Hash::check($current_password, $admin->getAuthPassword())) {
                return $response = [
                    'message' => __('message.worng_current_password'),
                    'status' => false,
                ];
            }

            $admin->password = Hash::make($new_password);
            $admin->update();


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
