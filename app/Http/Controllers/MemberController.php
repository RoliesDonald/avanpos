<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.index');
    }

    public function data()
    {
        $member = Member::orderBy('kode_member')->get();

        return datatables()
            ->of($member)
            ->addIndexColumn()
            ->addColumn('select_all', function ($member) {
                return '<input type="checkbox" name="id_member[]" value="' . $member->id_member . '">';
            })
            /* ->addColumn('select_all', function ($produk) {
                return '<input type="checkbox" name="id_produk[]" value="' . $produk->id_produk . '">';
            }) */
            ->addColumn('kode_member', function ($member) {
                return '<span class="label label-success">' . $member->kode_member . '</span>';
            })
            ->addColumn('action', function ($member) {
                return '
                <div class="btn-group">
                <button class="btn btn-xs btn-success" onclick="editdata(`' .
                    route('member.update', $member->id_member) .
                    '`)"><i class="fa fa-pencil"></i></button>
                <button class="btn btn-xs btn-danger" onclick="deleteData(`' .
                    route('member.destroy', $member->id_member) .
                    '`)"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'select_all', 'kode_member'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // untuk ambil data member yg terakhir
        $member = Member::latest()->first();
        $kode_member = (int)$member->kode_member + 1 ?? 1; //supaya gak null saat data pertamakali dimasukkan

        // untuk member baru
        $member = new Member();
        $member->kode_member = tambah_nol_didepan($kode_member, 5);
        $member->nama = $request->nama;
        $member->telepon = $request->telepon;
        $member->alamat = $request->alamat;
        $member->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return response()->json($member);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $member = Member::find($id)->update($request->all());
        return response()->json('Data berhasil di update', 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return response(null, 204);
    }

    public function cetakMember(Request $request)
    {
        $cetakIdCardMember = collect(array());
        foreach ($request->id_member as $id) {
            $member = Member::find($id);
            $cetakIdCardMember[] = $member;
        }

        $cetakIdCardMember = $cetakIdCardMember->chunk(1);

        $no = 1;
        $pdf = PDF::loadView('member.cetak', compact('cetakIdCardMember', 'no'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('member.pdf');
    }
}
