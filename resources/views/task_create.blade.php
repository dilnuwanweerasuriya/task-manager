<section class="content mb-5">
    <div class="container-fluid">
        <form method='post' action="/createTask" enctype="multipart/form-data" id="form-submit-validation">
            @csrf
            <div class="row">

                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Task Details</h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="task-title">Task Title</label>
                                        <input type="text" class="form-control" id="task-title" required
                                            name="task_title" placeholder="Enter Task Title" value="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Task Category</label>
                                        <select class="form-control select2 select2-info" required
                                            data-dropdown-css-class="select2-info" style="width: 100%;" name="category">
                                            <option value="">Select a Category</option>
                                            {{-- all the work done by an organization --}}
                                            <option value="ui-design">UI Designing</option>
                                            <option value="development">Development</option>
                                            <option value="requirement-analyst">Requirement Analysis</option>
                                            <option value="seo">SEO</option>
                                            <option value="db-design">Database Design</option>
                                            <option value="db-implementation">Database Implementation</option>
                                            <option value="db-modifications">Database Modifications</option>
                                            <option value="quality-assurance">Quality Assurance</option>
                                            <option value="bug-fix">Bug Fixing</option>
                                            <option value="project-meeting">Project Meeting</option>
                                            <option value="client-meeting">Client Meeting</option>
                                            <option value="devops">DevOps</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Priority</label>
                                        <select class="form-control select2 select2-info"
                                            data-dropdown-css-class="select2-info" style="width: 100%;" name="priority">
                                            {{-- priority for an project --}}
                                            <option selected value="high">High</option>
                                            <option value="medium">Medium</option>
                                            <option value="low">Low</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hours</label>
                                        <select class="form-control select2 select2-info task-time " required
                                            data-dropdown-css-class="select2-info" style="width: 100%;" name="hours">
                                            <option value="">Select a Hours</option>
                                            @for ($i = 0; $i <= 50; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Minutes</label>
                                        <select class="form-control select2 select2-info task-time " required
                                            data-dropdown-css-class="select2-info" style="width: 100%;" name="minutes">
                                            <option value="">Select a Minutes</option>
                                            @for ($i = 0; $i <= 60; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="5" required class="form-control"
                                            placeholder="Enter Task Description"></textarea>
                                    </div>
                                </div>

                                @if(Auth::user()->user_role == 1)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="assigned_to">Assigned To</label>
                                            <select class="form-control select2 select2-info"
                                                data-dropdown-css-class="select2-info" style="width: 100%;" name="assigned_to">
                                                @foreach($user_list as $user)
                                                <option value="{{$user->id}}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->

                </div>

                <!--/.col (right) -->
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right mb-2">Submit</button>
            </div>
        </form>
        <!-- /.row -->
        <!-- <hr> -->
    </div><!-- /.container-fluid -->
</section>


<script>
    $(document).ready(function() {
        // Initialize select2
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        // jQuery Validation setup
        $('#form-submit-validation').validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('span.select2')); // for select2
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass(errorClass).removeClass(validClass);
                if ($(element).hasClass('select2-hidden-accessible')) {
                    $(element).next('span.select2').find('.select2-selection').addClass(errorClass);
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);
                if ($(element).hasClass('select2-hidden-accessible')) {
                    $(element).next('span.select2').find('.select2-selection').removeClass(errorClass).addClass(validClass);
                }
            },
            rules: {
                task_title: {
                    required: true,
                    minlength: 3
                },
                category: {
                    required: true
                },
                priority: {
                    required: true
                },
                hours: {
                    required: true
                },
                minutes: {
                    required: true
                },
                description: {
                    required: true,
                    minlength: 5
                },
                assigned_to: {
                    required: function() {
                        return @json(Auth::user()->user_role == 1);
                    }
                }
            },
            messages: {
                task_title: {
                    required: "Please enter the task title",
                    minlength: "Task title must be at least 3 characters"
                },
                category: {
                    required: "Please select a category"
                },
                priority: {
                    required: "Please select a priority"
                },
                hours: {
                    required: "Please select hours"
                },
                minutes: {
                    required: "Please select minutes"
                },
                description: {
                    required: "Please enter a description",
                    minlength: "Description must be at least 5 characters"
                },
                assigned_to: {
                    required: "Please select a user to assign"
                }
            }
        });

        // Trigger validation on change for select2
        $('.select2').on('change', function() {
            $(this).valid();
        });
    });
</script>