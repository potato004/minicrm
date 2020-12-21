<?php

namespace Tests\Feature;
namespace App\Models;

use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CompanyTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index_for_logged_users_only()
    {
        $response = $this->get('/company')->assertRedirect('/login');
    }

    public function test_create_for_logged_users_only()
    {
        $response = $this->get('/company/create')->assertRedirect('/login');
    }

    public function test_edit_for_logged_users_only()
    {
        $response = $this->get('/company/edit')->assertRedirect('/login');
    }

    public function test_store_with_valid_data()
    {
        $this->actingAs(factory(User::class)->create());

        $data = [
            'name'  => 'testname',
            'email' => 'email@email.com',
            'url'   => 'http://google.com',
            'logo'  => ''
        ];

        $response = $this->post('company/create', $data);

        $this->assertCount(1, Company::all());
    }

    public function test_store_with_invalid_data()
    {
        $this->actingAs(factory(User::class)->create());

        $data = [
            'name'  => '',
            'email' => 'invalidformat',
            'url'   => 'http://google.com',
            'logo'  => ''
        ];

        $response = $this->post('company/create', $data);

        $this->assertCount(0, Company::all());
    }

    public function test_update_with_valid_data()
    {
        $this->actingAs(factory(User::class)->create());

        $data = [
            'name'  => 'test',
            'email' => 'email@email.com',
            'url'   => '',
            'logo'  => ''
        ];

        factory(Company::class, 1)->create($data);

        $data_update = [
            'name'  => 'updatedname'
        ];

        $response   = $this->post('company/edit/1', $data_update);
        $this->assertDatabaseHas('companies', $data_update);
    }

    public function test_update_with_invalid_data()
    {
        $this->actingAs(factory(User::class)->create());

        $data = [
            'name'  => 'test',
            'email' => 'email@email.com',
            'url'   => '',
            'logo'  => ''
        ];

        factory(Company::class, 1)->create($data);

        $data_update = [
            'name'  => 'updatedname',
            'email' => 'invalidemail'
        ];

        $response = $this->post('company/edit/1', $data_update);
        $this->assertDatabaseMissing('companies', $data_update);
    }

    public function test_disable_with_existing_record()
    {
        $this->actingAs(factory(User::class)->create());

        $data = [
            'name'  => 'test',
            'email' => 'email@email.com',
            'url'   => '',
            'logo'  => ''
        ];

        factory(Company::class, 1)->create($data);

        $disabled_data = [
            'name'      => 'test',
            'is_active' => 0
        ];

        $response = $this->get('company/delete/1');

        $this->assertDatabaseHas('companies', $disabled_data);
    }

    public function test_disable_with_not_existing_record()
    {
        $this->actingAs(factory(User::class)->create());

        $data = [
            'name'  => 'test',
            'email' => 'email@email.com',
            'url'   => '',
            'logo'  => ''
        ];

        factory(Company::class, 1)->create($data);

        $disabled_data = [
            'name'      => 'test',
            'is_active' => 0
        ];

        $response = $this->get('company/delete/2');

        $this->assertDatabaseMissing('companies', $disabled_data);
    }
}
