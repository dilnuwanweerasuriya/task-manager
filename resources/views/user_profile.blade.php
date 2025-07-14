<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src='/dist/img/avatar5.png'
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>


                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right text-capitalize">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender</b> <a class="float-right text-capitalize">{{ Auth::user()->gender }}</a>
                            </li>
                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="btn btn-outline-info active" href="#settings"
                                    data-toggle="tab">Settings</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <form class="form-horizontal" action="{{ route('change-password') }}" method='post' id="form-submit-validation">
                                @csrf
                                <div class="form-group">
                                    <label for="password1">Old Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" required id="password1" name="password" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback" style="display: none;"></div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password2">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" required id="password2" name="new_password" placeholder="New Password">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback" style="display: none;"></div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <input type="password" class="form-control" required id="password_confirmation" name="new_password_confirmation" placeholder="Confirm New Password">
                                    <div class="invalid-feedback" style="display: none;"></div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>


<script>
    $(document).ready(function() {
        $('#password1').on('change', function() {
            var oldPassword = $(this).val();
            var token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ route('check-current-password') }}",
                method: 'POST',
                data: {
                    _token: token,
                    password: oldPassword
                },
                success: function(response) {
                    if (!response.valid) {
                        $('#password1').addClass('is-invalid');
                        $('#password1').next('.invalid-feedback').text(
                            'The provided password does not match your current password.'
                            ).show();
                    } else {
                        $('#password1').removeClass('is-invalid');
                        $('#password1').next('.invalid-feedback').hide();
                    }
                }
            });
        });

        $('#password2, #password_confirmation').on('keyup', function() {
            var newPassword = $('#password2').val();
            var confirmPassword = $('#password_confirmation').val();

            if (newPassword !== confirmPassword) {
                $('#password_confirmation').addClass('is-invalid');
                $('#password_confirmation').next('.invalid-feedback').text(
                    'New password and confirmation do not match.').show();
            } else {
                $('#password_confirmation').removeClass('is-invalid');
                $('#password_confirmation').next('.invalid-feedback').hide();
            }
        });
    })
</script>
