<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Fasilitas;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Visibility;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $room = Room::where('id', $id)->first();
        $fasilitas = Fasilitas::where('fasilitas', $id)->first();
        return view('backend.receptionist.booking', compact('room', 'fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'fasilitas_id' => 'required',
            'name' => 'required',
            'nik' => 'required',
            'ttl' => 'required',
            'jk' => 'required',
            'address' => 'required',
            'no_tlp' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'email' => 'required',
            'hargarr' => 'required',
            
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }


        $tgl1 = new DateTime($request->check_in);
        $tgl2 = new DateTime($request->check_out);
        $totgl = $tgl2->diff($tgl1);
        $tot = $totgl->days;
        // $tot = $totgl / 60 / 60 / 24;
        // dd($tot);

        $hitung = 0;
        foreach ($request->fasilitas_id as $key => $value) {
            $fasilitas[] = [
                'data' => Fasilitas::where('harga', $request->fasilitas_id[$key])->get(),
                'harga' => ($hitung += $value),
            ];
        }
        foreach ($fasilitas as $key) {
            $barang = $key['harga'];
        }

        $kmr = $request->hargarr;
        $kmrtot = $kmr * $tot;

        // get name room
        $name_room = Room::where('id', $request->room_id)->first();
        // dd($request->hargarr+$barang);

        $data_guest = [
            // 'id' => $request->input('id'),
            'room_id' => $request->room_id,
            'fasilitas_id' => $fasilitas,
            'name' => $request->name,
            'nik' => $request->nik,
            'ttl' => $request->ttl,
            'jk' => $request->jk,
            'address' => $request->address,
            'no_tlp' => $request->no_tlp,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'hargarr' => $request->hargarr,
            'name_room' => $name_room,
            'email' => $request->email,
            'total' => $kmrtot + $barang,
            'fasilitas' => $request->fasilitas,
        ];

        $request->session()->put('gus', $data_guest);
        // return redirect()->route('trans.transaksi')->with(['data'=>$data_guest]);
        return response()->json(['success' => 'User saved successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function transaksi()
    {
        return view('backend.receptionist.guest');
    }

    public function store(Request $request)
    {
        $input = request()
            ->session()
            ->get('gus');
        // insert booking
        $insert = Guest::create([
            'room_id' => $input['room_id'],
            'name' => $input['name'],
            'nik' => $input['nik'],
            'status' => $input['ttl'],
            'jk' => $input['jk'],
            'no_tlp' => $input['no_tlp'],
            'address' => $input['address'],
            'check_in' => $input['check_in'],
            'check_out' => $input['check_out'],
            'total' => $input['total'],

        ]);
        // insert detail
        // Insert Order Product
        $order_detail = [];
        foreach ($input['fasilitas_id'] as $item) {
            foreach ($item['data'] as $key) {
                $order_detail[] = [
                    'guests_id' => $insert->id,
                    'fasilitas_id' => $key['id'],
                ];
            };
        };
        // dd($order_detail);
        DetailTransaksi::insert($order_detail);


        // update status visibility
        Visibility::where('room_id', $input['room_id'])->update([
            'status' => 'booked'
        ]);

        return redirect()->route('visit.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest, $id)
    {
        $room = Room::where('id', $id)->first();
        $fasilitas = Fasilitas::where('status', 'Aktif')->get();
        return view('backend.receptionist.booking', compact('room', 'fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        //
    }
}
