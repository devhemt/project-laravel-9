<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    use WithFileUploads;
    public $job, $profile;
    public $photo, $fullname, $phone, $email;
    public $current_password, $new_password, $new_password_confirmation;

    public function changePasswordSave()
    {
        $this->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|min:8|string'
        ]);
        $auth = Auth::guard('user')->user();

        // The passwords matches
        if (!Hash::check($this->current_password, $auth->password))
        {
            $this->addError('psmatchs', 'Current Password is Invalid.');
        }

        // Current password and new password same
        if (strcmp($this->current_password, $this->new_password) == 0)
        {
            $this->addError('cpsamenp', 'New Password cannot be same as your current password.');
        }

        // Current password and new password confirmation
        if ($this->current_password != $this->new_password_confirmation)
        {
            $this->addError('confirm', 'The re-entered password does not match the new password.');
        }
        if ($this->current_password == $this->new_password_confirmation && Hash::check($this->current_password, $auth->password) && strcmp($this->current_password, $this->new_password) != 0){
            dd('asda');
            $user =  User::find($auth->user_id);
            $user->password =  Hash::make($this->new_password);
            $user->save();
            $this->addError('success', 'Password Changed Successfully.');
        }
    }

    public function profileChange()
    {
        $userid = Auth::guard('user')->user()->user_id;
        if($this->photo != null){
            $this->validate([
                'photo' => 'image|max:1024', // 1MB Max
            ]);
            $this->photo->storeAs('images', $this->photo->getClientOriginalName(),['disk' => 'my']);
            $affected = DB::table('user')
                ->where('user_id','=', $userid)
                ->update(['image' => $this->photo->getClientOriginalName()]);
        }
        if ($this->fullname != null){
            $this->validate([
                'fullname' => 'max:100',
            ]);

            $affected = DB::table('user')
                ->where('user_id','=', $userid)
                ->update(['name' => $this->fullname]);
        }
        if ($this->phone != null){
            $this->validate([
                'phone' => 'unique:user,phone',
            ]);

            $affected = DB::table('user')
                ->where('user_id','=', $userid)
                ->update(['phone' => $this->phone]);
        }
        if ($this->email != null){
            $this->validate([
                'email' => 'email|unique:user,email',
            ]);

            $affected = DB::table('user')
                ->where('user_id','=', $userid)
                ->update(['email' => $this->email]);
        }
        $this->emit('loadsmallnavadmin');
    }

    public function delProImage(){
        $userid = Auth::guard('user')->user()->user_id;
        $affected = DB::table('user')
            ->where('user_id','=', $userid)
            ->update(['image' => null]);
        $this->emit('loadsmallnavadmin');
    }

    public function render()
    {
        $userid = Auth::guard('user')->user()->user_id;
        $this->profile = DB::table('user')
            ->where('user_id', $userid)
            ->get();

        switch ($this->profile[0]->role){
            case "1":
                $this->job = "Director";
                break;
            case "2":
                $this->job = "Total Manager";
                break;
            case "3":
                $this->job = "Import Manager";
                break;
            case "4":
                $this->job = "Order Manager canceled";
                break;
            case "5":
                $this->job = "Order Manager noprocess";
                break;
            case "6":
                $this->job = "Order Manager confirmed";
                break;
            case "7":
                $this->job = "Order Manager packing";
                break;
            case "8":
                $this->job = "Order Manager success";
                break;
            case "9":
                $this->job = "Delivery Manager";
                break;
        }

        return view('livewire.admin.profile');
    }
}
