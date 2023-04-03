<?php

namespace App\Http\Controllers;

use App\Models\DaftarTamu;
use App\Models\Guest;
use App\Models\Room;
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
            $tamu = Guest::all();
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
                    return ucfirst($tamu->status);
                })
                ->addColumn('action', function ($tamu) {
                    $btn = ' <a href="booking/' . $tamu->room_id . '" id="booking-visit" data-id="' . $tamu->id . '" class="btn btn-primary btn-md" title="Booking"><i class=" fa fa-id-card-o "></i></a>';

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
    public function edit(DaftarTamu $daftarTamu)
    {
        //
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
    public function destroy(DaftarTamu $daftarTamu)
    {
        //
    }
}
