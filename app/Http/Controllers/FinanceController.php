<?php

namespace App\Http\Controllers;

use App\Finance;
use App\FinanceClassification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DataTables;
use View;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /*$this->middleware('permission:finances.index')->only(['index']);
        $this->middleware('permission:finances.create')->only(['create', 'store']);
        $this->middleware('permission:finances.show')->only(['show']);
        $this->middleware('permission:finances.edit')->only(['edit', 'update']);
        $this->middleware('permission:finances.destroy')->only('destroy');*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'dropDown' => 'Finances',
            'module' => 'Finances',
            'tithe' => $this->calculateTithe(Auth::user()),
            'capital' => 50,
            'debt' => 2.13,
        ];
        return view('dashboard.finances.index', $data);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Finance $finance
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Finance $finance
     * @return \Illuminate\Http\Response
     */
    public function edit(Finance $finance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Finance $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finance $finance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finance $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {
        //
    }

    /**
     * Obtiene lista  finanzas de usuario logeado.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getFinancesForUser(Request $request)
    {
        $finances = Finance::where('user_id', Auth::id())->with([
            'finance_classification:id,name,description,color,class',
            'currency:id,code,description'])
            ->orderBy('finances.id', 'desc')->get();
        $boton = View::make('dashboard.finances.partials.btn-action')->render();

        return DataTables::of($finances)
            /*->editColumn('tithe', function (Finance $finance) {
                if (strlen($role->name) > 40)
                    return substr($role->name, 0, 40).'...';
                else
                    return $role->name;
            })*/
            ->editColumn('amount', function (Finance $finance) {
                return $finance->amount . ' ' . $finance->currency->code;
            })
            ->editColumn('tithe', function (Finance $finance) {
                return ($finance->tithe == true) ? __('Yes') : __('Not');
            })
            ->editColumn('debt', function (Finance $finance) {
                return $finance->debt > 0 ? $finance->debt . ' ' . $finance->currency->code : '0 '.$finance->currency->code;
            })
            ->editColumn('created_at', function (Finance $finance) {
                return $finance->created_at->format('d, F Y');
//                return $finance->created_at->diffForHumans();
            })
            ->addColumn('type', function (Finance $finance) {
                return View::make('dashboard.finances.partials.type-badge', compact('finance'));
            })
            ->addColumn('action', $boton)
            ->setRowClass(function (Finance $finance) {
                return $finance->fifth_part == true ? 'text-bolds' : '';
            })
            ->rawColumns(['type', 'action', 'amount'])
            ->make(true);
    }

    private function calculateTithe($user)
    {
        list($tithe) = [[]];
        $currencies = Finance::select('currency_id')->with('currency:id,code,description')
            ->where('finances.user_id', $user->id)->groupBy('finances.currency_id')->get();
        if (!$currencies->count() > 0)
            return $tithe; // return vacio
        foreach ($currencies as $key => $currency) {
            /* Monto de todo el ingreso capital */
            $amountForCurrency = Finance::where([['user_id', $user->id], ['currency_id', $currency->currency_id], ['tithe', true]])
                ->get();

            foreach ($amountForCurrency as $finance) { /* Modificando para agregar la 5ta parte a quien corresponda */
                if ($finance->fifth_part == true)
                    $finance->amount = $finance->amount + ($finance->amount / 5); /* Monto + 5ta parte */
            }

            /* Monto de todo lo diezmado en la moneda en el ciclo foreach */
            $amountTitheForCurrency = Finance::where([['user_id', $user->id], ['currency_id', $currency->currency_id], ['finance_classification_id', 4]])
                ->sum('amount');

            $tithe[$key]['amount'] = round((($amountForCurrency->sum('amount') * 0.10) - $amountTitheForCurrency), 2);
            $tithe[$key]['color'] = ($tithe[$key]['amount'] > 0) ? 'text-danger' : 'text-success';
            $tithe[$key]['code'] = $currency->currency->code;
        }
        return $tithe;
    }
}
