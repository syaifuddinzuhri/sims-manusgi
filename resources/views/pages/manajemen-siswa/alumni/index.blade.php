@extends('layouts.app')

@section('title', 'Alumni')

@section('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Alumni', 'index' => true])
            <div class="row">
                <div class="col-12">
                    <button type="button" class="btn btn-sm btn-success mb-3" id="sync-table-alumni"><i
                            class="fas fa-sync"></i> Reload</button>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table-alumni" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto Profil</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Nomor HP</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tahun Lulus</th>
                                            <th>Login terakhir</th>
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
        let table = $("#table-alumni");
        let btnSyncTable = $("#sync-table-alumni");

        let classFilter = '';
        let genderFilter = '';

        $("#class-filter").on("change", function() {
            classFilter = $(this).val();
            datatable.draw();
        })

        $("#gender-filter").on("change", function() {
            genderFilter = $(this).val();
            datatable.draw();
        })

        var datatable = table.DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('alumni.index') }}",
                data: function(data) {
                    data.class = classFilter;
                    data.gender = genderFilter;
                }
            },
            columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "photo",
                },
                {
                    data: "name",
                },
                {
                    data: "username",
                },
                {
                    data: "email",
                },
                {
                    data: "phone",
                },
                {
                    data: "gender",
                },
                {
                    data: "passed_year",
                },
                {
                    data: "last_login",
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
