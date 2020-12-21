@extends('layouts.admin_template')

@section('content')
    <div class="card card-default">
        <div class="card-header">
        <h3 class="card-title">Add</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="url">Website</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter URL">
                </div>
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <div class="input-group">
                        <input type="file" id="logo" name="logo" accept="image/*">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
