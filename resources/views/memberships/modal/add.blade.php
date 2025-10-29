<div class="modal fade" id="ModalMembershipCreate" tabindex="-1" role="dialog" aria-labelledby="ModalMembershipTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> {{-- Changed to modal-lg for more fields --}}
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="m-0 font-weight-bold">{{ __('Add New Membership') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('memberships.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    
                    {{-- FIX: Added hidden field for 'active' to satisfy validation requirement on creation --}}
                    <input type="hidden" name="active" value="1"> 
                    
                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <label for="name">{{ __('Name') }}</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name') }}"
                                placeholder="{{ __('Enter Member Name') }}"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="email">{{ __('Email') }}</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email') }}"
                                placeholder="{{ __('Enter Email Address') }}"
                            >
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mt-3">
                            <label for="mobile">{{ __('Mobile') }}</label>
                            <input 
                                type="text" 
                                name="mobile" 
                                id="mobile" 
                                class="form-control @error('mobile') is-invalid @enderror" 
                                value="{{ old('mobile') }}"
                                placeholder="{{ __('Enter Mobile Number') }}"
                                required
                            >
                            @error('mobile')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="army_id">{{ __('Army ID') }}</label>
                            <input 
                                type="text" 
                                name="army_id" 
                                id="army_id" 
                                class="form-control @error('army_id') is-invalid @enderror" 
                                value="{{ old('army_id') }}"
                                placeholder="{{ __('Enter Army ID') }}"
                                required
                            >
                            @error('army_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="regiment_no">{{ __('Regiment No') }}</label>
                            <input 
                                type="text" 
                                name="regiment_no" 
                                id="regiment_no" 
                                class="form-control @error('regiment_no') is-invalid @enderror" 
                                value="{{ old('regiment_no') }}"
                                placeholder="{{ __('Enter Regiment Number') }}"
                            >
                            @error('regiment_no')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="nic">{{ __('NIC') }}</label>
                            <input 
                                type="text" 
                                name="nic" 
                                id="nic" 
                                class="form-control @error('nic') is-invalid @enderror" 
                                value="{{ old('nic') }}"
                                placeholder="{{ __('Enter National ID Card No.') }}"
                                required
                            >
                            @error('nic')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-9 mt-3">
                            <label for="address">{{ __('Address') }}</label>
                            <textarea 
                                name="address" 
                                id="address" 
                                class="form-control @error('address') is-invalid @enderror" 
                                rows="2" 
                                placeholder="{{ __('Enter Address') }}"
                            >{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> {{-- End of Row --}}
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('Add Membership') }}</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('Back') }}</button>
            </div>
                </form>
        </div>
    </div>
</div>

@if ($errors->any())
    {{-- Check if any error keys correspond to Membership fields --}}
    @php
        $membership_fields = ['name', 'email', 'mobile', 'address', 'membership_date', 'army_id', 'regiment_no', 'nic', 'active'];
        $has_membership_errors = false;
        foreach ($errors->keys() as $key) {
            if (in_array($key, $membership_fields)) {
                $has_membership_errors = true;
                break;
            }
        }
    @endphp

    @if($has_membership_errors)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Ensure Bootstrap is loaded if you rely on its Modal class, 
                // otherwise fall back to jQuery if available.
                const modalElement = document.getElementById('ModalMembershipCreate');
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                } else if (typeof $ !== 'undefined') {
                    $('#ModalMembershipCreate').modal('show');
                }
            });
        </script>
    @endif
@endif