<div class="row mt-3">
    <div class="col-md-6">
        Showing {{ $datas->currentPage() }} to {{ $datas->perPage() }} of
        {{ $datas->total() }} entries
    </div>
    <div class="col-md-6">
        <div class="float-md-right">
            {!! $datas->withQueryString()->links() !!}
        </div>
    </div>
</div>
