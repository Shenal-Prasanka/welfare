@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluproduct">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __(' Regement Details') }}</h5>
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#RegementmodalCreate">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create Regement') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="regementTable" style="border: 2px solid gray;" class="table ">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('Regement') }}</th>
                                            <th class="text-center">{{ __('Active') }}</th>
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($regements as $regement)
                                            <tr>
                                                <td class="text-center">{{ $regement->regement }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('regements.toggle-active', $regement->id) }}"
                                                        class="badge badge-{{ $regement->active ? 'success' : 'danger' }}">
                                                        {{ $regement->active ? __('Active') : __('Deactive') }}
                                                    </a>
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-warning btn-edit-regement"
                                                        data-id="{{ $regement->id }}"
                                                        data-regement="{{ $regement->regement }}"
                                                        data-active="{{ $regement->active }}"
                                                        data-updated="{{ $regement->updated_at->timezone('Asia/Colombo')->format('Y-m-d h:i:s A') }}"
                                                        data-action="{{ route('regements.update', $regement->id) }}"
                                                        data-toggle="modal" data-target="#RegementModalEdit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('regements.destroy', $regement->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </button>
                                                    </form>
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

    @include('regements.modal.add')
    @include('regements.modal.edit')
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#regementTable', {
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                lengthMenu: [8, 25, 50, 100],
                pageLength: 8,
                language: {
                    search: "SEARCH:_INPUT_",
                    lengthMenu: "SHOW _MENU_ ENTRIES ",
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
