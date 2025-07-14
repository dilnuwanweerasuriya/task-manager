<form id="validation-wizard" method="post" name="validationwizard" class="form-horizontal" action="/main/doRegister">
    @csrf
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile No</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile No" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="select2 form-control" name="gender" id="gender" required>
                                <option>Select a gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>

                        <div class="mb-3">
                            <label for="userRole" class="form-label">User Role</label>
                            <select class="select2 form-control" id="userRole" name="user_role" required>
                                <option value="">Select a User Role</option>
                                @foreach ($user_role as $role)
                                    <option value="{{ $role->id }}">{{ $role->user_role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
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
                    error.insertAfter(element.next('span')); // for select2
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
                    required: true,
                    minlength: 6
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
                    required: "Please provide a password",
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