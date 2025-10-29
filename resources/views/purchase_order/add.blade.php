@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-file-invoice me-2"></i>Purchase Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <form method="POST" action="{{ route('purchaseorder.store') }}" enctype="multipart/form-data"
                                novalidate>
                                @csrf
                                <!-- Date Section -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="date" name="date"
                                                value="{{ now()->format('Y-m-d') }}" readonly>
                                        </div>
                                    </div>
                                    <!--Welfare Section -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="welfare" class="form-label">Welfare</label>
                                            <input type="text" class="form-control" id="welfare" name="welfare"
                                                value="{{ auth()->user()->welfare->name ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Supplier Information Section -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Information</h5>
                                    <label for="supply_id" class="form-label">Supplier</label>
                                    <select class="form-control" id="supply_id" name="supply_id" required>
                                        <option value="">-- Select Supplier --</option>
                                        @foreach ($supplys as $supply)
                                            <option value="{{ $supply->id }}">{{ $supply->supply }}</option>
                                        @endforeach
                                    </select>

                                    <div class="mb-3 mt-2">
                                        <label for="supplier_code" class="form-label">Supplier Code</label>
                                        <select class="form-control" id="supplier_code" name="supplier_code" required>
                                            <option value="">-- Select Supplier --</option>
                                            @foreach ($supplys as $supply)
                                                <option value="{{ $supply->id }}">{{ $supply->supply_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Products Section -->
                                <div class="mb-4">
                                    <h5 class="mb-3 d-flex justify-content-between">
                                        Products
                                        <button type="button" class="btn btn-sm btn-success" onclick="addRow()">+ Add
                                            Row</button>
                                    </h5>
                                    <div class="table-responsive mb-3">
                                        <table class="table table-bordered" id="productsTable">
                                            <thead>
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th>Model</th>
                                                    <th>Qty</th>
                                                    <th>Welfare Price</th>
                                                    <th>Welfare Net Value</th>
                                                    <th>Maximum Retail Price</th>
                                                    <th>MRP Net Value</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="item_name[]" class="form-control"
                                                            placeholder="Item Name"></td>
                                                    <td><input type="text" name="model[]" class="form-control"
                                                            placeholder="Model"></td>
                                                    <td><input type="number" name="qty[]" class="form-control qty"
                                                            value="1" oninput="calculateRow(this)"></td>
                                                    <td><input type="number" name="welfare_price[]"
                                                            class="form-control welfare-price" value="0"
                                                            oninput="calculateRow(this)"></td>
                                                    <td><input type="number" name="welfare_total[]"
                                                            class="form-control welfare-total" value="0" readonly></td>
                                                    <td><input type="number" name="mrp[]" class="form-control mrp"
                                                            value="0" oninput="calculateRow(this)"></td>
                                                    <td><input type="number" name="mrp_total[]"
                                                            class="form-control mrp-total" value="0" readonly></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="removeRow(this)">X</button>
                                                    </td>
                                                </tr>
                                                <tr class="total-row">
                                                    <td colspan="6" class="text-end"><strong>Grand Total</strong></td>
                                                    <td><input type="number" class="form-control" id="grandTotal"
                                                            value="0" readonly></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Create Purchase Order</button>
                                    <a href="{{ route('purchaseorder.index') }}" class="btn btn-secondary ml-2">Back</a>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addRow() {
            const table = document.getElementById('productsTable').getElementsByTagName('tbody')[0];
            const rowCount = table.rows.length;
            const newRow = table.insertRow(rowCount - 1); // insert before total row

            newRow.innerHTML = `
        <td><input type="text" name="item_name[]" class="form-control" placeholder="Item Name"></td>
        <td><input type="text" name="model[]" class="form-control" placeholder="Model"></td>
        <td><input type="number" name="qty[]" class="form-control qty" value="1" oninput="calculateRow(this)"></td>
        <td><input type="number" name="welfare_price[]" class="form-control welfare-price" value="0" oninput="calculateRow(this)"></td>
        <td><input type="number" name="welfare_total[]" class="form-control welfare-total" value="0" readonly></td>
        <td><input type="number" name="mrp[]" class="form-control mrp" value="0" oninput="calculateRow(this)"></td>
        <td><input type="number" name="mrp_total[]" class="form-control mrp-total" value="0" readonly></td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">X</button>
        </td>
    `;
        }


        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
            calculateGrandTotal();
        }

        function calculateRow(input) {
            const row = input.closest('tr');
            const qty = parseFloat(row.querySelector('.qty').value) || 0;
            const welfarePrice = parseFloat(row.querySelector('.welfare-price').value) || 0;
            const mrp = parseFloat(row.querySelector('.mrp').value) || 0;

            row.querySelector('.welfare-total').value = qty * welfarePrice;
            row.querySelector('.mrp-total').value = qty * mrp;

            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            let total = 0;
            document.querySelectorAll('.mrp-total').forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            document.getElementById('grandTotal').value = total;
        }
    </script>
@endsection
