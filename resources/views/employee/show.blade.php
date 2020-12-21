@extends('layouts.admin_template')

@section('content')
    <div class="row justify-content-md-center">
        <div class="card card-default col-md-6">
            <div class="card-header">
            <h3 class="card-title">Display</h3>
            </div>
            <div class="card-body box-profile">
                <h3 class="profile-username text-center">{{$data['employee'][0]->fname}} {{$data['employee'][0]->lname}}</h3>
                <p class="text-muted text-center">{{$data['employee'][0]->email}}</p>
                <p class="text-muted text-center">{{$data['employee'][0]->phone_no}}</p>
                <p class="text-muted text-center">{{$data['employee'][0]->company->name}}</p>
                <a href="/employee/edit/{{$data['employee'][0]->id}}" class="btn btn-primary btn-block"><b>Edit</b></a>
            </div>
        </div>
    </div>
@endsection
