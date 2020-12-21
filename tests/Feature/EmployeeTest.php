<?php

namespace Tests\Feature;
namespace App\Models;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_for_logged_users_only()
    {
        $response = $this->get('/employee')->assertRedirect('/login');
    }

    public function test_create_for_logged_users_only()
    {
        $response = $this->get('/employee/create')->assertRedirect('/login');
    }

    public function test_edit_for_logged_users_only()
    {
        $response = $this->get('/employee/edit')->assertRedirect('/login');
    }

    public function test_insert_with_valid_data()
    {
        $this->actingAs(factory(User::class)->create());

        $company_data = [
            'name'  => 'testname',
            'email' => 'email@email.com',
            'url'   => 'http://google.com',
            'logo'  => ''
        ];

        factory(Company::class, 1)->create($company_data);

        $employee_data = [
            'company'       => 1,
            'fname'         => 'fname',
            'lname'         => 'lastname',
            'email'         => 'email@email.com',
            'phone'         => ''
        ];

        $response = $this->post('employee/create', $employee_data);

        $this->assertCount(1, Employee::all());
    }

    public function test_insert_with_invalid_data()
    {
        $this->actingAs(factory(User::class)->create());

        $employee_data = [
            'company'       => 1,
            'fname'         => 'fname',
            'lname'         => 'lastname',
            'email'         => 'email@email.com',
            'phone'         => ''
        ];

        $response = $this->post('employee/create', $employee_data);

        $this->assertCount(0, Employee::all());
    }

    public function test_update_with_valid_data()
    {
        $this->actingAs(factory(User::class)->create());

        $company_data = [
            'name'  => 'testname',
            'email' => 'email@email.com',
            'url'   => 'http://google.com',
            'logo'  => ''
        ];

        factory(Company::class, 1)->create($company_data);

        $employee_data = [
            'company_id'    => 1,
            'fname'         => 'fname',
            'lname'         => 'lastname',
            'email'         => 'email@email.com',
            'phone_no'      => ''
        ];

        factory(Employee::class, 1)->create($employee_data);

        $data_update = [
            'company'       => 1,
            'fname'         => 'updatedname',
            'lname'         => 'lastnamess'
        ];

        $has_data = [
            'company_id'    => 1,
            'fname'         => 'updatedname',
            'lname'         => 'lastnamess'
        ];

        $response   = $this->post('employee/edit/1', $data_update);
        $this->assertDatabaseHas('employees', $has_data);
    }

    public function test_update_with_invalid_data()
    {
        $this->actingAs(factory(User::class)->create());

        $company_data = [
            'name'  => 'testname',
            'email' => 'email@email.com',
            'url'   => 'http://google.com',
            'logo'  => ''
        ];

        factory(Company::class, 1)->create($company_data);

        $employee_data = [
            'company_id'    => 1,
            'fname'         => 'fname',
            'lname'         => 'lastname',
            'email'         => 'email@email.com',
            'phone_no'      => ''
        ];

        factory(Employee::class, 1)->create($employee_data);

        $data_update = [
            'company'       => 2,
            'fname'         => 'updatedname',
            'lname'         => 'lastnamess'
        ];

        $has_data = [
            'company_id'    => 2,
            'fname'         => 'updatedname',
            'lname'         => 'lastnamess'
        ];

        $response   = $this->post('employee/edit/1', $data_update);
        $this->assertDatabaseMissing('employees', $has_data);
    }

    public function test_disable_with_existing_record()
    {
        $this->actingAs(factory(User::class)->create());

        $company_data = [
            'name'  => 'testname',
            'email' => 'email@email.com',
            'url'   => 'http://google.com',
            'logo'  => ''
        ];

        factory(Company::class, 1)->create($company_data);

        $employee_data = [
            'company_id'    => 1,
            'fname'         => 'fname',
            'lname'         => 'lastname',
            'email'         => 'email@email.com',
            'phone_no'      => ''
        ];

        factory(Employee::class, 1)->create($employee_data);

        $disabled_data = [
            'id'        => 1,
            'is_active' => 0
        ];

        $response = $this->get('employee/delete/1');

        $this->assertDatabaseHas('employees', $disabled_data);
    }

    public function test_disable_with_not_existing_record()
    {
        $this->actingAs(factory(User::class)->create());

        $company_data = [
            'name'  => 'testname',
            'email' => 'email@email.com',
            'url'   => 'http://google.com',
            'logo'  => ''
        ];

        factory(Company::class, 1)->create($company_data);

        $employee_data = [
            'company_id'    => 1,
            'fname'         => 'fname',
            'lname'         => 'lastname',
            'email'         => 'email@email.com',
            'phone_no'      => ''
        ];

        factory(Employee::class, 1)->create($employee_data);

        $disabled_data = [
            'id'        => 3,
            'is_active' => 0
        ];

        $response = $this->get('employee/delete/1');

        $this->assertDatabaseMissing('employees', $disabled_data);
    }
}
