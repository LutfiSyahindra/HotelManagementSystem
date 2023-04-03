<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $fasilitas = Fasilitas::latest()->get();
            return DataTables::of($fasilitas)
                ->addIndexColumn()
                ->addColumn('fasilitas', function ($fasilitas) {
                    return strtoupper($fasilitas->fasilitas);
                })
                ->addColumn('ket', function ($fasilitas) {
                    return ucfirst($fasilitas->ket);
                })
                // ->addColumn('img', function ($fasilitas) {
                //     return ucfirst($fasilitas->img);
                // })
                ->addColumn('harga', function ($fasilitas) {
                    return 'Rp. ' . number_format($fasilitas->harga);
                })
                ->addColumn('img', function ($fasilitas) {
                    $url = asset('backend/assets/images/room/' . $fasilitas->img);
                    if ($fasilitas->img == null) {
                    } else {
                        return '<img src="' . $url . '"/>';
                    }
                })
                ->addColumn('status', function ($fasilitas) {
                    if ($fasilitas->status == 'aktif') {
                        return '<div class="btn btn-primary">' . ucfirst($fasilitas->status) . '</div>';
                    } else {
                        return '<div class="btn btn-danger">' . ucfirst($fasilitas->status) . '</div>';
                    }
                })
                ->addColumn('action', function ($fasilitas) {
                    if ($fasilitas->status == 'aktif') {
                        $button = '<i class="fa fa-times"></i>';
                        $class = 'danger';
                        $title = 'Arsip';
                    } else {
                        $title = 'Aktifkan';
                        $class = 'warning';
                        $button = '<i class="fa fa-undo"></i>';
                    }

                    $btn = '<button id="edit-fasilitas" data-id="' . $fasilitas->id . '" title="Edit" class="btn btn-primary edit-fasilitas" style="margin-right:5px" ><i class="fa fa-pencil"></i></button>';

                    $btn = $btn. '<button id="detail-fasilitas" data-id="' . $fasilitas->id . '" title="Show" class="btn btn-success detail-fasilitas"><i class="fa fa-eye"></i></button>';

                    $btn = $btn . ' <button id="delete-fasilitas" data-id="' . $fasilitas->id . '" class="btn btn-' . $class . ' btn-md" title="' . $title . '">' . $button . '</button>';

                    return $btn;
                })
                ->rawColumns(['img','status', 'action'])
                ->make(true);
        }

        return view('backend.masterData.fasilitas');
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
        //define validation rules
        $validator = Validator::make($request->all(), [
            'fasilitas' => 'required',
            'ket' => 'required',
            'harga' => 'required',
            // 'img_pelatih' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        // return response()->json($request->all());

        if ($image = $request->file('img')) {

            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('backend/assets/images/room/', $fileName, 'public');
            $fasilitas = $request->input('fasilitas');
            $ket = $request->input('ket');
            $harga = $request->input('harga');

            // Store Data or Update Data
            $user = Fasilitas::updateOrCreate([
                'id' => $request->input('id'),
            ], [
                'fasilitas' => $fasilitas,
                'ket' => $ket,
                'harga' => $harga,
                'img' => $fileName
            ]);
        } else {

            $fasilitas = $request->input('fasilitas');
            $ket = $request->input('ket');
            $harga = $request->input('harga');

            // Store Data or Update Data
            $fasilitas = Fasilitas::updateOrCreate([
                'id' => $request->input('id'),
            ], [
                'fasilitas' => $fasilitas,
                'ket' => $ket,
                'harga' => $harga,
            ]);
            return response()->json(['success' => 'Fasilitas saved successfully.']);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fasilitas $fasilitas)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fasilitas = Fasilitas::find($id);

        return response()->json($fasilitas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fasilitas $fasilitas, $id)
    {
        $fasilitas = Fasilitas::find($id);
        if ($fasilitas->status == 'Non-Aktif') {
            Fasilitas::where('id', $id)->update([
                'status' => 'aktif',
            ]);
            return response()->json(['status' => 'Berhasil Menampilkan Data!']);
        } else {
            $fasilitas->update([
                'status' => 'Non-Aktif',
            ]);
            return response()->json(['status' => 'Berhasil Mengarsipkan Data!']);
        }
    }
}
