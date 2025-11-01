@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-white">{{ __('Create Purchase Order') }}</h5>
                            <a href="{{ route('purchaseorder.index') }}" class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('purchaseorder.store') }}" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">{{ __('Welfare') }}</label>
                                    <input type="hidden" name="welfare_id" value="{{ old('welfare_id', $userWelfareId) }}">
                                    <input type="text" class="form-control" 
                                           value="@if($userWelfareId){{ $welfares->firstWhere('id', $userWelfareId)?->name }}@else{{ __('No welfare assigned') }}@endif" 
                                           readonly>
                                    @error('welfare_id')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="poItemsTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{ __('Item Name') }}</th>
                                                <th>{{ __('Model No') }}</th>
                                                <th>{{ __('Qty') }}</th>
                                                <th>{{ __('Welfare Price') }}</th>
                                                <th>{{ __('Welfare Net Value') }}</th>
                                                <th>{{ __('MRP') }}</th>
                                                <th>{{ __('MRP Net Value') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="items[0][item_name]" class="form-control" required>
                                                        <option value="">-- Select Product --</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->product }}">{{ $product->product }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="items[0][model_no]" class="form-control"></td>
                                                <td><input type="number" name="items[0][qty]" class="form-control qty-input" min="1" value="1" required></td>
                                                <td><input type="number" step="0.01" name="items[0][welfare_price]" class="form-control welfare-price-input" value="0" required></td>
                                                <td><input type="number" step="0.01" name="items[0][welfare_net_value]" class="form-control welfare-net-value" value="0" required readonly></td>
                                                <td><input type="number" step="0.01" name="items[0][mrp]" class="form-control mrp-input" value="0" required></td>
                                                <td><input type="number" step="0.01" name="items[0][mrp_net_value]" class="form-control mrp-net-value" value="0" required readonly></td>
                                                <td class="text-center"><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">×</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" id="addRowBtn" class="btn btn-outline-primary mb-3">{{ __('Add Row') }}</button>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit PO') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let rowIndex = 1;

        // Function to calculate net values
        function calculateNetValues(row) {
            const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
            const welfarePrice = parseFloat(row.querySelector('.welfare-price-input').value) || 0;
            const mrp = parseFloat(row.querySelector('.mrp-input').value) || 0;

            const welfareNetValue = (qty * welfarePrice).toFixed(2);
            const mrpNetValue = (qty * mrp).toFixed(2);

            row.querySelector('.welfare-net-value').value = welfareNetValue;
            row.querySelector('.mrp-net-value').value = mrpNetValue;
        }

        // Add event listeners to existing rows
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#poItemsTable tbody tr').forEach(row => {
                row.querySelector('.qty-input').addEventListener('input', () => calculateNetValues(row));
                row.querySelector('.welfare-price-input').addEventListener('input', () => calculateNetValues(row));
                row.querySelector('.mrp-input').addEventListener('input', () => calculateNetValues(row));
            });
        });

        document.getElementById('addRowBtn').addEventListener('click', function () {
            const tbody = document.querySelector('#poItemsTable tbody');
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <select name="items[${rowIndex}][item_name]" class="form-control" required>
                        <option value="">-- Select Product --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->product }}">{{ $product->product }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="items[${rowIndex}][model_no]" class="form-control"></td>
                <td><input type="number" name="items[${rowIndex}][qty]" class="form-control qty-input" min="1" value="1" required></td>
                <td><input type="number" step="0.01" name="items[${rowIndex}][welfare_price]" class="form-control welfare-price-input" value="0" required></td>
                <td><input type="number" step="0.01" name="items[${rowIndex}][welfare_net_value]" class="form-control welfare-net-value" value="0" required readonly></td>
                <td><input type="number" step="0.01" name="items[${rowIndex}][mrp]" class="form-control mrp-input" value="0" required></td>
                <td><input type="number" step="0.01" name="items[${rowIndex}][mrp_net_value]" class="form-control mrp-net-value" value="0" required readonly></td>
                <td class="text-center"><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">×</button></td>
            `;
            tbody.appendChild(tr);

            // Add event listeners to new row
            tr.querySelector('.qty-input').addEventListener('input', () => calculateNetValues(tr));
            tr.querySelector('.welfare-price-input').addEventListener('input', () => calculateNetValues(tr));
            tr.querySelector('.mrp-input').addEventListener('input', () => calculateNetValues(tr));

            rowIndex++;
        });

        function removeRow(btn) {
            const tr = btn.closest('tr');
            tr.parentNode.removeChild(tr);
        }
    </script>
@endsection


