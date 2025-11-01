@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __(' Membership Details') }}</h5>
                                @can('membership-create')
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#ModalMembershipCreate">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create Membership') }}
                                </a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="membershipTable" style="border: 2px solid" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('Army ID') }}</th>
                                            <th class="text-center">{{ __('Name') }}</th>
                                            <th class="text-center">{{ __('NIC') }}</th>
                                            <th class="text-center">{{ __('Mobile') }}</th>
                                            <th class="text-center">{{ __('Email') }}</th>
                                            <th class="text-center">{{ __('Regiment No.') }}</th>
                                            <th class="text-center">{{ __('Membership-Date') }}</th>
                                            <th class="text-center">{{ __('Address') }}</th>
                                            <th class="text-center">{{ __('Status') }}</th>
                                            @can('membership-edit')
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($memberships as $membership)
                                            <tr>
                                                <td class="text-center">{{ $membership->army_id }}</td>
                                                <td>{{ $membership->name }}</td>
                                                <td class="text-center">{{ $membership->nic }}</td>
                                                <td class="text-center">{{ $membership->mobile }}</td>
                                                <td>{{ $membership->email }}</td>
                                                <td class="text-center">{{ $membership->regiment_no }}</td>
                                                <td class="text-center">
                                                    {{ $membership->membership_date?->format('Y-m-d') ?? 'N/A' }}</td>
                                                <td>{{ $membership->address }}</td>
                                                <td class="text-center">
                                                    <p
                                                        class="badge badge-{{ $membership->active ? 'warning' : 'success' }}">
                                                        {{ $membership->active ? 'Pending' : __('Approved') }}
                                                    </p>
                                                </td>
                                                @can('membership-edit')
                                                    <td class="text-center text-nowrap">

                                                        <button type="button"
                                                            class="btn btn-sm btn-warning btn-edit-membership"
                                                            data-id="{{ $membership->id }}"
                                                            data-name="{{ $membership->name }}"
                                                            data-email="{{ $membership->email }}"
                                                            data-mobile="{{ $membership->mobile }}"
                                                            data-address="{{ $membership->address }}"
                                                            data-membership_date="{{ $membership->membership_date?->format('Y-m-d') ?? 'N/A' }}"
                                                            data-army_id="{{ $membership->army_id }}"
                                                            data-regiment_no="{{ $membership->regiment_no }}"
                                                            data-nic="{{ $membership->nic }}"
                                                            data-active="{{ $membership->active }}"
                                                            data-action="{{ route('memberships.update', $membership->id) }}"
                                                            data-toggle="modal" data-target="#ModalMembershipEdit">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>


                                                        @if ($membership->active)
                                                            <a href="{{ route('memberships.toggle-status', $membership->id) }}"
                                                                class="btn btn-sm btn-success" title="Approve Membership">
                                                                Approve
                                                            </a>
                                                        @endif


                                                        <!--
                                                            <form action="{{ route('memberships.destroy', $membership->id) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                                    <i class="bi bi-trash3-fill"></i>
                                                                </button>
                                                            </form>
                                                        -->
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

    {{-- You will need to create these modal views later --}}
    @include('memberships.modal.add')
    @include('memberships.modal.edit')
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable for the new table ID
            new DataTable('#membershipTable', {
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
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });

            // If you are using jQuery to open the edit modal, you'll need a script similar to this:
            $(document).on('click', '.btn-edit-membership', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var mobile = $(this).data('mobile');
                var address = $(this).data('address');
                var membership_date = $(this).data('membership_date');
                var army_id = $(this).data('army_id');
                var regiment_no = $(this).data('regiment_no');
                var nic = $(this).data('nic');
                var active = $(this).data('active');
                var action = $(this).data('action');

                // Assuming your edit modal has fields with these IDs/Names
                $('#edit_form').attr('action', action);
                $('#edit_name').val(name);
                $('#edit_email').val(email);
                $('#edit_mobile').val(mobile);
                $('#edit_address').val(address);
                $('#edit_membership_date').val(membership_date);
                $('#edit_army_id').val(army_id);
                $('#edit_regiment_no').val(regiment_no);
                $('#edit_nic').val(nic);
                $('#edit_active').prop('checked', active); // For a checkbox or switch

                $('#ModalMembershipEdit').modal('show');
            });
        });
    </script>
@endsection
