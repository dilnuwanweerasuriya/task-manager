<style>
    .btn-active.active {
        background-color: #007bff;
        color: #fff;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                @foreach ($task_status as $status)
                    <button type="button" id="statusBtn{{ $status->id }}" onclick="showData({{ $status->id }})"
                        class="btn btn-{{ $status->style }} btn-sm mr-1 btn-active"><i></i>{{ $status->task_status }}</button>
                @endforeach
            </div>
            <div class="card-body p-0">
                <table id="task-list" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Title</th>
                            <th>Description</th>
                            <th>Allocated Time</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="taskDataTbl">
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</section>
<!-- /.content -->

<script>
    let currentStatusId = null;


    $(document).ready(function() {
        showData(1);
        $('#task-list').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
    });

    function showData(id) {
        currentStatusId = id;
        $('.card-header .btn-active').removeClass('active');
        $('#statusBtn' + id).addClass('active');

        $.ajax({
            url: '/my-tasks/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(tasks) {
                let rows = '';
                tasks.forEach((task, index) => {
                    rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${task.task_title}</td>
                        <td>${task.description}</td>
                        <td>${task.allocated_time}</td>
                        <td class="text-center"><label class="badge" style="background-color: ${task.style}">${task.task_status}</label></td>
                        <td>
                            ${ task.task_status == 'Pending' ? `
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="markCompleted(${task.id})">Mark as Completed</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="markCancelled(${task.id})">Mark as Cancelled</a>
                                    <a class="dropdown-item" href="/task-edit/${task.id}">Edit</a>
                                </div>
                            </div>
                        ` : '' }
                        </td>
                    </tr>
                `;
                });
                $('#taskDataTbl').html(rows);
            },
            error: function() {
                alert('Could not load tasks.');
            }
        });
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateTaskStatus(taskId, action, successMsg, errorMsg) {
        $.ajax({
            url: '/my-tasks/' + taskId + '/' + action,
            type: 'POST',
            success: function(response) {
                Swal.fire(successMsg, '', 'success');
                showData(currentStatusId);
            },
            error: function() {
                Swal.fire(errorMsg, '', 'error');
            }
        });
    }

    function markCompleted(taskId) {
        updateTaskStatus(taskId, 'complete', 'Task marked as Completed!', 'Failed to mark as Completed.');
    }

    function markCancelled(taskId) {
        updateTaskStatus(taskId, 'cancel', 'Task marked as Cancelled!', 'Failed to mark as Cancelled.');
    }
</script>
