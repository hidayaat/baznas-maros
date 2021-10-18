<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    private $perPage = 15;

    public function __construct()
    {
        $this->middleware('permission:user_show',['only' => 'index']);
        $this->middleware('permission:user_create',['only' => ['create', 'store']]);
        $this->middleware('permission:user_update',['only' => ['edit', 'update']]);
        $this->middleware('permission:user_detail',['only' => 'show']);
        $this->middleware('permission:user_delete',['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = [];
        if ($request->get('keyword')) {
            $users = User::search($request->keyword)->paginate($this->perPage);
        } else {
            $users = User::paginate($this->perPage);
        }

        return view('users.index', [
            'users' => $users->appends(['keyword' => $request->keyword])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //proses validasi data role
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30|unique:roles,name',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole($request->role);
            Alert::success('Tambah User', 'Berhasil');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Tambah User', 'Terjadi kesalahan saat mengedit role' . $th->getMessage());
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roleSelected' => $user->roles->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $user->syncRoles($request->role);
            Alert::success('Edit User', 'Berhasil');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Edit User', 'Terjadi kesalahan saat mengedit user' . $th->getMessage());
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->removeRole($user->roles->first());
            $user->delete();
            Alert::success('Hapus User', 'Berhasil');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Hapus User', 'Terjadi kesalahan saat menghapus user' . $th->getMessage());
        } finally {
            DB::commit();
            return redirect()->back();
        }
    }
}
