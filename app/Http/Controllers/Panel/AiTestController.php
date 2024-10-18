<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AiTestController extends Controller
{
    public function show($id)
    {
        $providers = Provider::get();
        return view('panel.ai_test.show' , compact("providers"));
    }

    public function getDataTable($id)
    {
        $data = [
            [
                "user_id" => $id,
                "test_number" => "22341231",
                "test_date" => "Aug 18, 2019",
                "test_aI_results" => "0",
                "test_ai_details" => "Details",
                "call" => "0",
                "notification" => "0",
                "chat" => "0",
                "appointment" => "0",
            ],
            [
                "user_id" => $id,
                "test_number" => "2234121",
                "test_date" => "Aug 18, 2024",
                "test_aI_results" => "0",
                "test_ai_details" => "Details",
                "call" => "0",
                "notification" => "0",
                "chat" => "0",
                "appointment" => "0",
            ],
            [
                "user_id" => $id,
                "test_number" => "2233559",
                "test_date" => "Aug 18, 2020",
                "test_aI_results" => "0",
                "test_ai_details" => "Details",
                "call" => "0",
                "notification" => "0",
                "chat" => "0",
                "appointment" => "0",
            ],
            [
                "user_id" => $id,
                "test_number" => "2244558",
                "test_date" => "Aug 18, 2018",
                "test_aI_results" => "0",
                "test_ai_details" => "Details",
                "call" => "0",
                "notification" => "0",
                "chat" => "0",
                "appointment" => "0",
            ],
            [
                "user_id" => $id,
                "test_number" => "2234534",
                "test_date" => "Aug 18, 2022",
                "test_aI_results" => "0",
                "test_ai_details" => "Details",
                "call" => "0",
                "notification" => "0",
                "chat" => "0",
                "appointment" => "0",
            ],
            [
                "user_id" => $id,
                "test_number" => "2234534",
                "test_date" => "Aug 18, 2022",
                "test_aI_results" => "0",
                "test_ai_details" => "Details",
                "call" => "0",
                "notification" => "0",
                "chat" => "0",
                "appointment" => "0",
            ],
            [
                "user_id" => $id,
                "test_number" => "2234534",
                "test_date" => "Aug 18, 2022",
                "test_aI_results" => "0",
                "test_ai_details" => "Details",
                "call" => "0",
                "notification" => "0",
                "chat" => "0",
                "appointment" => "0",
            ],
            [
                "user_id" => $id,
                "test_number" => "2234534",
                "test_date" => "Aug 18, 2022",
                "test_aI_results" => "0",
                "test_ai_details" => "Details",
                "call" => "0",
                "notification" => "0",
                "chat" => "0",
                "appointment" => "0",
            ],
        ];

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn("test_aI_results" , function(){
            return "<i class='bi bi-record-circle-fill' style='color: #ff69b4; font-size: 2rem; line-height: 0;'></i>";
        })
        ->addColumn("test_ai_details" , function(){
            return '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_test_ai_details">Details</a>';
        })
        ->editColumn("call" , function(){
            return '<i class="bi bi-telephone-fill" style="color: #000; font-size: 2rem; line-height: 0;"></i>';
        })
        ->editColumn("notification" , function(){
            return '<a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_notification"><i class="bi bi-bell-fill" style="color: #000; font-size: 2rem; line-height: 0;"></i></a>';
        })
        ->editColumn("chat" , function(){
            return '<i class="bi bi-chat-dots" style="color: #000; font-size: 2rem; line-height: 0;"></i>';
        })
        ->editColumn("appointment" , function($item){
            return '<a href="#" data-user_id="'.$item["user_id"].'" id="appointment" data-bs-toggle="modal" data-bs-target="#modal_appointment"><i class="bi bi-file-earmark-plus-fill" style="color: #000; font-size: 2rem; line-height: 0;"></i></a>';
        })
        ->rawColumns(["appointment" , "chat" , "notification" , "call" , "test_aI_results" , "test_ai_details"])
        ->make(true);
    }
}
