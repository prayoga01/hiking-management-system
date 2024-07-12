<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Payment;
use App\Models\Mountain;
use App\Models\Reservation;
use App\Models\MountainAble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $filtr = Payment::latest()->filter(request(['search','user']))->Tgl(request(['tgl_awal', 'tgl_akhir']));
    //     return view('admin.listpayment',[
    //         // 'payments'=> Payment::all()
    //         'payments'=> $filtr->paginate(7)   
    //     ]);
    // }
    public function index()
    {
        if (auth()->user()->is_admin == 2) {
            $payments = Payment::where('status_pay', '>=', 0)
                ->whereHas('mountain', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->latest()
                ->filter(request(['search', 'user']))
                ->Tgl(request(['tgl_awal', 'tgl_akhir']))
                ->paginate(7);
        } else {
            $payments = Payment::where('status_pay', '>=', 0)
                ->latest()
                ->filter(request(['search', 'user']))
                ->Tgl(request(['tgl_awal', 'tgl_akhir']))
                ->paginate(7);
        }
    
        return view('admin.listpayment', compact('payments'));
    }
    



    /**
     * Show the form for creating a new resource.
     */
    public function create($id_mtn, $id_group)
    {
        $user = User::find(auth()->user()->id);
        $mountain = Mountain::find($id_mtn);
        $group = Group::find($id_group);
        $mountainable = MountainAble::find($group->mountainAble_id);
        $reservation = Reservation::where('group_id', $id_group)->get();
        return view('user.payment', [
            'mountain'=>$mountain,
            'mountainable'=>$mountainable,
            'group'=>$group,
            'user'=>$user,
            'rsvs'=>$reservation
        ]);
      

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id_mtn, $id_group, Request $request)
    {
        $validatedData= $request->validate([
            'pay_date' => 'required',
            'ref_id' => 'required',
            'total' => 'required',
            'note' => 'required',
            'proof_pay' => 'required|mimes:jpg,png,pdf,jpeg|max:2048'
        ]);

        if ($request->file('proof_pay')) {   
            $validatedData['proof_pay'] = $request->file('proof_pay')->store('post-images');
        }

        // dd($request->all());
        Payment::create([
            'group_id' => $id_group, 
            'user_id' => Auth::user()->id, 
            'mountain_id' => $id_mtn, 
            'pay_date' => $request->pay_date,
            'ref_id' => $request->ref_id,
            'total' => $request->total,
            'note' => $request->note,
            'proof_pay' => $validatedData['proof_pay'],
        ]);
        Alert::success('success', 'New data has been added!');
        return redirect('/reservations');
    }

    /**
     * Display the specified resource.
     */
    
    // public function show(Payment $payment)
    // {
        
        
    // }

    // public function show($id_mtn, $id_group)
    // {
    //     $user = Auth::user();
    //     $payment = Payment::findOrFail($user->id);
    //     // $groups = Group::where('id', $payment->group_id);
    //     $reservations = Reservation::where('group_id', $payment->group_id);
    //     return view('user.invoice',[
    //         'user' => $user,
    //         'payment' => $payment,
    //         'reservations' => $reservations, 
    //     ]);
        
    // }

    public function show($id_mtn, $id_group)
    {
        $user = Auth::user();
        $group = Group::find($id_group);
        $mountainable = MountainAble::find($group->mountainAble_id);
        $reservations = Reservation::where('group_id', $id_group)->get();
        $mountain = Mountain::find($id_mtn);
        $payments = Payment::where('group_id', $id_group)->get();
        return view('user.invoice', [
            'mountainable'=>$mountainable,
            'group'=>$group,
            'reservations'=>$reservations,
            'mountain'=>$mountain,  
            'users'=>$user,  
            'payments' => $payments,
            
              
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($payment)
    {
        $value = Payment::find($payment);
        return view('admin.detailpayment',[
            'payment'=>$value
            
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, $payment)
    {
        $rules = [
            'status_pay'=> 'required'
        ];


        $validatedData =$request->validate($rules);
    
        $value = Payment::find($payment);

        $group = Group::find($value->group_id);
        $reservation = count(Reservation::where("group_id", $value->group_id)->get());
        $mountainAble = MountainAble::find($group->mountainAble_id);

        $people = (int)$mountainAble->max_people - $reservation;
    
        
        $mountainAble->update(['max_people' => $people]);
    
        Payment::where('id', $value->id)
                ->update($validatedData);

        Alert::success('success', 'Your data has been saved!');
        return redirect('/payments');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}