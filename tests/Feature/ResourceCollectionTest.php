<?php

namespace Tests\Feature;

use Tests\TestCase;

class ResourceCollectionTest extends TestCase
{
    public function test_resource_collection(): void
    {
        $response = $this->get('/model/'.fake()->numberBetween(1, 10));

        $response->assertStatus(200);
    }
}
