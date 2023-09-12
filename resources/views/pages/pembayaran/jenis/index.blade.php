@extends('layouts.app')

@section('title', 'Jenis Pembayaran')

@section('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Jenis Pembayaran', 'index' => true])
            <div class="row">
                <div class="col-12">
                    @can('create-pembayaran-jenis')
                        <a href="{{ route('jenis.create') }}" class="btn btn-sm btn-primary mb-3"><i
                                class="fas fa-plus-circle"></i> Tambah
                        </a>
                    @endcan
                    <button type="button" class="btn btn-sm btn-success mb-3" id="sync-table-jenis"><i
                            class="fas fa-sync"></i> Reload</button>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table-jenis" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>POS Pembayaran</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Tipe Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('library/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('library/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        let table = $("#table-jenis");
        let btnSyncTable = $("#sync-table-jenis");

        table.DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('jenis.index') }}",
            },
            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "pos",
                    name: "pos",
                },
                {
                    data: "tahun",
                    name: "tahun",
                },
                {
                    data: "type",
                    name: "type",
                },
                {
                    data: "action",
                    name: "action",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
            ],
        });

        btnSyncTable.on("click", function() {
            table.DataTable().ajax.reload();
        });

        table.on("click", ".delete", function(e) {
            var delete_url = $(this).closest("tr").attr("url");
            var form_delete = $('#form-delete');
            form_delete.attr('action', delete_url);
        });
    </script>
@endsection
