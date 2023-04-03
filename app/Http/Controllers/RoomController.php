<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Visibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Stringable;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        

        if ($request->ajax()) {
            $room = Room::latest()->get();
            return DataTables::of($room)
                ->addIndexColumn()
                ->addColumn('room', function ($room) {
                    return strtoupper($room->room);
                })
                ->addColumn('deskripsi', function ($room) {
                    return ucfirst($room->deskripsi);
                })
                ->addColumn('harga', function ($room) {
                    return 'Rp.' . number_format($room->harga);
                })
                ->addColumn('img', function ($room) {
                    $url = asset('backend/assets/images/room/' . $room->img);
                    if ($room->img == null) {
                    } else {
                        return '<img src="' . $url . '"/>';
                    }
                })
                ->addColumn('status', function ($room) {
                    if ($room->status == 'aktif') {
                        return '<div class="btn btn-primary">' . ucfirst($room->status) . '</div>';
                    } else {
                        return '<div class="btn btn-danger">' . ucfirst($room->status) . '</div>';
                    }
                })
                ->addColumn('action', function ($room) {
                    if ($room->status == 'aktif') {
                        $button = '<i class="fa fa-times"></i>';
                        $class = 'danger';
                        $title = 'Arsip';
                    } else {
                        $title = 'Aktifkan';
                        $class = 'warning';
                        $button = '<i class="fa fa-undo"></i>';
                    }

                    $btn = '<button id="edit-room" data-id="' . $room->id . '" title="Edit" class="btn btn-primary edit-room" style="margin-right:5px" ><i class="fa fa-pencil"></i></button>';

                    $btn = $btn . '<button id="show-room" data-id="' . $room->id . '" title="Show" class="btn btn-success show-room"><i class="fa fa-eye"></i></button>';

                    $btn = $btn . ' <button id="delete-room" data-id="' . $room->id . '" class="btn btn-' . $class . ' btn-md" title="' . $title . '">' . $button . '</button>';

                    return $btn;
                })
                ->rawColumns(['img', 'status', 'action'])
                ->make(true);
        }

        return view('backend.masterData.kamar');
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
            'room' => 'required',
            'deskripsi' => 'required',
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
            $room = $request->input('room');
            $deskripsi = $request->input('deskripsi');
            $harga = $request->input('harga');

            // Store Data or Update Data
          $room = Room::updateOrCreate(
                [
                    'id' => $request->input('id'),
                ],
                [
                    'room' => $room,
                    'deskripsi' => $deskripsi,
                    'harga' => $harga,
                    'img' => $fileName,
                ],
            );

            Visibility::create([
                'room_id' => $room->id,
            ]);
        } else {
            $room = $request->input('room');
            $deskripsi = $request->input('deskripsi');
            $harga = $request->input('harga');

            // Store Data or Update Data
            $room = Room::updateOrCreate(
                [
                    'id' => $request->input('id'),
                ],
                [
                    'room' => $room,
                    'deskripsi' => $deskripsi,
                    'harga' => $harga,
                ],
            );
        }
        return response()->json(['success' => 'Room saved successfully.']);
    }
    // {

    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $room = Room::find($id);

        return response()->json($room);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $room = Room::find($id);

        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);
        if ($room->status == 'Non-Aktif') {
            Room::where('id', $id)->update([
                'status' => 'aktif',
            ]);
            Visibility::where('room_id', $id)->update([
                'status' => 'Available',
            ]);
            return response()->json(['status' => 'Berhasil Menampilkan Data!']);
        } else {
            $room->update([
                'status' => 'Non-Aktif',
            ]);
            Visibility::where('room_id', $id)->update([
                'status' => 'Not-Available',
            ]);
            return response()->json(['status' => 'Berhasil Mengarsipkan Data!']);
        }
    }
}
