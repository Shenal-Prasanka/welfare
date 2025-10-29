<!-- Edit Rank Modal -->
<div class="modal fade" id="editRankModal" tabindex="-1" role="dialog" aria-labelledby="editRankModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="editRankModalLabel">{{ __('Edit Rank') }}</h5>
        <a type="button" class="close text-white" href="{{ route('ranks.index') }}">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>

      <div class="modal-body">
        <form id="editRankForm" method="POST">
          @csrf
          @method('PUT')

          <!-- Rank Field -->
         <div class="col-md-12">
            <label for="edit_rank">{{ __('Rank') }}</label>
            <select name="rank" id="edit_rank" class="form-control" required>
              <option value="">{{ __('Choose Rank....') }}</option>
              <option value="" disabled>{{ __('COMMISSIONED OFFICERS') }}</option>
              <option value="Field Marshal">Field Marshal</option>
              <option value="General">General</option>
              <option value="Lieutenant General">Lieutenant General</option>
              <option value="Major General">Major General</option>
              <option value="Brigadier">Brigadier</option>
              <option value="Colonel">Colonel</option>
              <option value="Lieutenant Colonel">Lieutenant Colonel</option>
              <option value="Major">Major</option>
              <option value="Captain">Captain</option>
              <option value="Lieutenant">Lieutenant</option>
              <option value="2nd Lieutenant">2nd Lieutenant</option>
              <option value="" disabled>{{ __('WARRANT OFFICERS') }}</option>
              <option value="Warrant Officer Class1">Warrant Officer Class 1</option>
              <option value="Warrant Officer Class2">Warrant Officer Class 2</option>
              <option value="Staff Sergeant">Staff Sergeant</option>
              <option value="Sergeant">Sergeant</option>
              <option value="Corporal">Corporal</option>
              <option value="Lance Corporal">Lance Corporal</option>
              <option value="Private">Private</option>
            </select>
          </div>

          <!-- Type Field -->
         <div class="col-md-12 mt-3">
            <label for="edit_type">{{ __('Type') }}</label>
            <select name="type" id="edit_type" class="form-control" required>
              <option value="" disabled selected>{{ __('Choose Type....') }}</option>
              <option value="COMMISSIONED OFFICERS">COMMISSIONED OFFICERS</option>
              <option value="WARRANT OFFICERS">WARRANT OFFICERS</option>
            </select>
          </div>

          <!-- Active Field -->
          <div class="col-md-12 mt-3">
            <label for="edit_active">{{ __('Status') }}</label>
            <select name="active" id="edit_active" class="form-control">
              <option value="1">{{ __('Active') }}</option>
              <option value="0">{{ __('Deactive') }}</option>
            </select>
          </div>

          <div class="modal-footer mt-3">
            <button type="submit" class="btn btn-primary">{{ __('Update Rank') }}</button>
            <a href="{{ route('ranks.index') }}" class="btn btn-warning">{{ __('Close') }}</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-edit-rank').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const rank = this.dataset.rank;
            const type = this.dataset.type;
            const active = this.dataset.active;
            const action = this.dataset.action;

            // Set form values
            document.getElementById('editRankForm').action = action;
            document.getElementById('edit_rank').value = rank;
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_active').value = active;

            // Reset validation errors (if you have error spans)
            if(document.getElementById('editRankError')) document.getElementById('editRankError').textContent = '';
            if(document.getElementById('editTypeError')) document.getElementById('editTypeError').textContent = '';
            if(document.getElementById('editActiveError')) document.getElementById('editActiveError').textContent = '';

            // Show modal (Bootstrap 4.5)
            $('#editRankModal').modal('show');
        });
    });
});
</script>
