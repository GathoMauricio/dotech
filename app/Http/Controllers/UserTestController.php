<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SectionOneUserTest;
use App\SectionTwoUserTest;
use App\SectionThreeUserTest;

class UserTestController extends Controller
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
    public function store(Request $request)
    {
        $sectionOne = SectionOneUserTest::create([
            'user_id' => $request->user_id,
            'evaluation' => number_format($request->evaluation,1)
        ]);
        for($i = 1; $i <= 30; $i++){
            $sectionOne['question_'.$i] = $request->resp_one[$i - 1]['respuesta'];
        }
        $sectionOne->save();

        $sectionTwo = SectionTwoUserTest::create([
            'user_id' => $request->user_id,
        ]);
        for($i = 1; $i <= 19; $i++){
            $sectionTwo['question_'.$i] = $request->resp_two[$i - 1]['respuesta'];
        }
        $sectionTwo->save();

        $sectionThree = SectionThreeUserTest::create([
            'user_id' => $request->user_id,
        ]);
        for($i = 1; $i <= 18; $i++){
            $sectionThree['question_'.$i] = $request->resp_two[$i - 1]['respuesta'];
        }
        $sectionThree->save();



        return "Section 1:".$sectionOne."Section 2:".$sectionTwo."Section 3:".$sectionThree;
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
