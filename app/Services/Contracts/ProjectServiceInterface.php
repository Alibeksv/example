<?php

namespace App\Services\Contracts;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

interface ProjectServiceInterface
{
    public function find(int $id): Project;

    public function getCollection(array $attributes = []): Collection;

    public function create(array $attributes): Project;
    public function update(int $id, array $attributes): Project;
}
