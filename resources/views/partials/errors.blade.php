@if (isset($errors)&&count($errors) > 0)
    <div class="col-xs-12">
        <div class="alert alert-dismissable alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <li><strong>{{ $errors  }}</strong></li>
        </div>
    </div>
@endif