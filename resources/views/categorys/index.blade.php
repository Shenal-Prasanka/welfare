@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluproduct">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __(' Category Details') }}</h5>
                               <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#categoryModalCreate">
                                    <i class="bi bi-plus-circle"></i> {{ __('Create Category') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="categoryTable" style="border: 2px solid gray;" class="table">
                                    <thead>
                                         <tr>
                                            <th class="text-center">{{ __('Category') }}</th>
                                            <th class="text-center">{{ __('Description') }}</th>
                                            <th class="text-center">{{ __('Active') }}</th>
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categorys as $category)
                                            <tr>
                                                <td class="text-center">{{ $category->category }}</td>
                                                <td class="text-center">{{ $category->description }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('categorys.toggle-active', $category->id) }}"
                                                        class="badge badge-{{ $category->active ? 'success' : 'danger' }}">
                                                        {{ $category->active ? __('Active') : __('Deactive') }}
                                                    </a>
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    <!-- Edit Button -->
                                                <button type="button"
                                                    class="btn btn-sm btn-warning btn-edit-category"
                                                    data-id="{{ $category->id }}"
                                                    data-category="{{ $category->category }}"
                                                    data-active="{{ $category->active }}"
                                                    data-description="{{ $category->description }}"
                                                    data-action="{{ route('categorys.update', $category->id) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <!--Delete-->
                                                    <form action="{{ route('categorys.destroy', $category->id) }}"
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

    @include('categorys.modal.edit')
    @include('categorys.modal.add')
    
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#categoryTable', {
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
