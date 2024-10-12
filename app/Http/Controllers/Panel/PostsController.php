<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\PostsRequest;
use App\Repositories\PostsRepository;
use App\Repositories\ConstantsRepository;

class PostsController extends Controller
{
    private $posts;

    private $constants;

    public function __construct(
        PostsRepository $posts_repository,
        ConstantsRepository $constants_repository
    ) {
        $this->posts = $posts_repository;
        $this->constants = $constants_repository;
    }


    public function index(Request $request)
    {
        return view('panel.posts.all');
    }


    public function getDataTable()
    {
        return $this->posts->getDataTable();
    }

    public function create()
    {
        $data['categories']=$this->constants->getAll('posts_categories');

        return view('panel.posts.create',$data);
    }

    public function store(PostsRequest $request)
    {


        $response = $this->posts->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($id)
    {

        $data['item'] = $this->posts->edit($id);
        $data['categories']=$this->constants->getAll('posts_categories');


        return view('panel.posts.create', $data);
    }

    public function update($id, PostsRequest $request)
    {
        $response = $this->posts->update($id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }


    public function delete($id)
    {
        $response = $this->posts->delete($id);
        return $this->responseApi($response['status'], $response['message']);
    }

}
