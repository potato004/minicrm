<?php

namespace App\Http\Controllers;

use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = array(
            'module'        => 'company',
            'title'         => 'Company List',
            'link-title'    => 'Dispaly',
            'link'          => 'company',
            'parent'        => '',
            'parent-link'   => ''
        );

        $data['companies'] = Company::where('is_active', 1)
                                ->orderBy('id', 'desc')
                                ->paginate(10);

        return view('company.index')->with('data', $data);
    }

    public function create()
    {
        $data = array(
            'module'        => 'company',
            'title'         => 'Create New Company',
            'link-title'    => 'add',
            'link'          => 'company/create',
            'parent'        => 'Company',
            'parent-link'   => '/company'
        );

        return view('company.create')->with('data', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->storeRules());
        
        if(!$validator->fails()) {
            $company = new Company();

            $company->name  = $request->input('name');
            $company->email = $request->input('email');
            $company->url   = $request->input('url');
            $company->logo  = $request->input('logo');

            if($request->hasFile('logo')) {
                $target_filename    = $request->file('logo')->getClientOriginalName();
                $target_ext         = $request->file('logo')->getClientOriginalExtension();
                $logo              = $target_filename . '_' . time() . '.' . $target_ext;

                $request->file('logo')->storeAs('public/logos/', $logo);

                //logo name;
                $company->logo = $logo;
            }

            $company->save();

            $company_id = $company->id;

            if($company_id) {
                $status     = 'success';
                $icon       = 'fa-check';
                $title      = 'Cheers!';
                $message    = 'Company info successfully saved.';
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
            'module'        => 'company',
            'title'         => 'Display Company',
            'link-title'    => 'Dispaly',
            'link'          => 'company/' . $id,
            'parent'        => 'Company',
            'parent-link'   => '/company'
        );

        $data['company'] = Company::where('is_active', 1)
                            ->where('id', $id)
                            ->get();

        return view('company.show')->with('data', $data);
    }

    public function edit($id)
    {
        $data = array(
            'module'        => 'company',
            'title'         => 'Edit Company',
            'link-title'    => 'edit',
            'link'          => 'company/edit/' . $id,
            'parent'        => 'Company',
            'parent-link'   => '/company'
        );

        $data['company'] = Company::where('is_active', 1)
                            ->where('id', $id)
                            ->get();

        return view('company.edit')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->updateRules($id));
        
        if(!$validator->fails()) {

            $data = array(
                'name'  => $request->input('name'),
                'email' => $request->input('email'),
                'url'   => $request->input('url')
            );

            if($request->hasFile('logo')) {
                $target_filename    = $request->file('logo')->getClientOriginalName();
                $target_ext         = $request->file('logo')->getClientOriginalExtension();
                $logo              = $target_filename . '_' . time() . '.' . $target_ext;

                $request->file('logo')->storeAs('public/logos/', $logo);

                //logo name
                $data['logo'] = $logo;
            }

            $affected_rows = Company::where('id', $id)
                                ->update($data);

            if($affected_rows) {
                $status     = 'success';
                $icon       = 'fa-check';
                $title      = 'Cheers!';
                $message    = 'Company info successfully updated.';
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

        return redirect('company/' . $id);
    }

    public function disable(Request $request, $id)
    {
        $data = array(
            'is_active' => 0
        );

        $affected_rows = Company::where('id', $id)
                                ->update($data);

        if($affected_rows) {
            $status     = 'success';
            $icon       = 'fa-check';
            $title      = 'Cheers!';
            $message    = 'Company info successfully deleted.';
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

        return redirect('company');
    }

    private function storeRules()
    {
        return [
            'name'  => 'required|unique:companies,name',
            'email' => 'nullable|email',
            'url'   => 'nullable',
            'logo'  => 'nullable|dimensions:min_width=100,min_height=100'
        ];
    }

    private function updateRules($id)
    {
        return [
            'name'  => 'required|unique:companies,name,' . $id,
            'email' => 'nullable|email',
            'url'   => 'nullable',
            'logo'  => 'nullable|dimensions:min_width=100,min_height=100'
        ];
    }
}
