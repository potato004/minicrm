<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'module'        => 'employee',
            'title'         => 'Employee',
            'link-title'    => 'Dispaly',
            'link'          => 'employee',
            'parent'        => '',
            'parent-link'   => ''
        );

        $data['employees'] = Employee::with(['company'])
                                ->where('is_active', 1)
                                ->orderBy('id', 'desc')
                                ->paginate(10);

        return view('employee.index')->with('data', $data);
    }

    public function create()
    {
        $data = array(
            'module'        => 'employee',
            'title'         => 'Add New Employee',
            'link-title'    => 'add',
            'link'          => 'employee/create',
            'parent'        => 'Employee',
            'parent-link'   => '/employee'
        );

        $data['companies'] = Company::where('is_active', 1)->get();

        return view('employee.create')->with('data', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());
        
        if(!$validator->fails()) {
            $employee = new Employee();

            $employee->fname        = $request->input('fname');
            $employee->lname        = $request->input('lname');
            $employee->company_id   = $request->input('company');
            $employee->email        = $request->input('email');
            $employee->phone_no     = $request->input('phone');

            $employee->save();

            $employee_id = $employee->id;

            if($employee_id) {
                $status     = 'success';
                $icon       = 'fa-check';
                $title      = 'Cheers!';
                $message    = 'Employee info successfully saved.';
            }
            else {
                $status     = 'danger';
                $icon       = 'fa-ban';
                $title      = 'Oh snap!';
                $message    = 'An error occur while saving.';
            }
        }
        else {
            $errors = $validator->errors()->getMessages();

            $status     = 'danger';
            $icon       = 'fa-ban';
            $title      = 'Error!';
            $message    = '';

            foreach($errors as $key => $val) {
                foreach($val as $error)
                    $message .= $error . ' ';
            }
        }

        $request->session()->flash('status', $status);
        $request->session()->flash('icon', $icon);
        $request->session()->flash('title', $title);
        $request->session()->flash('message', $message);

        return Redirect::back();
    }

    public function show($id)
    {
        $data = array(
            'module'        => 'employee',
            'title'         => 'Display Employee',
            'link-title'    => 'Dispaly',
            'link'          => 'employee/' . $id,
            'parent'        => 'Employee',
            'parent-link'   => '/employee'
        );

        $data['employee'] = Employee::with(['company'])
                            ->where('is_active', 1)
                            ->where('id', $id)
                            ->get();

        return view('employee.show')->with('data', $data);
    }

    public function edit($id)
    {
        $data = array(
            'module'        => 'employee',
            'title'         => 'Edit Employee',
            'link-title'    => 'edit',
            'link'          => 'employee/edit/' . $id,
            'parent'        => 'Employee',
            'parent-link'   => '/employee'
        );

        $data['employee'] = Employee::where('is_active', 1)
                            ->where('id', $id)
                            ->get();
        
        $data['companies'] = Company::where('is_active', 1)
                            ->get();

        return view('employee.edit')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules());
        
        if(!$validator->fails()) {
            $data = array(
                'fname'         => $request->input('fname'),
                'lname'         => $request->input('lname'),
                'company_id'    => $request->input('company'),
                'email'         => $request->input('email'),
                'phone_no'      => $request->input('phone')
            );

            $affected_rows = Employee::where('id', $id)
                                ->update($data);

            if($affected_rows) {
                $status     = 'success';
                $icon       = 'fa-check';
                $title      = 'Cheers!';
                $message    = 'Employee info successfully updated.';
            }
            else {
                $status     = 'danger';
                $icon       = 'fa-ban';
                $title      = 'Oh snap!';
                $message    = 'An error occur while updating.';
            }
        }
        else {
            $errors = $validator->errors()->getMessages();

            $status     = 'danger';
            $icon       = 'fa-ban';
            $title      = 'Error!';
            $message    = '';

            foreach($errors as $key => $val) {
                foreach($val as $error)
                    $message .= $error . ' ';
            }
        }

        $request->session()->flash('status', $status);
        $request->session()->flash('icon', $icon);
        $request->session()->flash('title', $title);
        $request->session()->flash('message', $message);

        return redirect('employee/' . $id);
    }

    public function disable(Request $request, $id)
    {
        $data = array(
            'is_active' => 0
        );

        $affected_rows = Employee::where('id', $id)
                                ->update($data);

        if($affected_rows) {
            $status     = 'success';
            $icon       = 'fa-check';
            $title      = 'Cheers!';
            $message    = 'Employee info successfully deleted.';
        }
        else {
            $status     = 'danger';
            $icon       = 'fa-ban';
            $title      = 'Oh snap!';
            $message    = 'An error occur while deleting.';
        }

        $request->session()->flash('status', $status);
        $request->session()->flash('icon', $icon);
        $request->session()->flash('title', $title);
        $request->session()->flash('message', $message);

        return redirect('employee');
    }

    private function rules()
    {
        return [
            'fname'     => 'required',
            'lname'     => 'required',
            'company'   => 'required|exists:companies,id',
            'email'     => 'nullable|email',
            'phone'     => 'nullable|digits:10'
        ];
    }
}
