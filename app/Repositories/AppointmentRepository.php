<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;

class AppointmentRepository
{

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $provider = Provider::find($request->provider_id);
            $data = $request->all();
            $data['institution_id'] = $provider->institution_id;
            Appointment::create($data);
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
}
