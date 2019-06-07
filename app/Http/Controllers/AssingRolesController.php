<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateAssingRoleRequest;
use App\Mail\AssignmentOfRoles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;
use View;
use Carbon\Carbon;

class AssingRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:assing-roles.index')->only(['index', 'getUsersForAssingRole']);
        $this->middleware('permission:assing-roles.edit')->only(['getRolesForAssingRole',
            'assingRolesForUser']);
//        $this->middleware('permission:assing-roles.show')->only(['show']);
//        $this->middleware('permission:assing-roles.edit')->only(['edit', 'update']);
//        $this->middleware('permission:assing-roles.destroy')->only('destroy');
        /*$this->middleware('permission:roles.assing-roles')->only(['assingARol', 'getUsersForAssingRole',
            'searchEmail', 'getRolesForAssingRole', 'assingRolesForUser']);*/
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
            'module' => 'assingRoles',
        ];
        return view('dashboard.assing-roles.index', $data);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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

    public function getUsersForAssingRole()
    {
        $users = User::select('id', 'name', 'email', 'created_at', 'email_verified_at')->orderBy('id', 'desc')->get();
        $boton = View::make('dashboard.assing-roles.partials.btn-action')->render();

        return DataTables::of($users)
            ->editColumn('name', function (User $user) {
                if (strlen($user->name) > 40)
                    return substr($user->name, 0, 40).'...';
                else
                    return $user->name;
            })
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->diffForHumans();
            })
            ->editColumn('email_verified_at', function (User $user) {
                return (!empty($user->email_verified_at)) ? $user->email_verified_at->diffForHumans() : null;
            })
            ->addColumn('action', $boton)
            ->make(true);
    }

    public function getRolesForAssingRole(Request $request) /*validar id de user con form request*/
    {
        $roles = Role::select('id', 'name')->orderBy('id', 'desc')->get();
        $user = User::where('id', $request->user_id)->first();

        return DataTables::of($roles)
            ->with('assigned_roles', function() use ($user) {
                return $user->getRoleNames();
            })
            ->make(true);
    }

    public function assingRolesForUser(ValidateAssingRoleRequest $request)
    {
        list($rolesToAssing, $roleNotFound) = [explode(',', $request->roles), false];

        foreach ($rolesToAssing as $key => $role) {
            $roleNotFound = (Role::where('name', $role)->doesntExist()) ? true : false;
        }

        if ($roleNotFound)
            return response()->json(['success' => false, 'msg' => -6]);

        $user = User::where('id', $request->user_id)->first();
        $user->syncRoles($rolesToAssing);
        try {
            if(count($rolesToAssing) > 0)
                Mail::to($user->email, $user->name)->send(new AssignmentOfRoles($user, $rolesToAssing));
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => -7], 200);
        }

        return response()->json(['success' => true, 'msg' => 1], 201);
            /*
            $guestUser = New GuestUser;
            $guestUser->fill($request->only('email'));
            $guestUser->roles = json_encode($rolesToAssing);
            if ($guestUser->save()) {
                // Enviar email
                return response()->json(['success' => true, 'msg' => 1], 201);
            }
            */
    }
}
