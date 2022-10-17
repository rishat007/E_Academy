<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletStoreRequest;
use App\Models\Exam;
use App\Models\Invoice;
use App\Models\UserCardInfo;
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

            if (Exam::EXAM_TYPE_MCQ_QUIZ == $request->exam_type) {
                $fee = Exam::EXAM_TYPE_MCQ_QUIZ_FEE;
            } elseif (Exam::EXAM_TYPE_MODELTEST == $request->exam_type) {
                $fee = Exam::EXAM_TYPE_MODELTEST_FEE;
            } else {
                return response()->json(['message' => 'This exame type is not available'], 404);
            }

            // $card = UserCardInfo::query()->where('card_number', $request->card_number)->first();

            // valdated for user card_number
            $card = Auth::user()->my_card->where('card_number', $request->card_number)->first();
            if (!$card) {
                return response()->json(['message' => 'This card number is not valid'], 404);
            }

            if ($card->pin_no != $request->pin_no) {
                return response()->json(['message' => 'Pin number does not match'], 404);
            }

            if ($card->balance < $fee) {
                return response()->json(['message' => 'Sorry! insufficient balance'], 404);
            }

            $balance=$card->balance;

            $card->update([
                'balance' => ($balance-$fee), // new balance added to the card wallet;
            ]);


            Invoice::create([
                'exam_type'=>$request->exam_type,
                'exam_fee'=>$fee,
                'paid'=>$fee,
                'discount'=>$request->discount??0,
                'chapter_id'=>$request->chapter,
                'previous_balance'=>$balance,
            ]);

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
