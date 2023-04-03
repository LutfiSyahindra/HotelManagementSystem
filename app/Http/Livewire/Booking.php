<?php

namespace App\Http\Livewire;

use App\Models\Fasilitas;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Booking extends Component
{
    public $currentStep = 1;
    public $room_id, $fasilitas_id, $name, $nik, $ttl, $jk, $address, $no_telp, $check_in, $check_out;
    public $successMessage = '';

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'nik' => 'required',
            'ttl' => 'required',
            'jk' => 'required',
            'address' => 'required',
            'no_telp' => 'required',
            'check-in' => 'required',
            'check-out' => 'required',
        ]);
 
        $this->currentStep = 2;
    }
  
    public function secondStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'email' => 'required|unique:users,email',
        //     'phone' => 'required|numeric',
        // ]);
  
        $this->currentStep = 3;
    }
  
    public function submitForm()
    {
        Guest::create([
            'room_id' => $this->room_id,
            'fasilitas_id' => $this->fasilitas_id,
            'name' => $this->name,
            'nik' => $this->nik,
            'ttl' => $this->ttl,
            'jk' => $this->jk,
            'address' => $this->address,
            'no_telp' => $this->no_telp,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
        ]);
  
        $this->successMessage = 'You\'ve successfully registered';
  
        $this->clearForm();
  
        $this->currentStep = 1;
    }
  
    public function back($step)
    {
        $this->currentStep = $step;    
    }
  
    public function clearForm()
    {
        $this->room_id = '';
        $this->fasilitas_id = '';
        $this->name = '';
        $this->nik = '';
        $this->ttl = '';
        $this->jk = '';
        $this->address = '';
        $this->no_telp = '';
        $this->check_in = '';
        $this->check_out = '';
    }
    
    public function render($id)
    {
        $room = Room::where('id',$id)->first();
        $fasilitas = Fasilitas::where('status','Aktif')->get();
        return view('backend.receptionist.booking',compact('room','fasilitas'));
    }
}
