<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\DestroyRoleRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;
use View;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:roles.index')->only(['index', 'getUsersWithRoles']);
        $this->middleware('permission:roles.create')->only(['create', 'store']);
        $this->middleware('permission:roles.show')->only(['show', 'getPermissionsOfARol']);
        $this->middleware('permission:roles.edit')->only(['edit', 'update']);
        $this->middleware('permission:roles.destroy')->only('destroy');
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
            'module' => 'Roles',
        ];
        return view('dashboard.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'dropDown' => 'Configuration',
            'module' => 'Roles',
            'role' => New Role(),
        ];

        return view('dashboard.roles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $role = New Role;
        $role->fill($request->only('name', 'guard_name'));
        if ($role->save())
            return response()->json(['success' => true, 'msg' => 1], 201);
        else
            return response()->json(['success' => false, 'msg' => -1], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $data = [
            'dropDown' => 'Configuration',
            'module' => 'Roles',
            'role' => $role,
        ];

        return view('dashboard.roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, DestroyRoleRequest $request)
    {
        try {
            $result = Role::where($request->only('id'));
            $result = $result->delete();
            if ($result) {
                session()->flash('msg', 1);
                return response()->json(['success' => true, 'msg' => 1]);
            } else
                return response()->json(['success' => false, 'msg' => -1]);
//            return response()->json(($result) ? ['success' => true, 'msg' => 1] : ['success' => false, 'msg' => -1]);
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
 * Obtiene lista de usuarios con roles.
 *
 * @param  \Illuminate\Http\Request $request
 * @return \Illuminate\Http\Response
 */
    public function getUsersWithRoles(Request $request)
    {
        $roles = Role::orderBy('id','desc')->get();
        $boton = View::make('dashboard.roles.partials.btn-action')->render();

        return DataTables::of($roles)
            ->editColumn('name', function (Role $role) {
                if (strlen($role->name) > 40)
                    return substr($role->name, 0, 40).'...';
                else
                    return $role->name;
            })
            ->editColumn('created_at', function (Role $role) {
                return $role->created_at->diffForHumans();
            })
            ->addColumn('action', $boton)
            ->make(true);
    }

    /**
     * Obtiene lista de permisos de un rol.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getPermissionsOfARol(Request $request)
    {
        $rol = Role::find($request->id);
        $permissions = $rol->permissions;

        return DataTables::of($permissions)
            ->editColumn('name', function (Permission $permissions) {
                if (strlen($permissions->name) > 40)
                    return substr($permissions->name, 0, 40).'...';
                else
                    return $permissions->name;
            })
            ->editColumn('created_at', function (Permission $permissions) {
                return $permissions->created_at->diffForHumans();
            })
            ->make(true);
    }
}
