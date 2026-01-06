<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestResource;
use App\Models\TestModel;

class TestModelController extends Controller
{
    public function index(int $id): TestResource
    {
        $model = new TestModel;
        $model->id = $id;

        $resource = [
            'list' => [$model],
            // 'list' => $model, // the issue can also be reproduced with this line
            'total' => 1,
        ];

        return new TestResource($resource);
    }
}
