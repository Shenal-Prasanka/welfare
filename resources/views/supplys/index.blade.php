@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluproduct">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __(' Supply Details') }}</h5>
                                @can('supplier-create')
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#ModalSupplyCreate">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create Supply') }}
                                </a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="supplyTable" style="border: 2px solid gray;" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('Code') }}</th>
                                            <th class="text-center">{{ __('Supplier') }}</th>
                                            <th class="text-center">{{ __('Active') }}</th>
                                            <th class="text-center">{{ __('Description') }}</th>
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplys as $supply)
                                            <tr>
                                                <td class="text-center">{{ $supply->supply_number }}</td>
                                                <td class="text-center">{{ $supply->supply }}</td>
                                                <td class="text-center">
                                                    <p
                                                        class="badge badge-{{ $supply->active ? 'warning' : 'success' }}">
                                                        {{ $supply->active ?  __('Pending') : __('Approved') }}
                                                </p>
                                                </td>
                                                <td class="text-center">{{ $supply->description }}</td>
                                                <td class="text-center text-nowrap">
                                                    @can('supplier-edit')
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-warning btn-edit-supply"
                                                        data-id="{{ $supply->id }}"
                                                        data-name="{{ $supply->supply }}"
                                                        data-active="{{ $supply->active }}"
                                                        data-description="{{ $supply->description }}"
                                                        data-action="{{ route('supplys.update', $supply->id) }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                   @endcan
                                                     @can('supplier-approve')
                                                    @if ($supply->active)
                                                    <!-- Toggle Status Button -->
                                                    <a href="{{ route('supplys.toggle-status', $supply->id) }}"
                                                    class="btn btn-sm btn-primary"
                                                    title="Toggle Active/Pending">
                                                    Approve
                                                    </a>
                                                    @endif
                                                    @endcan
                                                    <!-- view Button 
                                                    <a href="{{ route('supplys.show', $supply->id) }}"
                                                        class="btn btn-sm btn-secondary"><i class="bi bi-eye-fill"></i></a>-->
                                                    @can('supplier-delete')
                                                    <form action="{{ route('supplys.destroy', $supply->id) }}"
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
  
    @include('supplys.modal.add')
    @include('supplys.modal.edit')
    
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#supplyTable', {
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
        });
    </script>
@endsection
