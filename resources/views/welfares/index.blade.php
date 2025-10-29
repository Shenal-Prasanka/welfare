@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluproduct">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __(' Welfare Details') }}</h5>
                                @can('welfare-create')
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#ModalCreate">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create Welfare') }}
                                </a>
                                 @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="welfareTable" style="border: 2px solid gray;" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('Code') }}</th>
                                            <th class="text-center">{{ __('Welfare') }}</th>
                                            <th class="text-center">{{ __('Location') }}</th>
                                            <th class="text-center">{{ __('Status') }}</th>
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($welfares as $welfare)
                                            <tr>
                                                <td class="text-center">{{ $welfare->welfare_number }}</td>
                                                <td class="text-center">{{ $welfare->name }}</td>
<td class="text-center">
    @if ($welfare->location)
        @php
            $coords = str_replace(' ', '', $welfare->location);
        @endphp
        <a href="https://www.google.com/maps/search/?api=1&query={{ $coords }}" target="_blank">
            View on Map
        </a>
    @else
        N/A
    @endif
</td>

                                     <td class="text-center">
                                                    <p
                                                        class="badge badge-{{ $welfare->active ? 'warning' : 'success' }}">
                                                        {{ $welfare->active ? __('Pending') : __('Approved') }}
                                                </p>
                                                </td>
                                                <td class=" text-nowrap text-center">
                                                    @can('welfare-edit')
                                                    <!-- Edit Button -->
                                                    <button type="button" 
                                                        class="btn btn-sm btn-warning btn-edit"
                                                        data-id="{{ $welfare->id }}" 
                                                        data-name="{{ $welfare->name }}"
                                                        data-updated="{{ $welfare->updated_at->timezone('Asia/Colombo')->format('Y-m-d h:i:s A') }}"
                                                        data-action="{{ route('welfares.update', $welfare->id) }}"
                                                        data-toggle="modal" 
                                                        data-target="#ModalEdit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    @endcan
                                                    @can('welfare-approve')
                                                    @if ($welfare->active)
                                                    <!-- Toggle Status Button -->
                                                    <a href="{{ route('welfares.toggle-status', $welfare->id) }}"
                                                    class="btn btn-sm btn-primary"
                                                    title="Toggle Active/Pending">
                                                    Approve
                                                    </a>
                                                    @endif
                                                    @endcan
                                                    @can('welfare-delete')
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('welfares.destroy', $welfare->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </button>
                                                    </form>
                                                    @endcan
                                                </td>
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

    @include('welfares.modal.create')
    @include('welfares.modal.edit')
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#welfareTable', {
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
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });
        });
    </script>
@endsection
