<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{

    public function getVideoLink($link)
    {

        $link = str_replace('-', '/', $link);

        $path = storage_path("app/uploads/files/" . $link);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header('Content-Type', "video/mp4");
        return $response;

    }

    public function getFileLink($link)
    {

        $link = str_replace('-', '/', $link);

        $path = storage_path("app/uploads/files/" . $link);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("CF-Cache-Status", 'HIF');
        $response->header("Cache-Control", 'max-age=604800, public');
        $response->header("Content-Type", $type);

        return $response;
    }

    public function uploadFiles(Request $request)
    {
        if ($request->file('file')) {
            $file = $request->file;

            $extension = $file->getClientOriginalExtension();
            $filename = 'file_' . time() . mt_rand() . '.' . $extension;

            $originalName = str_replace('.' . $extension, '', $file->getClientOriginalName());
            $file->move(storage_path() . '/app/uploads/files', $filename);


            return Response::json([
                'status' => true,
                'file_name' => $filename
            ], 200);
        }
    }




    public function uploadFile(Request $request)
    {
        if ($request->file('file')) {
            $file = $request->file;

            $extension = $file->getClientOriginalExtension();
            $filename = 'file_' . time() . mt_rand() . '.' . $extension;

            $originalName = str_replace('.' . $extension, '', $file->getClientOriginalName());
            $file->move(storage_path() . '/app/uploads/files', $filename);


            return Response::json([
                'status' => true,
                'file_name' => $filename
            ], 200);
        }
    }



}
