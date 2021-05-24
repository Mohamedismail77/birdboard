<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ProjectTest extends TestCase
{

    use withFaker,RefreshDatabase;
    public function test_project_has_path()
    {
        $project = Project::factory()->create();
        $this->assertEquals('/projects/' . $project->id,$project->path());
    }

    public function test_project_has_owner() {

        $project = Project::factory()->create();
        $this->assertInstanceOf(User::class,$project->owner);

    }
}
