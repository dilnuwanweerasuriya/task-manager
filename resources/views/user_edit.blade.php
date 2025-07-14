<form id="validation-wizard" method="post" name="validationwizard" class="form-horizontal" action="/main/updateUser/{{ $user->id }}">
    @csrf
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" 
                                   name="full_name" placeholder="Full Name"
                                   value="{{ old('full_name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile No</label>
                            <input type="text" class="form-control" id="mobile" 
                                   name="mobile" placeholder="Mobile No"
                                   value="{{ old('mobile', $user->mobile) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="select2 form-control" name="gender" id="gender" required>
                                <option value="">Select a gender</option>
                                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Male</option>
                                <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" 
                                   name="email" placeholder="Email Address"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password 
                                <small class="text-muted">(leave blank to keep current)</small></label>
                            <input type="password" class="form-control" id="password" 
                                   name="password" placeholder="New Password">
                        </div>

                        <div class="mb-3">
                            <label for="userRole" class="form-label">User Role</label>
                            <select class="select2 form-control" id="userRole" name="user_role" required>
                                <option value="">Select a User Role</option>
                                @foreach ($user_role as $role)
                                    <option value="{{ $role->id }}" 
                                        {{ $user->user_role == $role->id ? 'selected' : '' }}>
                                        {{ $role->user_role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <button type="submit" class="btn btn-primary float-right">Update User</button>
            </div>
        </div>
    </section>
</form>


<script>
    $(document).ready(function() {
        $('#validation-wizard').validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.parent('.input-group').length || element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('span'));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);
            },
            rules: {
                full_name: {
                    required: true,
                    minlength: 2
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 8
                },
                gender: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    minlength: 6 // only validate length if entered
                },
                user_role: {
                    required: true
                }
            },
            messages: {
                full_name: {
                    required: "Please enter your full name",
                    minlength: "Name must be at least 2 characters"
                },
                mobile: {
                    required: "Please enter your mobile number",
                    digits: "Only digits allowed",
                    minlength: "Mobile must be at least 8 digits"
                },
                gender: {
                    required: "Please select a gender"
                },
                email: {
                    required: "Please enter your email",
                    email: "Enter a valid email"
                },
                password: {
                    minlength: "Password must be at least 6 characters"
                },
                user_role: {
                    required: "Please select a user role"
                }
            }
        });

        $('.select2').on('change', function() {
            $(this).valid();
        });
    });
</script>
