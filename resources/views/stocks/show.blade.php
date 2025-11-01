@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-white">{{ __('Stock Details') }} - {{ $stock->serial_number }}</h5>
                            <a href="{{ route('stocks.index') }}" class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-3">{{ __('Item Information') }}</h6>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="40%">{{ __('Serial Number') }}</th>
                                            <td><strong>{{ $stock->serial_number }}</strong></td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Item Name') }}</th>
                                            <td>{{ $stock->item_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Item Model') }}</th>
                                            <td>{{ $stock->item_model ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Product Code') }}</th>
                                            <td>
                                                @if($stock->item_code)
                                                    <span class="badge bg-info">{{ $stock->item_code }}</span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Category') }}</th>
                                            <td>{{ $stock->item_category ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Status') }}</th>
                                            <td>
                                                @if($stock->status == 'available')
                                                    <span class="badge bg-success">{{ __('Available') }}</span>
                                                @elseif($stock->status == 'sold')
                                                    <span class="badge bg-warning">{{ __('Sold') }}</span>
                                                @elseif($stock->status == 'damaged')
                                                    <span class="badge bg-danger">{{ __('Damaged') }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $stock->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-6">
                                    <h6 class="text-muted mb-3">{{ __('Pricing & Location') }}</h6>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="40%">{{ __('Normal Price') }}</th>
                                            <td>Rs. {{ number_format($stock->item_normal_price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Welfare Price') }}</th>
                                            <td>Rs. {{ number_format($stock->item_welfare_price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Welfare') }}</th>
                                            <td>
                                                @if($stock->welfare)
                                                    {{ $stock->welfare->welfare_number }} - {{ $stock->welfare->name }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Purchase Order') }}</th>
                                            <td>
                                                @if($stock->purchaseOrder)
                                                    <a href="{{ route('purchaseorder.show', $stock->purchaseOrder->id) }}" class="btn btn-sm btn-outline-primary">
                                                        {{ $stock->purchaseOrder->po_number }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Added On') }}</th>
                                            <td>{{ $stock->created_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Last Updated') }}</th>
                                            <td>{{ $stock->updated_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            @if($stock->product)
                                <div class="mt-4">
                                    <h6 class="text-muted mb-3">{{ __('Linked Product Information') }}</h6>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="20%">{{ __('Product') }}</th>
                                            <td>{{ $stock->product->product }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Product Number') }}</th>
                                            <td><span class="badge bg-info">{{ $stock->product->product_number }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Category') }}</th>
                                            <td>{{ $stock->product->category ? $stock->product->category->category : 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
