<!-- Edit Regement Modal -->
<div class="modal fade" id="RegementModalEdit" tabindex="-1" role="dialog" aria-labelledby="editRegementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title font-weight-bold" id="editRegementModalLabel">{{ __('Edit Regement') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="editRegementForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <input type="hidden" name="regement_id" id="editRegementId">

                    <!-- Regement Field -->
                    <div class="form-group mb-3">
                        <label for="editRegement">{{ __('Regement') }}</label>
                        <select name="regement" id="editRegement" class="form-control">
                            <option value="" disabled selected>-- Select Regement --</option>

                            @php
                                $regements = [
                                    'Sri Lanka Armoured Corps',
                                    'Sri Lanka Artillery',
                                    'Sri Lanka Engineers',
                                    'Sri Lanka Signals Corps',
                                    'Sri Lanka Light Infantry',
                                    'Sri Lanka Sinha Regiment',
                                    'Gemunu Watch',
                                    'Gajaba Regiment',
                                    'Vijayabahu Infantry Regiment',
                                    'Mechanized Infantry Regiment',
                                    'Commando Regiment',
                                    'Special Forces Regiment',
                                    'Military Intelligence Corps',
                                    'Engineer Services Regiment',
                                    'Sri Lanka Army Service Corps',
                                    'Sri Lanka Army Medical Corps',
                                    'Sri Lanka Army Ordnance Corps',
                                    'Sri Lanka Electrical and Mechanical Engineers',
                                    'Sri Lanka Corps of Military Police',
                                    'Sri Lanka Army General Service Corps',
                                    'Sri Lanka Army Women\'s Corps',
                                    'Sri Lanka Army Corps of Agriculture and Livestock',
                                    'Sri Lanka Rifle Corps',
                                    'Sri Lanka Army Pioneer Corps',
                                    'Sri Lanka National Guard'
                                ];
                            @endphp

                            @foreach ($regements as $regementOption)
                                <option value="{{ $regementOption }}">{{ $regementOption }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback d-block" id="editRegementError"></div>
                    </div>

                    <!-- Active Field -->
                    <div class="form-group">
                        <label for="editActive">{{ __('Status') }}</label>
                        <select name="active" id="editActive" class="form-control">
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Deactive') }}</option>
                        </select>
                        <div class="invalid-feedback d-block" id="editActiveError"></div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">{{ __('Back') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.btn-edit-regement').on('click', function () {
            const button = $(this);
            $('#editRegementId').val(button.data('id'));
            $('#editRegement').val(button.data('regement'));
            $('#editActive').val(button.data('active'));
            $('#editUpdatedAt').val(button.data('updated'));
            $('#editRegementForm').attr('action', button.data('action'));

            // Clear previous validation errors
            $('#editRegementError').text('');
            $('#editActiveError').text('');
        });
    });
</script>
