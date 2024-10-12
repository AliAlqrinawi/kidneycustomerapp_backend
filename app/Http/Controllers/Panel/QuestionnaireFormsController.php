<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\QuestionnaireFormsRequest;
use App\Repositories\QuestionnaireFormsRepository;

class QuestionnaireFormsController extends Controller
{
    private $questionnaire_forms;


    public function __construct(
        QuestionnaireFormsRepository $questionnaire_forms_repository
    ) {
        $this->questionnaire_forms = $questionnaire_forms_repository;
    }


    public function index(Request $request)
    {
        return view('panel.questionnaire_forms.all');
    }


    public function getDataTable()
    {
        return $this->questionnaire_forms->getDataTable();
    }

    public function create()
    {
        return view('panel.questionnaire_forms.create');
    }

    public function store(QuestionnaireFormsRequest $request)
    {


        $response = $this->questionnaire_forms->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($id)
    {

        $data['item'] = $this->questionnaire_forms->edit($id);

        return view('panel.questionnaire_forms.create', $data);
    }

    public function update($id, QuestionnaireFormsRequest $request)
    {
        $response = $this->questionnaire_forms->update($id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }


    public function delete($id)
    {
        $response = $this->questionnaire_forms->delete($id);
        return $this->responseApi($response['status'], $response['message']);
    }


    public function renderFilds(Request $request)
    {
        $response = $this->questionnaire_forms->renderFilds($request);

        return $this->responseApi($response['status'], $response['message'], $response['items']['html']);
    }
}
