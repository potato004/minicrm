@extends('layouts.admin_template')

@section('content')
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
                <a href="/company/create" class="btn btn-block btn-outline-secondary">
                    <i class="fas fa-plus"></i> Add Company
                </a>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                @if(count($data['companies']) > 0)
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company Name</th>
                                <th>Website</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['companies'] as $company)
                                <tr>
                                    <td>{{$company->id}}</td>
                                    <td>{{$company->name}}</td>
                                    <td>
                                        @if ($company->url)
                                            <a target="_blank" href="{{$company->url}}">{{$company->url}}</a>
                                        @else
                                            N/a
                                        @endif
                                    </td>
                                    <td>{{date_format($company->created_at,"M d, Y")}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/company/{{$company->id}}" class="btn btn-info">View</a>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a href="/company/edit/{{$company->id}}" class="dropdown-item">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="/company/delete/{{$company->id}}" class="dropdown-item">Delete</a>
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
                {{$data['companies']->links()}}
              </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
    </div>
@endsection
