<form id="validation-wizard" method="post" name="validationwizard" class="form-horizontal"
    action="{{ url('/edit_user_role_permissions') }}">
    @csrf
    <input type="hidden" id="id" name="id" value="{{ $id }}">
    <section>
        <!-- Ribbon -->
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">{{ $user_role->user_role }} Role Permissions</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            @php $i = 0; @endphp
            @foreach ($user_role_permission as $key => $data)
                <li class="nav-item">
                    <a class="nav-link @if ($i == 0) active @endif" data-toggle="tab" href="#tab_{{ $key }}" role="tab"
                        aria-selected="{{ $i == 0 ? 'true' : 'false' }}">{{ $key }}</a>
                </li>
                @php $i++; @endphp
            @endforeach
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            @php $i = 0; @endphp
            @foreach ($user_role_permission as $key => $data)
                <div class="tab-pane fade show @if ($i == 0) active @endif" id="tab_{{ $key }}" role="tabpanel">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-sm select-all mb-3" data-tab="{{ $key }}">Select All</button>
                        @foreach ($data as $item)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="permission_{{ $i }}"
                                    name="permission[{{ $i }}]" value="{{ $item['id'] }}"
                                    @if (in_array($item['id'], $selected_permission)) checked @endif>
                                <label class="custom-control-label"
                                    for="permission_{{ $i }}">{{ $item['display_text'] }}</label>
                            </div>
                            @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary float-right">Update</button>
            </div>
        </div>
    </section>
</form>

<script>
    $(document).ready(function() {
        $('.select-all').click(function() {
            var tabId = $(this).data('tab');
            var checkboxes = $('#tab_' + tabId + ' input[type="checkbox"]');
            var checkedLength = checkboxes.filter(':checked').length;

            checkboxes.each(function() {
                $(this).prop('checked', checkboxes.length !== checkedLength);
            });
        });
    });
</script>
