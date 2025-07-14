<style>
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px;
        padding-left: 15px;
        border: 1px solid #ced4da;
    }

    table.dataTable {
        border-radius: 8px;
        overflow: hidden;
    }

    table.dataTable tbody tr:hover {
        background-color: #f5f5f5;
    }

    .dt-buttons .btn {
        margin-right: 5px;
    }
</style>

<div class="card mt-3">
    <div class="card-body">
        <table id="user-list" class="table table-striped table-hover table-bordered table-head-fixed text-center"
            style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr id="row-{{ $user->id }}">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->UserRole->user_role }}</td>
                        <td>
                            <a href="/user-edit/{{ $user->id }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete <strong id="userName"></strong>?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Yes, Delete</button>
            </div>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#user-list').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search users..."
            }
        });
    });

    var userId;

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        userId = button.data('id');
        var name = button.data('name');

        $('#userName').text(name);
    });

    $('#confirmDelete').click(function(){
        $.ajax({
            url: '/user-delete/' + userId,
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                
                var table = $('#user-list').DataTable();
                table.row('#row-' + userId).remove().draw(false);
                Swal.fire('success', 'User deleted successfully');


            },
            error: function(xhr) {
                console.log(xhr.responseText);
                Swal.fire('error', 'Something went wrong');
            }
        });
    });
</script>
