<style>
    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }

    .attendance-icon {
        background-color: #f00;
        color: #fff;
        padding: 15px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .attendance-info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .attendance-button {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    .attendance-button:hover {
        background-color: #3e8e41;
    }

    .attendance-button.check-out {
        background-color: rgb(212, 18, 18);
    }

    .attendance-button.check-out:hover {
        background-color: rgb(187, 12, 12);
    }

    .attendance-button.check-in {
        background-color: #4CAF50;
    }

    .attendance-button.check-in:hover {
        background-color: #3e8e41;
    }

    .profile {
        text-align: center;
        width: 300px;
    }

    .profile img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .profile h3 {
        margin-bottom: 5px;
    }

    .profile p {
        color: #777;
        margin-bottom: 15px;
    }

    .profile .button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: block;
        width: fit-content;
        margin: 0 auto;
    }

    .profile .button:hover {
        background-color: #3e8e41;
    }

    .profile .email {
        margin-top: 15px;
    }

    .profile .email a {
        color: #007bff;
        text-decoration: none;
    }

    .profile .email a:hover {
        text-decoration: underline;
    }
</style>

<div class="row">
    @if(Auth::user()->user_role == 1)
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $userCount }}</h3>

                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="/user-list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endif
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $taskCount }}</h3>

                <p>Pending Tasks</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/my-tasks" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>



<script>
    var userId = @json(Auth::user()->id);
</script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
