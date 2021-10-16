<?php

namespace App\Http\Controllers;

use App\Models\Phonebook;
use Illuminate\Http\Request;


class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phonebooks = Phonebook::get();

        $data = [
            'phonebooks' => $phonebooks
        ];

        return response()->json($data);
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
        // dd($request->all());
            $data=$request->all();




           $phonebook=new Phonebook();
           $phonebook->name=$data['name'];
           $phonebook->number=$data['number'];
           $phonebook->save();
           $message="Phone Number added Succesfully";
           $data = [
               'message' => $message
           ];

           return response()->json(['message'=>$message],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phonebook = Phonebook::find($id);

        $data = [
            'phonebook' => $phonebook
        ];

        return response()->json($data);


        // if($id==''){
        //     $Phonebooks=Phonebook::get();
        //     return response()->json(['Phonebooks'=>$Phonebooks],400);

        // }else{
        //  $phonebook=Phonebook::find($id);
        //  //return response(['status' => 'okkk']);
        //  return response()->json(['phonebook'=>$phonebook],200);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phonebook = Phonebook::find($id);
        $data = [
            'phonebook' => $phonebook
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->all();



           $phonebook=Phonebook::findOrFail($id);
           $phonebook->name=$data['name'];
           $phonebook->number=$data['number'];
           $phonebook->save();
           $message="Phone Number Updated Succesfully";
            $data = [
                'message' => $message
                ];
           return response()->json(['message'=>$message],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $phonebooks = Phonebook::findOrFail($id)->delete();

       $data = [
        'phonebooks' => $phonebooks
    ];
        $message="Phonenumber  Succesfully Deleted";
        return response()->json($data);
    }
}
