<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{$data['title']}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          @if ($data['parent'])
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{$data['parent-link']}}">{{$data['parent']}}</a></li>
              <li class="breadcrumb-item active">{{$data['link-title']}}</li>
            </ol>
          @endif
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->