<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Request;

class BreederController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breeders = \App\breeder::where('userID', Auth::user()->id)->get();
        $id = Auth::user()->name;
        return view('breeder.index', compact('breeders', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->name;
     return view('breeder.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateBreederRequest $request)
    {

        $input = $request->all();
        $input['userID'] =Auth::user()->id;
        $input['username'] = Auth::user()->name;
        $input['created_at'] = Carbon::now();
        $input['updated_at'] = Carbon::now();
        \App\breeder::create($input);
        

        $breeders = \App\breeder::where('userID', Auth::user()->id)->get();
        $id = Auth::user()->name;
        return view('breeder.index', compact('breeders', 'id'));
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user = \App\User::where('name', $id)->firstOrFail();
        $isAdmin = Auth::user()->isAdmin;
        $breeders = \App\breeder::where('username', $id)->get();
        return view('breeder.show', compact('breeders', 'user', 'id', 'isAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($breeder, $id)
    {
        if (Auth::user()->isAdmin != 1){
            if (Auth::user()->name != $breeder){
              return redirect('home');
            }
        }
        $breeder = \App\Breeder::findOrFail($id);
        return view('breeder.edit', compact('breeder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CreateBreederRequest $request, $id)
    {
        $breeder = \App\Breeder::findOrFail($id);
        $breeder->update($request->all());
        if (Auth::user()->isAdmin == 1){
          return redirect('breeder/'. $breeder->username);
        }
        return redirect('breeder');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $breeder = \App\Breeder::findOrFail($id);
        $breeder->delete();
        if (Auth::user()->isAdmin == 1){
            return back();
        }
        return redirect('breeder');
    }

    public function createAdmin(Requests\CreateCreateAdminRequest $request)
    {
        $user = \App\User::where('name', $request->id)->firstOrFail();
        $user->isAdmin = 1;
        $user->save();
        return back();
    }
}
