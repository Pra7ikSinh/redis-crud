<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\employee;
use App\Models\User;


class ShowAllDataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ShowAllData()
    {
        $response = $this->json('get', '/datatable');

        // $response = $this->get('/datatable');
        $response->assertStatus(200);
        // $response = $this->assert
        // $response->assertSee($task->title);



        $response->assertJsonStructure(
            [
            'id',
            'first_name',
            'last_name',
            'email',
            'contact_number',
            'profile_photo',
            'assigned_team',
            'designation',
            'company',
            'gender',
            'languages',
            'intro',
            'created_at',
            'updated_at',
        ]
    );
    }
}
