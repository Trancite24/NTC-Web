<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UpdateAccountController extends Controller
{
    //

    public function getUpdateAccountForm()
    {
        return view('auth.update_account');
    }

    public function updateAccount(Request $request){

        $this->validator($request->all())->validate();
        $this->update($request->all());

        return $this->getUpdateAccountForm()->with('success', "Account Successfully Updated");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'profile_picture'=>['nullable','image'],
        ]);
    }

    protected function update(array $data)
    {
        $user =  User::find(Auth::user()->id);
        $user->name = $data['name'];
        if (isset($data['profile_picture'])) {
            $user->addMediaFromRequest('profile_picture')->toMediaCollection('profile_pictures');
        }
        $user->save();

        return $user;
    }
}
