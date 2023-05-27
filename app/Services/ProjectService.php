<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\ParametersErrorException;
use App\Models\Project;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ProjectService implements ProjectServiceInterface
{

    public function find(int $id): Project
    {
        $project = Project::find($id);

        if (!$project) {
            throw new NotFoundException('Project not found');
        }

        return $project;
    }

    public function getCollection(array $attributes = []): Collection
    {
        return Project::query()
            ->when(isset($attributes['name']), function ($query) use ($attributes) {
                $query->where('name', $attributes['name']);
            })
            ->when(isset($attributes['ids']), function ($query) use ($attributes) {
                $query->whereIn('id', $attributes['ids']);
            })
            ->get();
    }

    public function create(array $attributes): Project
    {
        $project = new Project($attributes);

        if (!$project->save()) {
            throw new ParametersErrorException('Unable create project');
        }

        return $project;
    }

    public function update(int $id, array $attributes): Project
    {
        $project = $this->find($id);

        $project->fill($attributes);

        if (!$project->save()) {
            throw new ParametersErrorException('Unable to update project');
        }

        return $project;
    }
}
