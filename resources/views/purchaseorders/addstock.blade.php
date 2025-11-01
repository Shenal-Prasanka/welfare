@extends('layouts.app')

@section('content')
    <div class="content m-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-white">{{ __('Add Stock') }} - {{ $po->po_number }}</h5>
                            <a href="{{ route('purchaseorder.index') }}" class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <p><strong>{{ __('Welfare') }}:</strong> {{ $po->welfare ? $po->welfare->name : 'N/A' }}</p>
                                <p><strong>{{ __('Status') }}:</strong> <span class="badge bg-success">{{ $po->status }}</span></p>
                            </div>

                            <form action="{{ route('purchaseorder.storestock', $po->id) }}" method="POST">
                                @csrf
                                
                                @foreach($items as $index => $item)
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">{{ __('Item') }}: {{ $item->item_name }} ({{ $item->model_no }})</h6>
                                            <small class="text-muted">{{ __('Quantity') }}: {{ $item->qty }}</small>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="stocks[{{ $index }}][item_id]" value="{{ $item->id }}">
                                            
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Item Name') }}</label>
                                                <select name="stocks[{{ $index }}][product_id]" class="form-control product-select" data-index="{{ $index }}">
                                                    <option value="">-- {{ __('No Product Match') }} --</option>
                                                    @foreach(\App\Models\Product::with('category')->where('active', 0)->get() as $product)
                                                        <option value="{{ $product->id }}" 
                                                                data-code="{{ $product->product_number }}"
                                                                data-category="{{ $product->category ? $product->category->category : '' }}"
                                                                data-normal-price="{{ $product->normal_price }}"
                                                                data-welfare-price="{{ $product->welfare_price }}">
                                                            {{ $product->product_number }} - {{ $product->product }} ({{ $product->category ? $product->category->category : 'N/A' }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-label">{{ __('Item Code') }}</label>
                                                    <input type="text" class="form-control product-code-{{ $index }}" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">{{ __('Category') }}</label>
                                                    <input type="text" class="form-control product-category-{{ $index }}" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">{{ __('Normal Price') }}</label>
                                                    <input type="text" class="form-control product-normal-price-{{ $index }}" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">{{ __('Welfare Price') }}</label>
                                                    <input type="text" class="form-control product-welfare-price-{{ $index }}" readonly>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Serial Numbers') }} <span class="text-danger">*</span></label>
                                                <small class="text-muted d-block mb-2">{{ __('Enter') }} {{ $item->qty }} {{ __('serial numbers') }}</small>
                                                @for($i = 0; $i < $item->qty; $i++)
                                                    <div class="mb-2">
                                                        <div class="input-group">
                                                            <span class="input-group-text">{{ $i + 1 }}</span>
                                                            <input type="text" 
                                                                   name="stocks[{{ $index }}][serial_numbers][]" 
                                                                   class="form-control serial-number-input" 
                                                                   placeholder="{{ __('Serial Number') }} {{ $i + 1 }}"
                                                                   data-index="{{ $index }}"
                                                                   data-serial-index="{{ $i }}"
                                                                   required>
                                                        </div>
                                                        <div class="serial-error-{{ $index }}-{{ $i }} text-danger small mt-1" style="display: none;"></div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ __('Save Stock') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle product selection
        document.querySelectorAll('.product-select').forEach(select => {
            select.addEventListener('change', function() {
                const index = this.dataset.index;
                const selectedOption = this.options[this.selectedIndex];
                
                if (selectedOption.value) {
                    document.querySelector(`.product-code-${index}`).value = selectedOption.dataset.code || '';
                    document.querySelector(`.product-category-${index}`).value = selectedOption.dataset.category || '';
                    document.querySelector(`.product-normal-price-${index}`).value = selectedOption.dataset.normalPrice || '';
                    document.querySelector(`.product-welfare-price-${index}`).value = selectedOption.dataset.welfarePrice || '';
                } else {
                    document.querySelector(`.product-code-${index}`).value = '';
                    document.querySelector(`.product-category-${index}`).value = '';
                    document.querySelector(`.product-normal-price-${index}`).value = '';
                    document.querySelector(`.product-welfare-price-${index}`).value = '';
                }
            });
        });

        // Validate serial numbers on blur
        document.querySelectorAll('.serial-number-input').forEach(input => {
            input.addEventListener('blur', function() {
                const serialNumber = this.value.trim();
                const index = this.dataset.index;
                const serialIndex = this.dataset.serialIndex;
                const errorDiv = document.querySelector(`.serial-error-${index}-${serialIndex}`);
                
                if (serialNumber) {
                    // Check for duplicates in the form
                    let duplicateInForm = false;
                    document.querySelectorAll('.serial-number-input').forEach(otherInput => {
                        if (otherInput !== input && otherInput.value.trim() === serialNumber) {
                            duplicateInForm = true;
                        }
                    });

                    if (duplicateInForm) {
                        this.classList.add('is-invalid');
                        errorDiv.textContent = 'This serial number is already entered in the form.';
                        errorDiv.style.display = 'block';
                        return;
                    }

                    // Check for duplicates in database via AJAX
                    fetch('{{ route("stocks.checkSerial") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ serial_number: serialNumber })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            this.classList.add('is-invalid');
                            errorDiv.textContent = 'This serial number already exists in the database.';
                            errorDiv.style.display = 'block';
                        } else {
                            this.classList.remove('is-invalid');
                            errorDiv.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error checking serial number:', error);
                    });
                } else {
                    this.classList.remove('is-invalid');
                    errorDiv.style.display = 'none';
                }
            });
        });

        // Prevent form submission if there are invalid serial numbers
        document.querySelector('form').addEventListener('submit', function(e) {
            const invalidInputs = document.querySelectorAll('.serial-number-input.is-invalid');
            if (invalidInputs.length > 0) {
                e.preventDefault();
                alert('Please fix the duplicate serial numbers before submitting.');
                invalidInputs[0].focus();
                return false;
            }
        });
    });
</script>
@endsection
