<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class postController extends Controller
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
        //$fname = $request->input('fname');
        //$lname = $request->input('lname');
        //$data = $fname . " " . $lname;
        ////
        //return $data;
 //           return Response::json($request::all());
 

        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $data = $fname . " " . $lname;
        ////
        return $data;
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
    
    
    public function test(Request $request){
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $data[0] = array(
            'fname' => $fname,
            'lname' => $lname
        );
        $data[1] = array(
            'fname' => 'Nan',
            'lname' => 'ABFJ'
        );
        
        if($request->ajax()){
            //response()->view('test', ['users' => $data]);
            //return response()->json([
            //        'fname' => $fname,
            //        'lname' => $lname
            //    ]);
            return response()->json($data);
        }
        //return response()
        //        ->view('test', ['users' => $data]);
        //        ->json(array(
                //   'fname' => $fname,
                //   'lname' => $lname
                //   ));
    
    }
}
