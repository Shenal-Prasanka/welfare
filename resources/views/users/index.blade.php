@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <div class="content m-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __('User Details') }}</h5>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createUserModal">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create User') }}
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="userTable" style="border: 2px solid gray;" class="table">
                                <thead>
                                    <tr>
                                        <!--<th class="text-center">{{ __('Id') }}</th>-->
                                        <th class="text-center">{{ __('Name') }}</th>
                                        <th class="text-center">{{ __('Email') }}</th>
                                        <th class="text-center">{{ __('Role') }}</th>
                                        <th class="text-center">{{ __('Mobile') }}</th>
                                        <th class="text-center">{{ __('Address') }}</th>
                                        <th class="text-center">{{ __('NIC') }}</th>
                                        <th class="text-center">{{ __('Army ID') }}</th>
                                        <th class="text-center">{{ __('Emp-No') }}</th>
                                        <th class="text-center">{{ __('Rege-No') }}</th>
                                        <th class="text-center">{{ __('Regement') }}</th>
                                        <th class="text-center">{{ __('Unit') }}</th>
                                        <th class="text-center">{{ __('Rank') }}</th>
                                        <th class="text-center">{{ __('Office Address') }}</th>
                                        <th class="text-center">{{ __('Enlisted Date') }}</th>
                                        <th class="text-center">{{ __('Retire Date') }}</th>
                                        <th class="text-center">{{ __('Active') }}</th>
                                        <th class="text-center">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <!-- <td class="text-center">{{ $user->id }}</td> -->
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">
                                                @foreach ($user->getRoleNames() as $role)
                                                    <span class="badge bg-dark">{{ $role }}</span>
                                                @endforeach
                                            </td>
                                            <td class="text-center">{{ $user->mobile }}</td>
                                            <td class="text-center">{!! nl2br(e(str_replace(',', ",\n", $user->address))) !!}</td>
                                            <td class="text-center">{{ $user->nic }}</td>
                                            <td class="text-center">{{ $user->armyId }}</td>
                                            <td class="text-center">{{ $user->employee_no }}</td>
                                            <td class="text-center">{{ $user->regement_no }}</td>
                                            <td class="text-center">{{ $user->regement->regement ?? '-' }}</td>
                                            <td class="text-center">{{ $user->unit->unit ?? '-' }}</td>
                                            <td class="text-center">{{ $user->rank->rank ?? '-' }}</td>
                                            <td class="text-center">{{ $user->officeAddress }}</td>
                                            <td class="text-center">{{ $user->enlistedDate }}</td>
                                            <td class="text-center">{{ $user->retireDate ?? '-' }}</td>
                                            <td class="text-center">
                                                <p href="{{ route('users.toggle-active', $user->id) }}"
                                                    class="badge badge-{{ $user->active ? 'success' : 'danger' }}">
                                                    {{ $user->active ? __('Active') : __('Deactive') }}
                                                </p>
                                            </td>
                                            <td class="text-center text-nowrap">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                <!--Edit button-->
                                                <button type="button" 
                                                        class="btn btn-sm btn-warning btn-edit-user"
                                                        data-toggle="modal" 
                                                        data-target="#updateUserModal"
                                                        data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-mobile="{{ $user->mobile }}"
                                                        data-address="{{ $user->address }}"
                                                        data-nic="{{ $user->nic }}"
                                                        data-armyId="{{ $user->armyId }}"
                                                        data-employee_no="{{ $user->employee_no }}"
                                                        data-regement_no="{{ $user->regement_no }}"
                                                        data-regement_id="{{ $user->regement_id }}"
                                                        data-unit_id="{{ $user->unit_id }}"
                                                        data-rank_id="{{ $user->rank_id }}"
                                                        data-officeAddress="{{ $user->officeAddress }}"
                                                        data-enlistedDate="{{ $user->enlistedDate }}"
                                                        data-retireDate="{{ $user->retireDate }}"
                                                        data-roles="{{ $user->roles->pluck('name')->implode(',') }}"
                                                        data-action="{{ route('users.update', $user->id) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <!--delete button-->
                                                    <button class="btn btn-danger btn-sm btn-delete"><i
                                                            class="bi bi-trash3-fill"></i></button>
                                                </form>
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
        </div>
    </div>
    @include('users.edit')
    @include('users.add')
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    new DataTable('#userTable', {
        paging: true,
        searching: true,
        ordering: true,
        responsive: true, // turn off responsive to allow horizontal scroll
        scrollX: true,     // enable horizontal scrolling
        lengthMenu: [8, 25, 50, 100],
        pageLength: 8,
        language: {
            search: "SEARCH:_INPUT_",
            lengthMenu: "SHOW _MENU_ ENTRIES",
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