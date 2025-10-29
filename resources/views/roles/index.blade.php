@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluproduct">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __('Roles') }}
                                </h5>
                                @can('role-create')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRoleModal">
                                    <i class="bi bi-plus-circle"></i> {{ __(' Create New Role') }}
                                    </button>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="roleTable" style="border: 3px solid gray;" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td class="text-center">{{ $role->name }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('role-edit')
                                                            <button type="button" class="btn btn-sm btn-warning btn-edit"
                                                                data-id="{{ $role->id }}"
                                                                data-name="{{ $role->name }}"
                                                                data-permissions='@json($role->permissions->pluck("name"))'
                                                                data-action="{{ route('roles.update', $role->id) }}"
                                                                data-toggle="modal" data-target="#editRoleModal">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </button>
                                                        @endcan
                                                        @can('role-delete')
                                                            <button class="btn btn-danger btn-sm btn-delete"><i
                                                                    class="bi bi-trash3-fill"></i></button>
                                                        @endcan
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   @include('roles.edit') 
   @include('roles.add')

@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#roleTable', {
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                lengthMenu: [8, 25, 50, 100],
                pageLength: 8,
                language: {
                    search: "SEARCH:_INPUT_",
                    lengthMenu: "SHOW _MENU_ ENTRIES",
                    info: "Showing _TOTAL_ Entries",
                    paginate: {
                        previous: "Previous ",
                        next: "Next"
                    }
                }
            });
        });
    </script>
@endsection
