<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Visibility;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VisibilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $visit = Visibility::where('status','Available')->get();
            return DataTables::of($visit)
                ->addIndexColumn()
                ->addColumn('room', function ($visit) {
                    return strtoupper($visit->Room->room);
                })
                ->addColumn('harga', function ($visit) {
                    return 'Rp.' . number_format($visit->Room->harga);
                })
                ->addColumn('status', function ($visit) {
                    return ucfirst($visit->status);
                })
                ->addColumn('status', function ($visit) {
                    if ($visit->status == 'Available') {
                        return '<div class="btn btn-success">' . ucfirst($visit->status) . '</div>';
                    } else {
                        return '<div class="btn btn-danger">' . ucfirst($visit->status) . '</div>';
                    }
                })
                ->addColumn('action', function ($visit) {
                    $btn = ' <a href="booking/'.$visit->room_id.'" id="booking-visit" data-id="' . $visit->id . '" class="btn btn-primary btn-md" title="Booking"><i class=" fa fa-id-card-o "></i></a>';

                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        
        // $visit = Visibility::all();
        // return view('backend.receptionist.visibility',compact('visit'));

        $room = Room::all();
        return view('backend.receptionist.visibility',compact('room'));
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
    public function show(Visibility $visibility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visibility $visibility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visibility $visibility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visibility $visibility)
    {
        //
    }
}
