<?php

namespace App\Http\Controllers;

use App\Models\DaftarTamu;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Visibility;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DaftarTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tamu = Guest::latest()->get();
            return DataTables::of($tamu)
                ->addIndexColumn()
                ->addColumn('kamar', function ($tamu) {
                    return strtoupper($tamu->room_id);
                })
                ->addColumn('Nama Tamu', function ($tamu) {
                    return strtoupper($tamu->name);
                })
                ->addColumn('NIK', function ($tamu) {
                    return strtoupper($tamu->nik);
                })
                ->addColumn('Jenis Kelamin', function ($tamu) {
                    return strtoupper($tamu->jk);
                })
                ->addColumn('No-Telp', function ($tamu) {
                    return strtoupper($tamu->no_tlp);
                })
                ->addColumn('Check-in', function ($tamu) {
                    return strtoupper($tamu->check_in);
                })
                ->addColumn('Check-out', function ($tamu) {
                    return strtoupper($tamu->check_out);
                })
                ->addColumn('harga', function ($tamu) {
                    return 'Rp.' . number_format($tamu->total);
                })
                ->addColumn('status', function ($tamu) {
                    if ($tamu->status == 'Reservasi') {
                        return '<span class="btn btn-success">' . ucfirst($tamu->status) . '</span>';
                    } elseif ($tamu->status == 'Check-in') {
                        return '<span class="btn btn-primary">' . ucfirst($tamu->status) . '</div>';
                    } elseif ($tamu->status == 'Check-out') {
                        return '<span class="btn btn-danger">' . ucfirst($tamu->status) . '</div>';
                    }
                })
                ->addColumn('action', function ($tamu) {
                    if ($tamu->status == 'Reservasi') {
                        $button = '<i class="fa fa-sign-in" aria-hidden="true"></i>';
                        $class = 'primary';
                        $title = 'Check-in';
                    } else {
                        $title = 'Aktifkan';
                        $class = 'warning';
                        $button = '<i class="fa fa-undo"></i>';
                    }
                    $btn = '<button id="edit-tamu" data-id="' . $tamu->id . '" title="Edit" class="btn btn-primary edit-tamu" style="margin-right:5px" ><i class="fa fa-pencil"></i></button>';

                    $btn = $btn . '<button id="detail-tamu" data-id="' . $tamu->id . '" title="Show" class="btn btn-success detail-tamu"><i class="fa fa-eye"></i></button>';

                    $btn = $btn . ' <button id="delete-tamu" data-id="' . $tamu->room_id . '" class="btn btn-' . $class . ' btn-md" title="' . $title . '">' . $button . '</button>';

                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        // $visit = Visibility::all();
        // return view('backend.receptionist.visibility',compact('visit'));

        // $room = Room::all();
        return view('backend.receptionist.daftartamu');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarTamu $daftarTamu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $daftarTamu = DaftarTamu::find($id);

        return response()->json($daftarTamu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarTamu $daftarTamu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $daftarTamu = Guest::where('room_id',$id)->first();
        if ($daftarTamu->status == 'Reservasi') {
            Guest::where('room_id', $id)->update([
                'status' => 'Check-in',
            ]);
            return response()->json(['status' => 'Berhasil Check-in']);
        } else {
            Guest::where('room_id', $id)->update([
                'status' => 'Check-out',
            ]);
            Visibility::where('room_id', $id)->update([
                'status' => 'Available',
            ]);
            return response()->json(['status' => 'Berhasil Check-out']);
        }
    }
}
