<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        return view('pengeluaran.index');
    }
    public function data()
    {
        $pengeluaran = Pengeluaran::orderBy('id_pengeluaran', 'desc')->get();

        return datatables()

            ->of($pengeluaran)
            ->addIndexColumn()
            ->addColumn('created_at', function ($pengeluaran) {
                return tanggal_indonesia($pengeluaran->created_at);
            })
            ->addColumn('select_all', function ($pengeluaran) {
                return '<input type="checkbox" name="pengeluaran[]" value="' . $pengeluaran->id_pengeluaran . '">';
            })
            ->addColumn('nominal', function ($pengeluaran) {
                return format_rupiah($pengeluaran->nominal, true);
            })
            ->addColumn('no_pengeluaran', function ($pengeluaran) {
                return '<span class="label label-success" style="font-size:14px;":>' . $pengeluaran->no_pengeluaran . '</span> ';
            })
            ->addColumn('action', function ($pengeluaran) {
                return '
                <div class="btn-group">
                <button type="button" class="btn btn-xs btn-success" onclick="editdata(`' .
                    route('pengeluaran.update', $pengeluaran->id_pengeluaran) .
                    '`)"><i class="fa fa-pencil"></i></button>
                <button type="button" class="btn btn-xs btn-danger" onclick="deleteData(`' .
                    route('pengeluaran.destroy', $pengeluaran->id_pengeluaran) .
                    '`)"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'select_all', 'no_pengeluaran', 'nominal'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $pengeluaran = Pengeluaran::latest()->first() ?? new Pengeluaran();
        $request['no_pengeluaran'] = 'AVEXPEN' . tambah_nol_didepan((int) $pengeluaran->id_pengeluaran + 1, 10);

        $pengeluaran = Pengeluaran::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function show(string $id)
    {
        $pengeluaran = Pengeluaran::find($id);
        return response()->json($pengeluaran);
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {

        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->update($request->all());

        return response()->json('Data berhasil di simpan', 200);
    }
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();

        return response(null, 204);
    }
}
