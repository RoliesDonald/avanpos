@extends('layouts.master') @section('title')
    Daftar Supplier
@endsection
@section('breadcrumb')
    @parent
    <li class="active">Daftar Supplier</li>
    @endsection @section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-toolbar">
                        <button onclick="addForm('{{ route('supplier.store') }}')" class="btn btn-success">
                            <i class="fa fa-plus-circle"></i> Tambah Supplier
                        </button>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <form action="" method="post" class="form-member">
                        @csrf
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th width="5%">
                                    <input type="checkbox" name="select_all" id="select_all" />
                                </th>
                                <th width="5%">No</th>
                                <th width="10%">Kode</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @includeIf('supplier.form')
    @endsection @push('scripts')
    <script>
        let table;
        $(function() {
            table = $(".table").DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('supplier.data') }}",
                },
                columns: [{
                        data: "select_all",
                        searchable: false,
                        sortable: false,
                    },
                    {
                        data: "DT_RowIndex",
                        searchable: false,
                        sortable: false,
                    },
                    {
                        data: "kode_supplier",
                    },
                    {
                        data: "nama",
                    },
                    {
                        data: "telepon",
                    },
                    {
                        data: "alamat",
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
            $("[name=select_all]").on("click", function() {
                $(":checkbox").prop("checked", this.checked);
            });
        });

        function addForm(url) {
            $("#modal-form").modal("show");
            $("#modal-form .modal-title").text("Tambah Supplier");

            $("#modal-form form")[0].reset();
            $("#modal-form form").attr("action", url);
            $("#modal-form [name=_method]").val("post");
            $("#modal-form [name=nama]").focus();
        }

        function editdata(url) {
            $("#modal-form").modal("show");
            $("#modal-form .modal-title").text("Edit Supplier");

            $("#modal-form form")[0].reset();
            $("#modal-form form").attr("action", url);
            $("#modal-form [name=_method]").val("put");
            $("#modal-form [name=nama]").focus();

            $.get(url)
                .done((response) => {
                    $("#modal-form [name=nama]").val(response.nama);
                    $("#modal-form [name=telepon]").val(response.telepon);
                    $("#modal-form [name=alamat]").val(response.alamat);
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
