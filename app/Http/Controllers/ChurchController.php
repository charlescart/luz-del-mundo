<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\Province;
use App\City;
use App\Church;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\GetProvincesRequest;
use App\Http\Requests\GetCitiesRequest;
use App\Http\Requests\StoreChurchRequest;
use View;

class ChurchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:churches.index')->only(['index']);
        $this->middleware('permission:churches.create')->only(['create', 'store', 'getProvinces', 'getCities']);
        // $this->middleware('permission:assing-roles.edit')->only(['getRolesForAssingRole', 'assingRolesForUser']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* si no tiene una iglesia, redirecciono a churches.create */
        $hasChurch = User::whereHas('churches', function (Builder $query) {
            $query->where('member_clasification_id', 1);
        })
        ->where('users.id', Auth::user()->id)->doesntExist();

        if ($hasChurch) {
            return redirect()->route('churches.create');
        }
        /* fin de: si no tiene una iglesia, redirecciono a churches.create */

        $data = [
            'dropDown' => 'Church',
            'module' => 'Config. Church',
            'user' => User::with(['churches' => function ($query) {
                $query->where('member_clasification_id', 1);
            }, 'churches.city.province.country'])->where('users.id', Auth::user()->id)->first(),
            // 'btnChurch' => View::make('dashboard.church.partials.btn-action-church')->render(),
        ];

        return view('dashboard.church.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* si tiene almenos una iglesia como pastor, redirecciono a churches.index */
        $hasChurch = User::whereHas('churches', function (Builder $query) {
            $query->where('member_clasification_id', 1);
        })
        ->where('users.id', Auth::user()->id)->exists();

        if ($hasChurch) {
            return redirect()->route('churches.index');
        }
        /* fin de: si tiene almenos una iglesia como pastor, redirecciono a churches.index */

        $data = [
            'dropDown' => 'Church',
            'module' => 'Config. Church',
            'countries' => Country::orderBy('name')->get(),
            'provinces' => Province::where('country_id', 1)->orderBy('name')->get()
        ];

        return view('dashboard.church.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChurchRequest $request)
    {
        $church = New Church;
        if (!$request->has('custom_name')) {
            $nameOfTheCity = City::where('id', $request->city)->value('name');
            $request->name = 'Luz del Mundo '.$nameOfTheCity.' Misión '.$request->number_of_church;
            $church->custom_name_at = now(); // se verifica por que el nombre fue creado aca
        }

        $data = [
            'city_id' => $request->city,
            'name' => $request->name,
            'number_church' => $request->number_of_church,
            'shepherd' => $request->name_shepherd,
            'phone_contact' => $request->phone,
            'address' => $request->address,
        ];
        $church->fill($data);

        if ($church->save()) {
            $church->users()->attach(Auth::user()->id, ['member_clasification_id' => 1]);
            session()->flash('msg', 1);
            return response()->json(['success' => true, 'msg' => 1], 201);
        } else
            return response()->json(['success' => false, 'msg' => -1], 200);
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

    public function getProvinces(GetProvincesRequest $request)
    {
        $provinces = Province::select('id', 'name')->where('country_id', $request->country)->orderBy('name')->get();
        return response()->json(($provinces->count()) ? ['success' => true, 'msg' => 1, 'data' => $provinces] : ['success' => false, 'msg' => -1]);
    }

    public function getCities(GetCitiesRequest $request)
    {
        $cities = City::select('id', 'name')->where('province_id', $request->state)->orderBy('name')->get();
        return response()->json(($cities->count()) ? ['success' => true, 'msg' => 1, 'data' => $cities] : ['success' => false, 'msg' => -1]);
    }
}
