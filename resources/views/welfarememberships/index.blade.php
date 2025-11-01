@extends('layouts.app')

@section('content')
<div class="content m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold">{{ __('Welfare Membership Details') }}</h5>
                            @can('membership-create')
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalWelfareMembershipCreate">
                                <i class="bi bi-plus-circle"></i> {{ __('Create WelfareMembership') }}
                            </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="welfaremembershipTable" style="border: 2px solid" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('Army ID') }}</th>
                                        <th class="text-center">{{ __('Name') }}</th>
                                        <th class="text-center">{{ __('NIC') }}</th>
                                        <th class="text-center">{{ __('Mobile') }}</th>
                                        <th class="text-center">{{ __('Email') }}</th>
                                        <th class="text-center">{{ __('Regiment No.') }}</th>
                                        <th class="text-center">{{ __('Membership Date') }}</th>
                                        <th class="text-center">{{ __('Address') }}</th>
                                        <th class="text-center">{{ __('Status') }}</th>
                                        @can('membership-edit')
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($welfarememberships as $welfaremembership)
                                        <tr>
                                            <td class="text-center">{{ $welfaremembership->army_id }}</td>
                                            <td>{{ $welfaremembership->name }}</td>
                                            <td class="text-center">{{ $welfaremembership->nic }}</td>
                                            <td class="text-center">{{ $welfaremembership->mobile }}</td>
                                            <td>{{ $welfaremembership->email }}</td>
                                            <td class="text-center">{{ $welfaremembership->regiment_no }}</td>
                                            <td class="text-center">
                                                {{ $welfaremembership->membership_date?->format('Y-m-d') ?? 'N/A' }}
                                            </td>
                                            <td>{{ $welfaremembership->address }}</td>
                                            <td class="text-center">
                                                <p class="badge badge-{{ $welfaremembership->active ? 'warning' : 'success' }}">
                                                    {{ $welfaremembership->active ? 'Pending' : __('Approved') }}
                                                </p>
                                            </td>
                                            @can('membership-edit')
                                                <td class="text-center text-nowrap">
                                                    <button type="button" class="btn btn-sm btn-warning btn-edit-membership"
                                                        data-id="{{ $welfaremembership->id }}"
                                                        data-name="{{ $welfaremembership->name }}"
                                                        data-email="{{ $welfaremembership->email }}"
                                                        data-mobile="{{ $welfaremembership->mobile }}"
                                                        data-address="{{ $welfaremembership->address }}"
                                                        data-membership_date="{{ $welfaremembership->membership_date?->format('Y-m-d') ?? 'N/A' }}"
                                                        data-army_id="{{ $welfaremembership->army_id }}"
                                                        data-regiment_no="{{ $welfaremembership->regiment_no }}"
                                                        data-nic="{{ $welfaremembership->nic }}"
                                                        data-active="{{ $welfaremembership->active }}"
                                                        data-action="{{ route('welfarememberships.update', $welfaremembership->id) }}"
                                                        data-toggle="modal" data-target="#ModalMembershipEdit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>

                                                    @if ($welfaremembership->active)
                                                        <a href="{{ route('welfarememberships.toggle-status', $welfaremembership->id) }}"
                                                           class="btn btn-sm btn-success" title="Approve Membership">
                                                            Approve
                                                        </a>
                                                    @endif
                                                </td>
                                            @endcan
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

@include('welfarememberships.modal.add')
@include('welfarememberships.modal.edit')
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new DataTable('#welfaremembershipTable', {
            paging: true,
            searching: true,
            ordering: true,
            responsive: true,
            lengthMenu: [8, 25, 50, 100],
            pageLength: 8,
            language: {
                search: "Search:_INPUT_",
                lengthMenu: "Show _MENU_ Entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: { previous: "Previous", next: "Next" }
            }
        });

        $(document).on('click', '.btn-edit-membership', function() {
            var action = $(this).data('action');
            $('#edit_form').attr('action', action);
            $('#edit_name').val($(this).data('name'));
            $('#edit_email').val($(this).data('email'));
            $('#edit_mobile').val($(this).data('mobile'));
            $('#edit_address').val($(this).data('address'));
            $('#edit_membership_date').val($(this).data('membership_date'));
            $('#edit_army_id').val($(this).data('army_id'));
            $('#edit_regiment_no').val($(this).data('regiment_no'));
            $('#edit_nic').val($(this).data('nic'));
            $('#edit_active').prop('checked', $(this).data('active'));
            $('#ModalMembershipEdit').modal('show');
        });
    });
</script>
@endsection
