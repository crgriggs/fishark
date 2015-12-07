<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth\Auth;
use Request;
use DB;
use Storage;
use File;

class SpeciesController extends Controller
{

      public function __construct(){
        $this->middleware('auth', ['only'=> ['create', 'edit']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $species = \App\Species::all();

    return view('species.index', compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('species.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateSpeciesRequest $request)
    {
        //must validate before species is created in DB

        \App\Species::create($request->all());
        \App\Species::reindex();
        return redirect('species');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $photoPath = public_path().DIRECTORY_SEPARATOR.'speciesResources'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.'photos';
        $notesPath = public_path().DIRECTORY_SEPARATOR.'speciesResources'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.'notes';
        $notes = null;
        $photos = null;
        if (File::exists($photoPath))
            {
               $photos = File::files($photoPath);
            }
        if (File::exists($notesPath))
            {
                $notes = File::files($notesPath);
            }   
        
        $species  = \App\Species::findOrFail($id);
        $breeders = \App\breeder::where('speciesID', $id)->get();
        $numFish  = DB::table('breeders')
                ->where('speciesID', $id)
                ->sum('numFish');


        return view ('species.show', compact('species', 'breeders', 'numFish', 'photos', 'notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $species = \App\Species::findOrFail($id);
        return view('species.edit', compact('species'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CreateSpeciesRequest $request, $id)
    {
        $species = \App\Species::findOrFail($id);
        $species->update($request->all());
        return redirect('species');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $species = \App\Species::findOrFail($id);
        $species->delete();

        return redirect('species');
    
    }

    /**
     * Show the form for adding a new photo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imageAdd($id)
    {
        return view('species/addPhoto', compact('id'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imageStore(Requests\CreatePhotoRequest $request)
    {
        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        if (!File::exists('speciesResources/' . $request->id . '/photos'))
        {
           Storage::makeDirectory('photos');
        }    

        $file->move('speciesResources/' . $request->id . '/photos', $name);

        return 'Done';
        
    }

      /**
     * Show the form for adding a new notes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notesAdd($id)
    {
        return view('species/addNotes', compact('id'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notesStore(Requests\CreateNotesRequest $request)
    {
        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        if (!File::exists('speciesResources/' . $request->id . '/notes'))
        {
           Storage::makeDirectory('notes');
        }    

        $file->move('speciesResources/' . $request->id . '/notes', $name);

        return 'Done';
        
    }

    public function destroyResource(Requests\CreateDestroyResourceRequest $request)
    {
        File::delete(str_replace("/var/lib/openshift/561d4c89da16db1109000455/app-root/runtime/repo/public/", "", $request->path));
        return back();
    }
}
