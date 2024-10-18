<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AppointmentRequest;
use App\Repositories\AppointmentRepository;

class AppointmentsController extends Controller
{
    private $appointment;
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointment = $appointmentRepository;
    }

    public function store(AppointmentRequest $request)
    {
        $response = $this->appointment->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }
}
