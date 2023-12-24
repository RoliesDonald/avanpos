<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.index');
    }

    public function data()
    {
        $supplier = Supplier::orderBy('id_supplier', 'desc')->get();

        return datatables()
            ->of($supplier)
            ->addIndexColumn()
            ->addColumn('select_all', function ($supplier) {
                return '<input type="checkbox" name="id_supplier[]" value="' . $supplier->id_supplier . '">';
            })

            ->addColumn('kode_supplier', function ($supplier) {
                return '<span class="label label-success" style="font-size:14px;":>' . $supplier->kode_supplier . '</span> ';
            })
            ->addColumn('action', function ($supplier) {
                return '
                <div class="btn-group">
                <button type="button" class="btn btn-xs btn-success" onclick="editdata(`' .
                    route('supplier.update', $supplier->id_supplier) .
                    '`)"><i class="fa fa-pencil"></i></button>
                <button type="button" class="btn btn-xs btn-danger" onclick="deleteData(`' .
                    route('supplier.destroy', $supplier->id_supplier) .
                    '`)"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'select_all', 'kode_supplier', 'nama'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $supplier = Supplier::latest()->first() ?? new Supplier();
        $request['kode_supplier'] = 'AV' . tambah_nol_didepan((int) $supplier->id_supplier + 1, 6);

        $supplier = Supplier::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {

        $supplier = Supplier::find($id);
        $supplier->update($request->all());

        return response()->json('Data berhasil di simpan', 200);
    }
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return response(null, 204);
    }
}
