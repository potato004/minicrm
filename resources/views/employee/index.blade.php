@extends('layouts.admin_template')

@section('content')
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Employee List</h3>

            <div class="card-tools">
                <a href="employee/create" class="btn btn-block btn-outline-secondary">
                    <i class="fas fa-plus"></i> Add Employee
                </a>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                @if(count($data['employees']) > 0)
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['employees'] as $employee)
                                <tr>
                                    <td>{{$employee->id}}</td>
                                    <td>{{$employee->fname}} {{$employee->lname}}</td>
                                    <td>
                                        @if ($employee->company['is_active'] == 1)
                                            {{$employee->company['name']}}
                                        @else
                                            N/a
                                        @endif
                                    </td>
                                    <td>
                                        @if ($employee->email)
                                            {{$employee->email}}
                                        @else
                                            N/a
                                        @endif
                                    </td>
                                    <td>
                                        @if ($employee->phone_no)
                                            {{$employee->phone_no}}
                                        @else
                                            N/a
                                        @endif
                                    </td>
                                    <td>{{date_format($employee->created_at,"M d, Y")}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/employee/{{$employee->id}}" class="btn btn-info">View</a>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a href="/employee/edit/{{$employee->id}}" class="dropdown-item">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="/employee/delete/{{$employee->id}}" class="dropdown-item">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="content">
                        <div class="container-fluid text-center">
                        <h4>No Records Found :(</h4>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer clearfix">
                {{$data['employees']->links()}}
              </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
    </div>
@endsection
