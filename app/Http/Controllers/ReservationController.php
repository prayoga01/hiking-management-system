<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Payment;
use App\Models\Mountain;
use App\Models\Reservation;
use App\Models\MountainAble;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rsv = Group::where('user_id',auth()->user()->id)->latest()->get();
        // $payments = Payment::whereIn('group_id', $rsv->id)->get();
        // foreach($rsv as $rs){
        //     $mtn[] = Mountain::where('id', $rs->mountain_id)->get();
        //     $mtn_able = MountainAble::where("mountain_id", $rs->mountain_id)->get();
        // };
        
            
        return view('user.transaction', [
            'reservation'=> $rsv,     
        ]);

       
        // return view('user.transaction');
        // return view('user.formbooking', [
        //     'reservations'=> Reservation::where('user_id',auth()->user()->id)->latest()->get(),
            
        // ]);
    }
    public function groupcreate($id)
    {

        $mountainable = MountainAble::find($id);
        return view('user.creategroup', [
            'datauser'=> User::find(auth()->user()->id),
            'mountainable'=>$mountainable
        ]);
    }

   

    
    public function storegroup($id_mtnable, Request $request)
    {
        $request->validate([
            'checkIn' => 'required',
            'checkOut' => 'required',
            'group_name' => 'required'
        ]);

        $mtnable = MountainAble::find($id_mtnable);
        $group = Group::create([
            'user_id' => auth()->user()->id,	
            'mountainAble_id' => $id_mtnable,	
            'mountain_id' => $mtnable->mountain_id,
            'group_name' => $request->group_name,
            'checkIn' => $request->checkIn,
            'checkOut' => $request->checkOut,
        ]);
        Alert::success('success', 'New post has been added!');
        // return redirect('/mountaindetails/'.$id_mtnable.'/group/'.$group->id.'/create');
        return redirect('/groups/'.$group->id.'/mountaindetail/'.$id_mtnable.'/create');
    
    }
  



    public function climb()
    {
        if (auth()->user()->is_admin == 2) {
            $mountainIds = Mountain::where('user_id', auth()->user()->id)->pluck('id')->toArray();
            $payments = Payment::whereIn('mountain_id', $mountainIds)->where('status_pay', 1)->get();
        } else {
            $groups = Group::all();
            $groupIds = $groups->pluck('id')->toArray();
            $payments = Payment::whereIn('group_id', $groupIds)->where('status_pay', 1)->get();
        }

        return view('admin.climberlist', compact('payments'));
    }

 


    


   



    public function showGroupMembers($groupId)
{
    $group = Reservation::where('group_id', $groupId)->get();
    return view('admin.membergroup', compact('group'));
}




    public function climedit($id)
    {
        $group = Group::findOrFail($id); // Mengambil data group berdasarkan ID
        return view('admin.updateclimberlist', compact('group'));
    }


    public function climupdate(Request $request, $id)
    {
        $group = Group::findOrFail($id); // Menemukan data group berdasarkan ID
        $group->status = $request->input('status');
        $group->finish = $request->input('finish');
        $group->save();// Menyimpan perubahan pada model

        Alert::success('success', 'New post has been added!');
        return redirect('/climbers');
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create($id_mtnable, $id_group)
    // {
    //     $mountainable = MountainAble::find($id_mtnable);
    //     $group = Group::find($id_group);
    //     return view('user.formbooking', [
    //         'mountainable'=>$mountainable,
    //         'group'=>$group,
    //     ]);
    // }

    public function create($id_group)
    {
       $group = Group::find($id_group);
       $mountainable = $group->mountainable;
       return view('user.formbooking', [
           'mountainable' => $mountainable,
           'group' => $group,
       ]);
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store($id_mtnable, $id_group, Request $request)
{
    $validatedData= $request->validate([
        'name' => 'required',
        'birth' => 'required',
        'address' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'no_tlp' => 'required',
        'nationality' => 'required',
        'idn_numb' => 'required',
        'idn_img' => 'required|mimes:jpg,png,jpeg|max:2048'
    ]);
    if ($request->file('idn_img')) {   
        $validatedData['idn_img'] = $request->file('idn_img')->store('post-images');
    }
    
    // dd($request->idn_img);
    $group = Group::findOrFail($id_group);

    Reservation::create([
        'group_id' => $id_group, 
        'name' => $request->name,
        'birth' => $request->birth,
        'age' => $request->age,
        'address' => $request->address,
        'gender' => $request->gender,
        'no_tlp' => $request->no_tlp,
        'nationality' => $request->nationality,
        'idn_numb' => $request->idn_numb,
        'idn_img' => $validatedData['idn_img'],
    ]);

    Alert::success('success', 'New post has been added!');
    // return redirect('/mountaindetails/'.$id_group.'/group/'.$id_mtnable.'');
    return redirect('/mountaindetails/'.$id_mtnable.'/group/'.$id_group.'');

}

     
    // public function store($id_mtnable, $id_group, Request $request)
    // {
      
    //     $validatedData= $request->validate([
    //         'name' => 'required',
    //         'birth' => 'required',
    //         'address' => 'required',
    //         'gender' => 'required',
    //         'no_tlp' => 'required',
    //         'nationality' => 'required',
    //         'idn_numb' => 'required',
    //         'idn_img' => 'required|mimes:jpg,png,jpeg|max:2048'
    //     ]);

        
    //     if ($request->file('idn_img')) {   
    //         $validatedData['idn_img'] = $request->file('idn_img')->store('post-images');
    //     }
        
    //     // dd($request->idn_img);
    //     Reservation::create([
    //         'group_id' => $id_group, 
    //         'name' => $request->name,
    //         'birth' => $request->birth,
    //         'address' => $request->address,
    //         'gender' => $request->gender,
    //         'no_tlp' => $request->no_tlp,
    //         'nationality' => $request->nationality,
    //         'idn_numb' => $request->idn_numb,
    //         'idn_img' => $validatedData['idn_img'],
    //     ]);
        
    //     Alert::success('success', 'New post has been added!');
    //     return redirect('/mountaindetails/'.$id_mtnable.'/group/'.$id_group.'');
    // }

    

    /**
     * Display the specified resource.
     */
    public function show($id_mtn, $id_group)
    {
        $group = Group::find($id_group);
        $mountainable = MountainAble::find($group->mountainAble_id);
        $reservation = Reservation::where('group_id', $id_group)->get();
        $mountain = Mountain::find($id_mtn);
        $payment = Payment::where('group_id', $id_group)->first();
        return view('user.showbooking', [
            'mountainable'=>$mountainable,
            'group'=>$group,
            'rsvs'=>$reservation,
            'mountain'=>$mountain,
            'payment'=>$payment
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy($id_mtnable, $id_group, Request $request)
    {
        
        $value = Reservation::find($request->id_rsv);
      
        Reservation::where('id', $value->id)->delete();
        Alert::success('success', 'Data has been removed!');
        return redirect('/mountaindetails/'.$id_mtnable.'/group/'.$id_group.'');
    }




    
    
   
    
  

}   