<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletStoreRequest;
use App\Models\Exam;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Wallet_check_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(WalletStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            if(Exam::EXAM_TYPE_MCQ_QUIZ==$request->type){
                $fee=Exam::EXAM_TYPE_MCQ_QUIZ_FEE;
            }elseif(Exam::EXAM_TYPE_MODELTEST==$request->type){
                $fee=Exam::EXAM_TYPE_MODELTEST_FEE;
            }else{
                return response()->json(['message' =>'This exame type is not available'],404);
            }

            if($fee>Auth::user()->wallet_balance){
                return response()->json(['message' =>'Not enough funds available'],404);
            }

            // Auth::user()->update([
            //     'wallet_balance' =>(Auth::user()->wallet_balance-$fee),
            // ]);


            Invoice::create([]);
            DB::commit();
            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
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
}
