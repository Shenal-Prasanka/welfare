<!-- Modal -->
<div class="modal fade" id="RankmodalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="m-0 font-weight-bold">{{ __('Add New Rank') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ranks.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <!-- Rank Field -->
                    <div class="col-md-12">
                        <label for="rank" class="form-label">{{ __('Rank') }}</label>
                        <input type="text"
                            name="rank"
                            id="rank"
                            class="form-control @error('rank') is-invalid @enderror"
                            placeholder="{{ __('Enter Rank...') }}"
                            value="{{ old('rank') }}"
                            required>

                        @error('rank')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">Please provide a valid rank.</div>
                        @enderror
                    </div>
                                        <!-- Type Field -->
                    <div class="col-md-12  mt-3">
                        <label for="type">{{ __('Type') }}</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror"
                            required>
                            <option value="" disabled selected>{{ __('Choose Type....') }}</option>
                            <option value="COMMISSIONED OFFICERS">OFFICERS</option>
                            <option value="WARRANT OFFICERS">OTHERS </option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">Please provide a valid type.</div>
                        @enderror
                    </div>
                    <!-- Active Field -->
                    <div class="col-md-12  mt-3">
                        <label for="active" class="form-label">{{ __('Status') }}</label>
                        <select name="active" id="active" class="form-select @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>{{ __('Active') }}
                            </option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>{{ __('Deactive') }}
                            </option>
                        </select>
                        @error('active')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Add Rank') }}</button>
                        <button type="button" class="btn btn-warning"
                            data-dismiss="modal">{{ __('Back') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Auto Open Modal if Errors Exist -->
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('RankmodalCreate'));
                modal.show();
            });
        </script>
    @endif
