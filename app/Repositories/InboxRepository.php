<?php

namespace App\Repositories;

use App\Models\VisitorMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Panel\MessageRequest;
use App\Mail\ReplayMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
use Yajra\DataTables\DataTables;

class InboxRepository
{

    public function getDataTable()
    {



        $data = VisitorMessage::select(
            'id',
            'name',
            'subject',
            'text',
            'email',
            'read_at',
            \DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date')
        )->orderByDesc('created_at')
            ->latest();
        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->filled('search')) {
                    $query->filter(request()->get('search'));
                }
            })
            ->addColumn("status", function ($item) {


                $title = __('dashboard.new');
                $class = 'badge badge-light-danger fw-bolder';
                if ($item->read_at != null) {
                    $title = __('dashboard.previously_seen');
                    $class = 'badge badge-light-success fw-bolder';

                }
                return '<span class="' . $class . '">' . $title . '<span>';
            })
            ->addColumn("action", function ($item) {
                $return =
                    '<a href="' . route("panel.inbox.view.index", ["id" => $item->id]) . '"
                                class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 edit-new-mdl"
                               >
                              <i class="bi bi-eye fs-3"></i>
                            </a>';
                $return .= '
                                <a
                                href="javascript:void(0)"
                                data-url="' . route("panel.inbox.delete", ["id" => $item->id]) . '"
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
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function view($id)
    {
        $data['item'] = VisitorMessage::find($id);
        if (isset($data['item'])) {
            $data['item']->update(['read_at' => Carbon::now()]);
        } else {
            abort(404);
        }

        return $data;
    }



    public function delete($id)
    {
        $item = VisitorMessage::find($id);
        if ($item) {
            $item->delete();
            $message = __('delete_done');
            $status = true;
            $response = [
                'message' => $message,
                'status' => $status,
            ];
            return $response;
        }
        $message = __('message_error');
        $status = false;

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }

    public function replay($id, $request)
    {
        DB::beginTransaction();
        try {

            $message = VisitorMessage::find($id);

            // $setting = new Setting();
            // $title = 'Reply to your message from ' . $setting->valueOf('title_en');
            // Mail::to($message->email)->send(new ReplayMail($title, $request->text, $message->email));

            $message->replay($request);

            DB::commit();
            $message = __('message.operation_accomplished_successfully');
            $status = true;
        } catch (\Exception $e) {
            $message = __('message.unexpected_error');
            $status = false;
            DB::rollback();
        }

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }
    public function save($request)
    {

        DB::beginTransaction();

        try {

            $item = VisitorMessage::updateOrCreate(['id' => 0], $request->all());


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