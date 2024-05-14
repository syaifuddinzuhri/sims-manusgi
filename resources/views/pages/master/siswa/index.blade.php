@extends('layouts.app')

@section('title', 'Siswa')

@section('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('main')
    <div class="main-content">
        <section class="section">
            @include('components.section-header', ['title' => 'Siswa', 'index' => true])
            <div class="row">
                <div class="col-12">
                    @can('create-master-siswa')
                        <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-primary mb-3"><i
                                class="fas fa-plus-circle"></i> Tambah
                        </a>
                        <a href="{{ route('siswa.import.index') }}" class="btn btn-sm btn-info mb-3"><i
                                class="fas fa-file-import"></i> Import Data Siswa</a>
                    @endcan
                    <button type="button" class="btn btn-sm btn-success mb-3" id="sync-table-siswa"><i
                            class="fas fa-sync"></i> Reload</button>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label for="class-filter">Kelas</label>
                                        <select id="class-filter" class="form-control select2">
                                            <option value="">Semua</option>
                                            @foreach (classOptions() as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label for="gender-filter">Jenis Kelamin</label>
                                        <select id="gender-filter" class="form-control select2">
                                            <option value="">Semua</option>
                                            @foreach (genderOptions() as $item)
                                                <option value="{{ $item['id'] }}">
                                                    {{ $item['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table-siswa" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto Profil</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Kelas</th>
                                            <th>Nomor HP</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Login terakhir</th>
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
        let table = $("#table-siswa");
        let btnSyncTable = $("#sync-table-siswa");

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
                url: "{{ route('siswa.index') }}",
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
                    data: "class",
                },
                {
                    data: "phone",
                },
                {
                    data: "gender",
                },
                {
                    data: "last_login",
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

        table.on("click", ".delete-payment", function(e) {
            var delete_url = $(this).closest("tr").attr("url-delete-payment");
            var form_delete = $('#form-delete');
            form_delete.attr('action', delete_url);
        });
    </script>
@endsection
