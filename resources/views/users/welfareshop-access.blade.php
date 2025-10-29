@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <div class="content m-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold">{{ __('Welfareshop aceess') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="userTable" style="border: 2px solid gray;" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('Name') }}</th>
                                            <th class="text-center">{{ __('Role') }}</th>
                                            <th class="text-center">{{ __('Welfareshop') }}</th>
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $user->name }}</td>
                                                <td class="text-center">
                                                    @foreach ($user->getRoleNames() as $role)
                                                        <span class="badge bg-dark">{{ $role }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">{{ $user->welfare ? $user->welfare->name : 'N/A' }}</td>
                                                <td class="text-center text-nowrap">
                                                   <button type="button" class="btn btn-sm btn-warning btn-edit"
                                                        data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-role="{{ $user->roles->pluck('name')->first() }}"
                                                        data-welfare="{{ $user->welfare_id }}"
                                                        data-action="{{ route('users.update-welfareshopaccess', $user->id) }}"
                                                        data-toggle="modal"
                                                        data-target="#editUserModal">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                 </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @include('users.edit-welfareshop-access')
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#userTable', {
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10,
                language: {
                     search: "SEARCH:_INPUT_",
                    lengthMenu: "SHOW ENTRIES :_MENU_",
                    info: "Showing _TOTAL_ Entries",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });
        });
    </script>
@endsection
