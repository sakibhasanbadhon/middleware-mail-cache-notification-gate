<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth','email_verify'])->except('index');
    // }


    public function index()
    {
        return view('home');
    }



    public function profile()
    {
        $students = Student::get_brand();
        return view('profile',['student'=>$students]);

    }


    public function upload(Request $request)
    {
        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete('images/'.auth()->user()->avatar);
            $file_name = $request->avatar->getClientOriginalName();
            $request->avatar->storeAs('images', $file_name, 'public');
        }

        auth()->user()->update([
            'avatar'=>$file_name
        ]);

        return back();

    }



    public function up($id)
    {
        //return $id;

        $notify = DB::table('notifications')->where('id', $id)->delete();

        return back();
    }






}
