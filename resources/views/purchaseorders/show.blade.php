@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-white">{{ __('Purchase Order') }} - {{ $purchaseorder->po_number }}</h5>
                            <a href="{{ route('purchaseorder.index') }}" class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <p><strong>{{ __('Status') }}:</strong> <span class="badge bg-secondary">{{ $purchaseorder->status }}</span></p>
                                <p><strong>{{ __('Welfare') }}:</strong> 
                                    @if($purchaseorder->welfare)
                                        {{ $purchaseorder->welfare->name }}
                                    @else
                                        <span class="text-muted">{{ __('N/A') }}</span>
                                    @endif
                                </p>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Item Name') }}</th>
                                            <th>{{ __('Model No') }}</th>
                                            <th>{{ __('Qty') }}</th>
                                            <th>{{ __('Welfare Price') }}</th>
                                            <th>{{ __('Welfare Net Value') }}</th>
                                            <th>{{ __('MRP') }}</th>
                                            <th>{{ __('MRP Net Value') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($items as $item)
                                            <tr>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->model_no }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ number_format($item->welfare_price, 2) }}</td>
                                                <td>{{ number_format($item->welfare_net_value, 2) }}</td>
                                                <td>{{ number_format($item->mrp, 2) }}</td>
                                                <td>{{ number_format($item->mrp_net_value, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">{{ __('No items found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if($purchaseorder->status === 'rejected' && $purchaseorder->rejection_reason)
                                <div class="alert alert-danger mt-3">
                                    <strong>{{ __('Rejection Reason') }}:</strong> {{ $purchaseorder->rejection_reason }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


