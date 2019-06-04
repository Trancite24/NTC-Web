<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdatePassController extends Controller
{
    //
    public function getUpdatePasswordForm()
    {
        return view('auth.passwords.update_pass');
    }

    public function updatePassword(Request $request)
    {
     $this->validator($request->all())->validate();
        $encryptPassword = Auth::user()->password;
        $enteredPassword = $request->old_password;
        if(Hash::check($enteredPassword,$encryptPassword)){
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->getUpdatePasswordForm()->with('success',"Successfully updated");

        }
        else{
            return $this->getUpdatePasswordForm()->with('error',"Password Missmatch");
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'old_password'=> ['required','string','min:8'],
        ]);
    }
}
