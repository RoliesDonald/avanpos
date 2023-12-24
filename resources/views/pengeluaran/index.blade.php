@extends('layouts.master') @section('title')
    Daftar Pengeluaran
@endsection
@section('breadcrumb')
    @parent
    <li class="active">Daftar Pengeluaran</li>
    @endsection @section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-toolbar">
                        <button onclick="addForm('{{ route('pengeluaran.store') }}')" class="btn btn-success">
                            <i class="fa fa-plus-circle"></i> Tambah
                        </button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-pengeluaran">
                        @csrf
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th width="5%">No</th>
                                <th width="10%">No. Surat</th>
                                <th width="20%">Tanggal</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th width="10%"><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @includeIf('pengeluaran.form')
    @endsection @push('scripts')
    <script>
        let table;
        $(function() {
            table = $(".table").DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('pengeluaran.data') }}",
                },
                columns: [{
                        data: "DT_RowIndex",
                        searchable: false,
                        sortable: false,

                    },
                    {
                        data: "no_pengeluaran",
                    },
                    {
                        data: "created_at",
                    },
                    {
                        data: "nominal",
                    },
                    {
                        data: "deskripsi",
                    },
                    {
                        data: "action",
                        searchable: false,
                        sortable: false,

                    },
                ],
            });
            $("#modal-form")
                .validator()
                .on("submit", function(e) {
                    if (!e.preventDefault()) {
                        $.post(
                                $("#modal-form form").attr("action"),
                                $("#modal-form form").serialize()
                            )
                            .done((response) => {
                                $("#modal-form").modal("hide");
                                table.ajax.reload();
                            })
                            .fail((error) => {
                                alert("tidak dapat menyimpan data cuy");
                                return;
                            });
                    }
                });

        });

        function addForm(url) {
            $("#modal-form").modal("show");
            $("#modal-form .modal-title").text("Pengeluaran Baru");

            $("#modal-form form")[0].reset();
            $("#modal-form form").attr("action", url);
            $("#modal-form [name=_method]").val("post");
            $("#modal-form [name=nama]").focus();
        }

        function editdata(url) {
            $("#modal-form").modal("show");
            $("#modal-form .modal-title").text("Edit");

            $("#modal-form form")[0].reset();
            $("#modal-form form").attr("action", url);
            $("#modal-form [name=_method]").val("put");
            $("#modal-form [name=nama]").focus();

            $.get(url)
                .done((response) => {
                    $("#modal-form [name=nominal]").val(response.nominal);
                    $("#modal-form [name=deskripsi]").val(response.deskripsi);
                })
                .fail((errors) => {
                    alart("tidak dapat menampilkan data");
                    return;
                });
        }

        function deleteData(url) {
            if (confirm("Yakin mau di hapus?, coba cek")) {
                $.post(url, {
                        _token: $("[name = csrf-token]").attr("content"),
                        _method: "delete",
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert("tidak dapat menghapus data");
                        return;
                    });
            }
        }
    </script>
@endpush
