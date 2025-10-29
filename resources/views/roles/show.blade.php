@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold"><i class="bi bi-person-workspace"></i>{{ __(' View Roles') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">          
                           <a href="{{ route('roles.index') }}" class="btn btn-secondary mb-3">Back</a><br/>

                           <strong>Role ID:</strong> {{ $role->id }}<br/>
                           <strong>Name:</strong> {{ $role->name }}<br/>

                            <strong>Permissions:</strong><br/>
                            @foreach ($role->permissions as $permission )
                            <p>{{ $permission->name }}</p>
                            @endforeach
                                
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
