<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $input = $request->all();
            $start = $input['start'] ?? '0';
            $length = $input['length'] ?? '5';
            $search = $input['search']['value'] ?? '';

            $columns = [
                '0' => 'stock_no',
                '1' => 'item_code',
                '2' => 'item_name',
                '3' => 'quantity',
                '4' => 'location',
                '5' => 'store_id',
                '6' => 'in_stock_date',
            ];

            $pageNumber = ($start / $length) + 1;
            $pageLength = $request->length;
            $skip = ($pageNumber - 1) * $pageLength;

            $orderColumnIndex = $columns[$input['order'][0]['column'] ?? '0'];

            $orderBy = $input['order'][0]['dir'] ?? 'desc';

            $query = DB::table('stocks')
                ->join('stores', 'stocks.store_id', '=', 'stores.id')  // Joining the stores table
                ->select('stocks.*', 'stores.name as store_name');

            // Apply search filter if it exists
            if (!empty($search)) {
                $query = $query->where('item_name', 'LIKE', '%' . $search . '%');
            }

            $recordsTotal = $query->count();

            $query = $query->orderBy($orderColumnIndex, $orderBy);

            $recordsFiltered = $query->count();

            $users = $query->skip($skip)->take($pageLength)->get();

            return response()->json([
                "draw" => $request->draw,
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFiltered,
                'data' => $users
            ], 200);
        }
        return view('stocks.index');
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'item_code' => 'required|integer',
            'item_name' => 'required',
            'quantity' => 'required',
            'location' => 'required',
            'store_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()  // Return the validation errors
            ], 422); // HTTP status code for Unprocessable Entity
        }

        try {
            $stocks = [
                'item_code' => $input['item_code'],
                'item_name' => $input['item_name'],
                'quantity' => $input['quantity'],
                'location' => $input['location'],
                'in_stock_date'  => now()->format('Y-m-d'),
                'store_id'  => $input['store_id'],
            ];

            Stock::insert($stocks);

            return $this->sendSuccess([], 'Stock stored successfully');
        } catch (\Exception $e) {
            Log::error("errorr ", [$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }

    public function display(Request $request)
    {
       $input = $request->all();
       $pageLength = $input['pageLength'] ?? 10;
       $search = $input['search'] ?? null;
       $orderColumn = $input['orderColumn'] ?? 'stock_no';
       $orderDirection = $input['orderBy'] ?? 'asc';

       $query = DB::table('stocks')
       ->join('stores', 'stocks.store_id', '=', 'stores.id')
       ->select('stocks.*', 'stores.name as store_name');

       // Apply search filter if search parameter is provided
       if (!empty($search)) {
           $query->where('item_name', 'LIKE', '%' . $search . '%')
                 ->orWhere('item_code', 'LIKE', '%' . $search . '%');
       }

       $totalRecords = $query->count();
       $query->orderBy($orderColumn, $orderDirection);

       $stocks = $query->skip($request->get('skip', 0))
                       ->take($pageLength)
                       ->get();

       return response()->json([
           'data' => $stocks,
           'total' => $totalRecords,
           'current_page' => $request->get('skip', 0) / $pageLength + 1,
           'last_page' => ceil($totalRecords / $pageLength),
           'per_page' => $pageLength,
       ]);

    }

    public function addMutipleStocks(Request $request)
    {
        $input = $request->all();
        try {
            Stock::insert($input['items']);
            return $this->sendSuccess([], "Stock inserted");
        } catch (\Exception $e) {
            return $this->sendError([$e->getMessage()]);
        }
    }
}
