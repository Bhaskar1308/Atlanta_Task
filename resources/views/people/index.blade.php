<!DOCTYPE html>
<html>
<head>
  <title>Laravel 10 - Team CRUD with DataTable</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <style>
    body {
      background: #f6f8fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .header {
      background: linear-gradient(to right, #3f51b5, #5c6bc0);
      color: white;
      padding: 20px 30px;
      border-radius: 0 0 8px 8px;
      margin-bottom: 20px;
    }
    .btn-add {
      background-color: #28a745;
      color: white;
      font-weight: bold;
    }
    .btn-filter {
      background-color: #007bff;
      color: white;
      font-weight: bold;
    }
    .table-card {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      padding: 20px;
    }
    .modal-content {
      border-radius: 8px;
      border: none;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    .modal-header {
      background: #3f51b5;
      color: white;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }
    .modal-title {
      font-weight: bold;
    }
  </style>
</head>
<body>
<div class="header d-flex justify-content-between align-items-center">
  <h2 class="mb-0">Team</h2>
  <div>
    <button class="btn btn-add me-2" id="addBtn">+ Add</button>
    <button class="btn btn-filter">🔍 Filter</button>
  </div>
</div>

<div class="container table-card">
  <table class="table table-bordered" id="peopleTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Role</th>
        <th>Designation</th>
        <th>Photo</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="personModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="personForm" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create New Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="personId" name="personId">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name*</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="ENTER FULL NAME">
              <small class="text-danger" id="error_name"></small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Mobile No*</label>
              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile No">
              <small class="text-danger" id="error_mobile"></small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email Id*</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Id">
              <small class="text-danger" id="error_email"></small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Address*</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
              <small class="text-danger" id="error_address"></small>
            </div>
            <div class="col-md-4">
              <label class="form-label">Role*</label>
              <select class="form-select" id="role" name="role">
                <option value="">Select Role</option>
                <option value="ADMIN">ADMIN</option>
                <option value="DESIGNER">DESIGNER</option>
                <option value="DEVELOPER">DEVELOPER</option>
              </select>
              <small class="text-danger" id="error_role"></small>
            </div>
            <div class="col-md-4">
              <label class="form-label">Designation*</label>
              <input type="text" class="form-control" id="designation" name="designation">
              <small class="text-danger" id="error_designation"></small>
            </div>
            <div class="col-md-4">
              <label class="form-label">Gender*</label>
              <select class="form-select" id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <small class="text-danger" id="error_gender"></small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Upload Photo</label>
              <input type="file" class="form-control" id="photo" name="photo">
              <small class="text-danger" id="error_photo"></small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select class="form-select" id="status" name="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
              <small class="text-danger" id="error_status"></small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark" id="saveBtn">Add Team</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Are You Sure for Delete This Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function () {
    const modal = new bootstrap.Modal('#personModal');
    const deleteModal = new bootstrap.Modal('#deleteConfirmModal');
    let deleteId = null;

    const table = $('#peopleTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ route("people.list") }}',
      columns: [
        { data: 'name' },
        { data: 'mobile' },
        { data: 'email' },
        { data: 'role' },
        { data: 'designation' },
        {
          data: 'photo',
          render: data => data ? `<img src="/uploads/${data}" width="40" height="40" class="rounded-circle">` : ''
        },
        {
          data: 'status',
          render: data => `<span class="badge bg-success">${data}</span>`
        },
        {
          data: 'id',
          render: id => `
            <div class="d-flex gap-1">
              <button class="btn btn-sm btn-warning editBtn" data-id="${id}" title="Edit">✏️</button>
              <button class="btn btn-sm btn-danger deleteBtn" data-id="${id}" title="Delete">🗑️</button>
            </div>`
        }
      ]
    });

    $('#addBtn').click(() => {
      $('#personForm')[0].reset();
      $('#personId').val('');
      $('.text-danger').html('');
      $('.modal-title').text('Create New Account');
      $('#saveBtn').text('Add Team');
      modal.show();
    });

    $('#peopleTable').on('click', '.editBtn', function () {
      const id = $(this).data('id');
      $.get(`/people/${id}`, function (data) {
        $('#personId').val(data.id);
        $('#name').val(data.name);
        $('#mobile').val(data.mobile);
        $('#email').val(data.email);
        $('#address').val(data.address);
        $('#role').val(data.role);
        $('#designation').val(data.designation);
        $('#gender').val(data.gender);
        $('#status').val(data.status);
        $('.modal-title').text('Update Team Details');
        $('#saveBtn').text('Update');
        modal.show();
      });
    });

    $('#peopleTable').on('click', '.deleteBtn', function () {
      deleteId = $(this).data('id');
      deleteModal.show();
    });

    $('#confirmDelete').click(function () {
      if (!deleteId) return;
      $.ajax({
        url: `/people/${deleteId}`,
        type: 'DELETE',
        data: { _token: $('meta[name="csrf-token"]').attr('content') },
        success: function () {
          table.ajax.reload();
          deleteModal.hide();
        }
      });
    });

    $('#personForm').submit(function (e) {
      e.preventDefault();
      const formData = new FormData(this);
      const id = $('#personId').val();
      const url = id ? `/people/${id}` : '{{ route("people.store") }}';
      if (id) formData.append('_method', 'PUT');

      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function () {
          modal.hide();
          table.ajax.reload();
        },
        error: function (xhr) {
          const res = xhr.responseJSON?.errors || {};
          $('#error_name').text(res.name ?? '');
          $('#error_mobile').text(res.mobile ?? '');
          $('#error_email').text(res.email ?? '');
          $('#error_address').text(res.address ?? '');
          $('#error_role').text(res.role ?? '');
          $('#error_designation').text(res.designation ?? '');
          $('#error_gender').text(res.gender ?? '');
          $('#error_photo').text(res.photo ?? '');
          $('#error_status').text(res.status ?? '');
        }
      });
    });
  });
</script>
</body>
</html>
