{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserRole">
    Add User Role
</button> --}}

{{-- <div class="modal fade" id="addUserRole" tabindex="-1" role="dialog" aria-labelledby="addUserRoleTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserRoleTitle">Add User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/createUserRole" method="post">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="user_role" placeholder="User Role" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<div class="card mt-3">
    <div class="card-body">
        <table id="user-role" class="table table-striped table-hover table-bordered table-head-fixed text-center"
            style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($userRoles)
                    @foreach ($userRoles as $roles)
                    <tr>
                        <td>{{ $roles->user_role }}</td>
                        <td><a href="/user-role-edit/{{ $roles->id }}"><i class="fas fa-solid fa-pen" style="color: black;"></i></a></td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>
     $(document).ready(function() {
        $('#user-role').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search users..."
            }
        });
    });
</script>
