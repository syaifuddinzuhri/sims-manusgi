<div class="card-header-form">
    <form method="GET" action="{{ $action }}">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="keyword"
                value="{{ app('request')->input('keyword') }}">
            <div class="input-group-btn">
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
