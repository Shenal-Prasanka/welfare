<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="editUserModalLabel">Edit Welfare Shop Access</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="editUserForm" method="POST" enctype="multipart/form-data" novalidate>
          @csrf
          @method('PUT')

          <div class="col-md-12">
            <label for="modal_name">{{ __('Name') }}</label>
            <input type="text" id="modal_name" name="name" class="form-control" readonly>
          </div>

          <div class="col-md-12  mt-3">
            <label for="modal_email">{{ __('Email') }}</label>
           <input type="email" id="modal_email" name="email" class="form-control" readonly>
          </div>

          <div class="col-md-12  mt-3">
            <label for="modal_role">{{ __('Role') }}</label>
            <input type="text" id="modal_role" class="form-control" readonly>
          </div>

          <div class="col-md-12  mt-3">
            <label for="modal_welfare">{{ __('Welfareshop') }}</label>
            <select name="welfare_id" id="modal_welfare" class="form-select" required>
              <option value="" disabled>Select Welfareshop</option>
              @foreach ($welfares as $welfare)
                <option value="{{ $welfare->id }}">{{ $welfare->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<script>
 document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-edit');
    const form = document.getElementById('editUserForm');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');
            const welfare = button.getAttribute('data-welfare');

            // Populate modal fields
            document.getElementById('modal_name').value = name;
            document.getElementById('modal_email').value = email;
            document.getElementById('modal_role').value = role;

            // Set selected option
            const select = document.getElementById('modal_welfare');
            select.value = welfare;

            // Use the proper route
            form.action = button.getAttribute('data-action');
        });
    });
});

  
</script>
