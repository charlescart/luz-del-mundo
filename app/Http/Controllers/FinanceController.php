<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Finance;
use App\FinanceClassification;
use App\Http\Requests\CreateFinanceRequest;
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
            'funds' => $this->getFunds(),
            'finance_classifications' => FinanceClassification::all('id', 'name', 'fund'),
            'currencies' => Currency::all('id', 'code')
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
    public function store(CreateFinanceRequest $request)
    {
        // ahora a validar si el fondo del que se debitará el registro realmente es un fund (1)
        if($request->debit_to != 0) {

           $finance_classification = FinanceClassification::find($request->debit_to);
           if($finance_classification) {
               if(!$finance_classification->fund)
                    return response()->json(['success' => true, 'msg' => -5], 200);
           } else
                return response()->json(['success' => false, 'msg' => -5], 200);
        }

        $finance = New Finance;
        $finance->fill($request->only('debt', 'amount', 'description', 'tithe'));
        $finance->user_id = Auth::user()->id;
        $finance->finance_classification_id = $request->finance_classification;
        $finance->currency_id = $request->currency;
        $finance->debit_to = $request->debit_to;
        $finance->fifth_part = $request->fifth_part;

        if ($finance->save())
            return response()->json(['success' => true, 'msg' => 1], 201);
        else
            return response()->json(['success' => false, 'msg' => -1], 200);

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
        if ($finance->delete()) {
            return response()->json(['success' => true, 'msg' => 1]);
        } else
            return response()->json(['success' => false, 'msg' => -1]);
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
            /*->editColumn('description', function (Finance $finance) {
                $length = 95;
                if (strlen($finance->description) > $length)
                    return substr($finance->description, 0, $length).'...';
                else
                    return $finance->description;
            })*/
            ->editColumn('amount', function (Finance $finance) {
                return number_format($finance->amount, 2, ',', '.'). ' ' . $finance->currency->code;
            })
            ->editColumn('tithe', function (Finance $finance) {
                return ($finance->tithe == true) ? __('Yes') : __('Not');
            })
            ->editColumn('debt', function (Finance $finance) {
                return $finance->debt > 0 ? number_format($finance->debt, 2, ',', '.'). ' ' . $finance->currency->code : '0 '.$finance->currency->code;
            })
            ->editColumn('created_at', function (Finance $finance) {
                return $finance->created_at->format('d, F Y');
                /*return $finance->created_at->diffForHumans();*/
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

            $tithe[$key]['amount'] = number_format(round((($amountForCurrency->sum('amount') * 0.10) - $amountTitheForCurrency), 2), 2, ',', '.');
            $tithe[$key]['color'] = ($tithe[$key]['amount'] > 0) ? 'Debit' : 'Solvent';
            $tithe[$key]['code'] = $currency->currency->code;
        }
        return $tithe;
    }

    private function getFunds()
    {
        list($funds) = [[]];
        $fundsEnable = FinanceClassification::select('id', 'name')->where('fund', true)->get();

        if (!$fundsEnable->count() > 0)
            return $funds; // Return vacio

        foreach ($fundsEnable as $keyFund => $fund) { /* Fondos contables */

            /* Monedas por fondo contable y usuario */
            $currencies = Finance::select('currency_id')->with('currency:id,code,description')
                ->where([['user_id', Auth::user()->id], ['finance_classification_id', $fund->id]])
                ->groupBy('currency_id')->get();

            foreach ($currencies as $keyCurrency => $currency) {
                $have = Finance::where([['currency_id', $currency->currency_id], ['user_id', Auth::user()->id],
                    ['finance_classification_id', $fund->id], ['debit_to', 0]])->sum('amount');

                $debit = Finance::where([['currency_id', $currency->currency_id], ['user_id', Auth::user()->id],
                    ['debit_to', $fund->id]])->sum('amount');

                $funds[$fund->name][$keyCurrency]['have'] = number_format($have, 2, ',', '.');
                $funds[$fund->name][$keyCurrency]['debit'] = number_format($debit, 2, ',', '.');
                $funds[$fund->name][$keyCurrency]['capital'] = number_format(($have - $debit), 2, ',', '.');
                $funds[$fund->name][$keyCurrency]['currency'] = $currency->currency->code;
            }
        }
        return $funds;
    }
}
