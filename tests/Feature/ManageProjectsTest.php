<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Database\Factories\ProjectFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker,RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_an_authenticated_user_can_create_project()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->get('/projects/create')
            ->assertStatus(200);

        $attributes = [
            "title"=>$this->faker->title,
            "description"=> $this->faker->text,
        ];

        $this->post('/projects',$attributes)
            ->assertRedirect('/projects');


        $this->assertDatabaseHas('projects',$attributes);
        $this->get('/projects')
            ->assertSee($attributes['title']);
    }

    public function test_an_authenticated_user_must_provide_title_for_project() {
        $this->signIn();
        $attributes = Project::factory()->raw(['title'=>'']);
        $this->post('/projects',$attributes)
            ->assertSessionHasErrors('title');
    }

    public function test_an_authenticated_user_must_provide_description_for_project() {
        $this->signIn();
        $attributes = Project::factory()->raw(['description'=>'']);
        $this->post('/projects',$attributes)
            ->assertSessionHasErrors('description');
    }

    public function test_guest_user_cannot_create_project() {

        $attributes = Project::factory()->raw(['owner_id'=>null]);

        $this->get('/projects/create')
            ->assertRedirect('/login');

        $this->post('/projects',$attributes)
            ->assertRedirect('/login');

    }

    public function test_guest_cannot_view_projects() {
        $this->get('/projects')
            ->assertRedirect('/login');
    }

    public function test_guest_cannot_view_project() {
        $project = Project::factory()->create();
        $this->get($project->path())
            ->assertRedirect('/login');
    }


    public function test_authenticated_user_cannot_view_others_projects() {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $other = User::factory()->create();

        $this->be($user);

        $project = Project::factory()->create(['owner_id'=>$other->id]);
        Project::factory()->create(['owner_id'=>$user->id]);

        $this->get('/projects')
            ->assertDontSee($project->title);
    }

    public function test_authenticated_user_cannot_view_others_project(){

        $this->signIn();
        $project = Project::factory()->create();
        $this->get($project->path())
            ->assertStatus(403);
    }


    public function signIn(): int
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user->id;
    }

}
