<?php

namespace App\Http\Controllers;

use App\Http\Requests\McqQuestionRequest;
use App\Http\Requests\McqQuestionUpdateRequest;
use App\Http\Resources\ChapterResource;
use App\Http\Resources\McqQuestionResource;
use App\Models\McqOption;
use App\Models\McqQuestion;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class McqQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cache::rememberForever('mcq_questions', function () {
            $mcq_questions = McqQuestion::with('chapter', 'options')->get();
            return McqQuestionResource::collection($mcq_questions);
       });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(McqQuestionRequest $request)
    {
        try {
            DB::beginTransaction();
            $mcq_question = McqQuestion::create($request->safe()->all());
            foreach($request->options as $option) {
                McqOption::create(["option"=> $option,"mcq_question_id" =>$mcq_question->id]);
            }
            Cache::forget('mcq_questions');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(McqQuestionUpdateRequest $request, McqQuestion $mcq_question)
    {
        try {
            DB::beginTransaction();
            $mcq_question->update($request->safe()->all());
            $mcq_question->options()->delete();
            foreach($request->options as $option)
            {
                McqOption::create(["option"=> $option,"mcq_question_id" =>$mcq_question->id]);
            }
            Cache::forget('mcq_questions');
            DB::commit();
            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(McqQuestion $mcq_question)
    {
        $this->authorize('Delete Mcq_Question');
        try {
            DB::beginTransaction();
            $mcq_question->options()->delete();
            $mcq_question->delete();
            Cache::forget('mcq_questions');
            DB::commit();
            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
