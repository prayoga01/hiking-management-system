<?php

namespace App\Http\Controllers;

use App\Models\Regulation;
use App\Http\Requests\StoreRegulationRequest;
use App\Http\Requests\UpdateRegulationRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class RegulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $regulations = Regulation::all();
        // return view('admin.listregulation', compact('regulations'));
        return view('admin.listregulation',[
            'regulations'=>Regulation::all(),
            'regulations'=>  Regulation::search(request(key:'search'))->paginate(7)
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createregulation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegulationRequest $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'content' => 'required',
            'image'=> 'mimes:jpg|max:2048'
        ]);
    
       
        if ($request->file('image')) {   
            $validatedData['image']= $request->file('image')->store('post-images');
        }
        
        
        Regulation::create($validatedData);
        Alert::success('success', 'New data has been added!');
        return redirect('/regulations');
    }

    /**
     * Display the specified resource.
     */
    public function show(Regulation $regulation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regulation $regulation)
    {
        return view('admin.editregulation',[
            'regulation'=> $regulation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegulationRequest $request, Regulation $regulation)
    {
        $rules = [
            'title' => 'required',
            'type' => 'required',
            'content' => 'required',
            'image'=> 'mimes:jpg|max:2048'
           
        ];

        $validatedData =$request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['image']= $request->file('image')->store('post-images');
        }

       
        Regulation::where('id', $regulation->id)
                    ->update($validatedData);
                    Alert::success('success', 'Your work has been saved!');
                    return redirect('/regulations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regulation $regulation)
    {
        if ($regulation->image) {
            Storage::delete($regulation->image);
        }
        Regulation::destroy($regulation->id);
        Alert::success('success', 'Data has been Removed!');
        return redirect('/regulations');
    }
}