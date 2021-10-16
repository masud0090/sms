<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
   public function showUser($id=null){
       if($id==''){
           $users=User::get();
           return response()->json(['users'=>$users],400);

       }else{
        $user=User::find($id);
        return response()->json(['users'=>$users],200);
       }
   }

   public function addUser(Request $request){
       if($request->ismethod('post')){
           $data=$request->all();
           //return $data; 

           $rulse=[
               'users.*.name'=>'required',
               'users.*.email'=>' required|email|unique:users',
               'users.*.password'=>'required',

           ];

           $custommsg=[
               'users.*.name.required'=>'Name is Required',
               'users.*.email.required'=>'email is Required',
               'users.*.password.required'=>'password is Required',
               
           ];
           $validator=Validator::make($data,$rulse,$custommsg);
           if($validator->fails()){

            return response()->json($validator->errors(),422);
           }



           $user=new User();
           $user->name=$data['name'];
           $user->email=$data['email'];
           $user->password=$data['password'];
           $user->save();
           $message="User Created Succesfully";
           return response()->json(['message'=>$message],200);
       }

   }




//post api for multiple user
   public function addMultipleUser(Request $request){
    if($request->ismethod('post')){
        $data=$request->all();
        //return $data; 

        $rulse=[
            'users.*.name'=>'required',
            'users.*.email'=>' required|email|unique:users',
            'users.*.password'=>'required',

        ];

        $custommsg=[
            'users.*.name.required'=>'Name is Required',
            'users.*.email.required'=>'email is Required',
            'users.*.email.email'=>'email must be a valid Email',
            'users.*.password.required'=>'password is Required',
            
        ];
        $validator=Validator::make($data,$rulse,$custommsg);
        if($validator->fails()){

         return response()->json($validator->errors(),422);
        }



        foreach($data['users'] as $adduser){

           $user=new User();
           $user->name=$adduser['name'];
           $user->email=$adduser['email'];
           $user->password=$adduser['password'];
           $user->save();
           $message="User Created Succesfully";

        }
        return response()->json(['message'=>$message],201);
    }

}



//For Update
public function UpdateUserDetails(Request $request,$id){
    if($request->ismethod('put')){
        $data=$request->all();
        //return $data; 

        $rulse=[
            'users.*.name'=>'required',
            
            'users.*.password'=>'required',

        ];

        $custommsg=[
            'users.*.name.required'=>'Name is Required',
            
            'users.*.password.required'=>'password is Required',
            
        ];
        $validator=Validator::make($data,$rulse,$custommsg);
        if($validator->fails()){

         return response()->json($validator->errors(),422);
        }



        $user= User::findOrFail($id);
        $user->name=$data['name'];
       
        $user->password=$data['password'];
        $user->save();
        $message="User  Succesfully Updated";
        return response()->json(['message'=>$message],202);
    }

}




//For Delete single
public function DeleteUser($id=null){
    
         User::findOrFail($id)->delete();
        
        $message="User  Succesfully Deleted";
        return response()->json(['message'=>$message],200);
    }




//For Delete Multiple
public function DeleteMultipleUser ($ids){

    $ids=explode(',',$ids);
    
    User::whereIn ('id',$ids)->delete();
   
   $message="User  Succesfully Deleted";
   return response()->json(['message'=>$message],200);
}



   
}
