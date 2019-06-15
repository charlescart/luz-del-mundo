<?php

namespace App\Http\Controllers;

use App\GuestUser;
use App\Http\Requests\StoreGuestUser;
use App\Http\Requests\StoreGuestUserRequest;
use App\Mail\InviteUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use View;
use DataTables;

class GuestUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:guest-user.index')->only(['index', 'getGuestUsers']);
        $this->middleware('permission:guest-user.create')->only(['create','store','getRolesForGuestUser']);
        $this->middleware('permission:guest-user.edit')->only(['update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'dropDown' => 'Configuration',
            'module' => 'guestUser',
        ];
        return view('dashboard.guest-user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuestUserRequest $request)
    {
        list($rolesToAssing, $roleNotFound) = [explode(',', $request->roles), false];

        foreach ($rolesToAssing as $key => $role) {
            $roleNotFound = (Role::where('name', $role)->doesntExist()) ? true : false;
        }

        if ($roleNotFound)
            return response()->json(['success' => false, 'msg' => -6]);

        if (GuestUser::where('email', $request->email)->exists())
            return response()->json(['success' => false, 'msg' => -9]);

        $guestUser = new GuestUser;
        $guestUser->fill([
            'name' => ucwords(strtolower($request->name)),
            'email' => $request->email,
            'roles' => json_encode($rolesToAssing),
        ]);

        try {
            if ($guestUser->save() && $request->send_email == true) {
                Mail::to($guestUser->email, $guestUser->name)->send(new InviteUser($guestUser, Auth::user()));
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => -7], 200);
        }

        return response()->json(['success' => true, 'msg' => 1], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGuestUserRequest $request, GuestUser $guestUser)
    {
        list($rolesToAssing, $roleNotFound) = [explode(',', $request->roles), false];

        foreach ($rolesToAssing as $key => $role) {
            $roleNotFound = (Role::where('name', $role)->doesntExist()) ? true : false;
        }

        if ($roleNotFound)
            return response()->json(['success' => false, 'msg' => -6]);
        $data = [
            'roles' => json_encode($rolesToAssing),
            'email' => $request->email,
            'name' => ucwords(strtolower($request->name))
        ];

        $guestUser->fill($data);
        try {
            if ($guestUser->save() && $request->send_email == true) {
                Mail::to($request->email, ucwords(strtolower($request->name)))->send(new InviteUser((object) $data, Auth::user()));
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => -7], 200);
        }

        return response()->json(['success' => true, 'msg' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getGuestUsers()
    {
        $users = GuestUser::orderBy('id', 'desc')->get();
        $boton = View::make('dashboard.guest-user.partials.btn-action')->render();

        return DataTables::of($users)
            ->addColumn('roles_list', function (GuestUser $user) {
                $html = '<ul class="mb-0 pl-3">';
                foreach (json_decode($user->roles) as $role) {
                    $html.='<li>'.$role.'</li>';
                }
                return $html.='</ul>';
            })
            ->editColumn('roles', function (GuestUser $user) {
                return json_decode($user->roles);
            })
            ->addColumn('action', $boton)
            ->rawColumns(['roles_list', 'action'])
            ->make(true);
    }

    public function getRolesForGuestUser(Request $request)
    {
        $roles = Role::select('id', 'name')->orderBy('id', 'desc')->get();
        return DataTables::of($roles)->make(true);
    }
}
