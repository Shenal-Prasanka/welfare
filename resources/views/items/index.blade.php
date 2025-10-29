@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluproduct">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __(' Item Details') }}</h5>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#ModalItemCreate">
                                    {{ __('Add New Item') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="itemTable" style="border: 2px solid gray;" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('Product') }}</th>
                                            <th class="text-center">{{ __('Welfare') }}</th>
                                            <th class="text-center">{{ __('Serial-Number') }}</th>
                                            <th class="text-center">{{ __('Add Date') }}</th>
                                            <th class="text-center">{{ __('Issue Date') }}</th>
                                            <th class="text-center">{{ __('Status') }}</th>
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="text-center">{{ $item->product->product }}</td>
                                                <td class="text-center">{{ $item->welfare->name }}</td>
                                                <td class="text-center">{{ $item->serial_number }}</td>
                                                <td class="text-center">{{ $item->added_date }}</td>
                                                <td class="text-center">{{ $item->issued_date }}</td>
                                                <td class="text-center">
                                                    <p class="badge badge-{{ $item->active ? 'warning' : 'danger' }}">
                                                        {{ $item->active ? __('Instock') : __('Issued') }}
                                                    </p>
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    @if($item->active)
                                                        <a href="{{ route('items.toggle-active', $item->id) }}" class="btn btn-sm btn-success">
                                                            Issue
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
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
</div>

@include('items.modal.add')
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#itemTable', {
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
