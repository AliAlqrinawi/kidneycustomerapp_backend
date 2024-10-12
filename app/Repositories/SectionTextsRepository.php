<?php

namespace App\Repositories;

use App\Models\SectionText;
use Yajra\DataTables\DataTables;

class SectionTextsRepository
{

    public function edit($section)
    {

        $item = SectionText::where('section', $section)->first();
        if ($item == '') {
            abort(404);
        }

        return $item;
    }

    public function update($section, $request)
    {
        $request['section'] = $section;
        SectionText::updateOrCreate(['section' => $section], $request->all())->createTranslation($request);

        $message = __("message.operation_accomplished_successfully");
        $status = true;

        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }

}
