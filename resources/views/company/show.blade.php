@extends('layouts.admin_template')

@section('content')
    <div class="row justify-content-md-center">
        <div class="card card-default col-md-6">
            <div class="card-header">
            <h3 class="card-title">Display</h3>
            </div>
            @php
                $logo = 'data:image/png;base64,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';
                
                if($data['company'][0]->logo) {
                    if(file_exists(public_path('storage/logos/' . $data['company'][0]->logo)))
                        $logo = '/storage/logos/' . $data['company'][0]->logo;
                }
            @endphp
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{$logo}}" alt="User profile picture">
                </div>
    
                <h3 class="profile-username text-center">{{$data['company'][0]->name}}</h3>
                <p class="text-muted text-center">{{$data['company'][0]->email}}</p>
                <p class="text-muted text-center">
                    <a href="{{$data['company'][0]->url}}">{{$data['company'][0]->url}}</a>
                </p>
    
                <a href="/company/edit/{{$data['company'][0]->id}}" class="btn btn-primary btn-block"><b>Edit</b></a>
            </div>
        </div>
    </div>
@endsection
