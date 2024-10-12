<?php
namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\SectionTextsRequest;
use App\Repositories\SectionTextsRepository;

class SectionTextsController extends Controller
{
    private $section_texts;
    public function __construct(SectionTextsRepository $section_texts_repository)
    {
        $this->section_texts = $section_texts_repository;
    }

    public function edit($section)
    {

        $data['item'] = $this->section_texts->edit($section);


        return view('panel.section_texts.edit', $data);
    }

    public function update($section, SectionTextsRequest $request)
    {
        $response = $this->section_texts->update($section, $request);

        return $this->responseApi($response['status'], $response['message']);
    }



}
