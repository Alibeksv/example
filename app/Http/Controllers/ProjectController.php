<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectIndexRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private ProjectServiceInterface $service)
    {
    }

    public function index(ProjectIndexRequest $request)
    {
        $collection = $this->service->getCollection($request->validated());

        return response()->json(
            [
                'data' => $collection
            ],
        );
    }

    public function get(Request $request)
    {
        $item = $this->service->find($request->route('id'));

        return response()->json(
            [
                'data' => $item
            ]
        );
    }

    public function create(ProjectCreateRequest $request)
    {
        $item = $this->service->create($request->validated());

        return response()->json(
            [
                'data' => $item
            ],
        );
    }

    public function update(ProjectUpdateRequest $request)
    {
        $item = $this->service->update($request->route('id'), $request->validated());

        return response()->json(
            [
                'data' => $item
            ],
        );
    }
}
