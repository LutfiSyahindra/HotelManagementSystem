<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::latest()->get();
            // $user = User::with('roles')->get();
            $role = Role::all();
            return DataTables::of($user, $role)
                ->addIndexColumn()
                ->addColumn('name', function ($user) {
                    return strtoupper($user->name);
                })
                ->addColumn('email', function ($user) {
                    return ucfirst($user->email);
                })
                ->addColumn('role', function ($user) {
                    foreach ($user->getRoleNames() as $item) {
                        return ucfirst($item);
                    }
                    // $user->getRoleNames()->pluck('name','id')->implode(',');
                })
                ->addColumn('status', function ($user) {
                    if ($user->status == 'aktif') {
                        return '<div class="btn btn-primary">' . ucfirst($user->status) . '</div>';
                    } else {
                        return '<div class="btn btn-danger">' . ucfirst($user->status) . '</div>';
                    }
                })
                ->addColumn('action', function ($user) {
                    if ($user->status == 'aktif') {
                        $button = '<i class="fa fa-times"></i>';
                        $class = 'Danger';
                        $title = 'Arsip';
                    } else {
                        $title = 'Aktifkan';
                        $class = 'success';
                        $button = '<i class="fa fa-undo"></i>';
                    }

                    $btn = '<button id="edit-user" data-id="' . $user->id . '" title="Edit" class="btn btn-primary edit-user"><i class="fa fa-pencil"></i></button>';

                    $btn = $btn . ' <button id="delete-user" data-id="' . $user->id . '" class="btn btn-' . $class . ' btn-md" title="' . $title . '">' . $button . '</button>';

                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        $user = User::all();

        $roles = Role::all();
        return view('backend.masterData.karyawan', compact('roles', 'user'));

        // $user = User::all();
        // // $role = Role::all();
        // return response()->json($user);
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
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $user = User::updateOrCreate(
            [
                'id' => $request->id,
            ],

            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ],
        );
        $user = User::find($request->id);

        DB::table('model_has_roles')
            ->where('model_id', $request->id)
            ->delete();

        $user->assignRole($request->input('role'));
        return response()->json(['success' => 'User saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $karyawan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $user->roles = User::find($user->id)->getRoleNames();
        // $user->roles = User::find($id)->getRoleNames();

        // $userRole = $user->roles->pluck('name', 'name')->all();

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $karyawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->status == 'Non-Aktif') {
            User::where('id', $id)->update([
                'status' => 'aktif',
            ]);
            return response()->json(['status' => 'Berhasil Menampilkan Data!']);
        } else {
            $user->update([
                'status' => 'Non-Aktif',
            ]);
            return response()->json(['status' => 'Berhasil Mengarsipkan Data!']);
        }
    }
}
