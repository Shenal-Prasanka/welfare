@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluproduct">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold">{{ __('Product Details') }}</h5>
                                @can('product-create')
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#ModalProductCreate">
                                    <i class="bi bi-plus-circle"></i> {{ __('Add New Product') }}
                                </a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="productTable" style="border: 2px solid gray;" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('Product Code') }}</th>
                                            <th class="text-center">{{ __('Product') }}</th>
                                            <th class="text-center">{{ __('Category') }}</th>
                                            <th class="text-center">{{ __('Normal Price') }}</th>
                                            <th class="text-center">{{ __('Vat') }}</th>
                                            <th class="text-center">{{ __('Tax') }}</th>
                                            <th class="text-center">{{ __('Welfare Price') }}</th>
                                            <th class="text-center">{{ __('Active') }}</th>
                                            <th class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="text-center"><strong>{{ $product->product_number }}</strong></td>
                                                <td class="text-center">{{ $product->product }}</td>
                                                <td class="text-center">{{ $product->category->category }}</td>
                                                <td class="text-center">{{ $product->normal_price }}</td>
                                                <td class="text-center">{{ $product->vat }}</td>
                                                <td class="text-center">{{ $product->tax }}</td>
                                                <td class="text-center">{{ $product->welfare_price }}</td>
                                                <td class="text-center">
                                                    <p 
                                                        class="badge badge-{{ $product->active ? 'warning' : 'success' }}">
                                                        {{ $product->active ? __('Pending') : __('Approved') }}
                                                    </p>
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    @can('product-edit')
                                                    <!-- Edit Button -->
                                                    <button 
    class="btn btn-sm btn-warning btn-edit-product"
    data-id="{{ $product->id }}"
    data-product="{{ $product->product }}"
    data-category="{{ $product->category_id }}"
    data-active="{{ $product->active }}"
    data-vat="{{ $product->vat }}"
    data-tax="{{ $product->tax }}"
    data-normal-price="{{ $product->normal_price }}"
    data-action="{{ route('products.update', $product->id) }}"
>
    Edit
</button>

                                                     @endcan
                                                    @can('product-approve')
                                                    @if ($product->active)
                                                    <!-- Toggle Status Button -->
                                                    <a href="{{ route('products.toggle-status', $product->id) }}"
                                                    class="btn btn-sm btn-primary"
                                                    title="Product Approvel">
                                                    Approve
                                                    </a>
                                                    @endif
                                                    @endcan
                                                    <!-- view Button 
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="btn btn-sm btn-secondary"><i class="bi bi-eye-fill"></i></a>-->
                                                    @can('product-delete')
                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </button>
                                                    </form>
                                                    @endcan
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

    @include('products.modal.add')
    @include('products.modal.edit')


@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#productTable', {
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
