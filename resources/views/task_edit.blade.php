<section class="content mb-5">
    <div class="container-fluid">
        <form method="post" action="/updateTask/{{ $task_data->id }}" enctype="multipart/form-data" id="form-submit-validation">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Task</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="task-title">Task Title</label>
                                        <input type="text" class="form-control" id="task-title" name="task_title"
                                            value="{{ $task_data->task_title }}" required placeholder="Enter Task Title">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Task Category</label>
                                        <select class="form-control select2 select2-info" name="category" required style="width:100%;">
                                            <option value="">Select a Category</option>
                                            <option value="ui-design" {{ $task_data->category == 'ui-design' ? 'selected' : '' }}>UI Designing</option>
                                            <option value="development" {{ $task_data->category == 'development' ? 'selected' : '' }}>Development</option>
                                            <option value="requirement-analyst" {{ $task_data->category == 'requirement-analyst' ? 'selected' : '' }}>Requirement Analysis</option>
                                            <option value="seo" {{ $task_data->category == 'seo' ? 'selected' : '' }}>SEO</option>
                                            <option value="db-design" {{ $task_data->category == 'db-design' ? 'selected' : '' }}>Database Design</option>
                                            <option value="db-implementation" {{ $task_data->category == 'db-implementation' ? 'selected' : '' }}>Database Implementation</option>
                                            <option value="db-modifications" {{ $task_data->category == 'db-modifications' ? 'selected' : '' }}>Database Modifications</option>
                                            <option value="quality-assurance" {{ $task_data->category == 'quality-assurance' ? 'selected' : '' }}>Quality Assurance</option>
                                            <option value="bug-fix" {{ $task_data->category == 'bug-fix' ? 'selected' : '' }}>Bug Fixing</option>
                                            <option value="project-meeting" {{ $task_data->category == 'project-meeting' ? 'selected' : '' }}>Project Meeting</option>
                                            <option value="client-meeting" {{ $task_data->category == 'client-meeting' ? 'selected' : '' }}>Client Meeting</option>
                                            <option value="devops" {{ $task_data->category == 'devops' ? 'selected' : '' }}>DevOps</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Priority</label>
                                        <select class="form-control select2 select2-info" name="priority" style="width:100%;">
                                            <option value="high" {{ $task_data->priority == 'high' ? 'selected' : '' }}>High</option>
                                            <option value="medium" {{ $task_data->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="low" {{ $task_data->priority == 'low' ? 'selected' : '' }}>Low</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hours</label>
                                        <select class="form-control select2 select2-info task-time" name="hours" required style="width:100%;">
                                            <option value="">Select Hours</option>
                                            @for ($i = 0; $i <= 50; $i++)
                                                <option value="{{ $i }}" {{ $task_data->hours == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Minutes</label>
                                        <select class="form-control select2 select2-info task-time" name="minutes" required style="width:100%;">
                                            <option value="">Select Minutes</option>
                                            @for ($i = 0; $i <= 60; $i++)
                                                <option value="{{ $i }}" {{ $task_data->minutes == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" rows="5" required class="form-control"
                                            placeholder="Enter Task Description">{{ $task_data->description }}</textarea>
                                    </div>
                                </div>

                                @if(Auth::user()->user_role == 1)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="assigned_to">Assigned To</label>
                                            <select class="form-control select2 select2-info" name="assigned_to" style="width:100%;">
                                                @foreach($user_list as $user)
                                                    <option value="{{ $user->id }}" {{ $task_data->assigned_to == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right mb-2">Update</button>
            </div>
        </form>
    </div>
</section>


