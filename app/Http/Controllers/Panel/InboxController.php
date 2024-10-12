<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\MessageRequest;
use App\Repositories\InboxRepository;


class InboxController extends Controller
{
       private $inbox;
    public function __construct(InboxRepository $Inbox_repository)
    {

        $this->inbox = $Inbox_repository;
    }


    public function index() {

        return view('panel.inbox.all');

    }

    public function getDataTable(){

      return $this->inbox->getDataTable();

    }

    public function view($id) {

        $data=$this->inbox->view($id);

        return view('panel.inbox.view', $data);
    }



    public function delete($id) {
        $response = $this->inbox->delete($id);
        return $this->responseApi($response['status'], $response['message']);
    }

    public function replay($id, MessageRequest $request) {

        $response = $this->inbox->replay($id,$request);

        return $this->responseApi($response['status'], $response['message']);

    }

}
