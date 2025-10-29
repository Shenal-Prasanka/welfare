@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluproduct">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __(' Rank Details') }}</h5>
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#RankmodalCreate">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create Rank') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="rankTable" style="border: 2px solid gray;" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('Rank') }}</th>
                                            <th class="text-center">{{ __('Type') }}</th>
                                            <th class="text-center">{{ __('Active') }}</th>
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ranks as $rank)
                                            <tr>
                                                <td class="text-center">{{ $rank->rank }}</td>
                                                <td class="text-center">{{ $rank->type }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('ranks.toggle-active', $rank->id) }}"
                                                        class="badge badge-{{ $rank->active ? 'success' : 'danger' }}">
                                                        {{ $rank->active ? __('Active') : __('Deactive') }}
                                                    </a>
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    <!-- Edit Button -->
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-sm btn-warning btn-edit-rank"
                                                        data-toggle="modal" data-target="#editRankModal"
                                                        data-id="{{ $rank->id }}" data-rank="{{ $rank->rank }}"
                                                        data-type="{{ $rank->type }}" data-active="{{ $rank->active }}"
                                                        data-action="{{ route('ranks.update', $rank->id) }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>


                                                    <form action="{{ route('ranks.destroy', $rank->id) }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </button>
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
    @include('ranks.modal.edit')
    @include('ranks.modal.add')
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#rankTable', {
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
