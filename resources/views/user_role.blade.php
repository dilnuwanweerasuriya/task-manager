<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserRole">
    Add User Role
</button>

<div class="modal fade" id="addUserRole" tabindex="-1" role="dialog" aria-labelledby="addUserRoleTitle" aria-hidden="true">
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
</div>

<div id="table" class="mt-3">
    <table id="user-role" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($userRoles)
                @foreach ($userRoles as $roles)
                    <th>{{ $roles->user_role }}</th>
                    <th><a href="/user-role-edit/{{ $roles->id }}"><i class="fas fa-solid fa-pen" style="color: black;"></i></a></th>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<script>
    let table = $('#user-role').DataTable();
</script>
