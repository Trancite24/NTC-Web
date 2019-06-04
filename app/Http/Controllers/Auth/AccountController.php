<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function viewUserForm()
    {

        $active_users = User::where('state','active')->get();
        $inactive_users = User::where('state','inactive')->get();
        return view('auth.viewUser')->with('active_users',$active_users)->with('inactive_users',$inactive_users);
    }

    public function activateUser(Request $request)
    {
        $auth_user_type = Auth::user()->type;
        if ($auth_user_type != 'super_adm' && $auth_user_type != 'uom_adm' && $auth_user_type != 'ntc_adm'){
            return view('error404');
        }
        $user = User::find($request->route('inactive_user_id'));
        if ($user == null ){
            return view('error404');
        }
        else{
            if ($auth_user_type =='super_adm'){
                $user->state = 'active';
                $user->save();
                return $this->viewUserForm()->with('activated_user', $user);
            }
            elseif ($user->type == 'ntc_adm' && $auth_user_type== 'uom_adm'){
                $user->state = 'active';
                $user->save();
                return $this->viewUserForm()->with('activated_user', $user);
            }
            else{
                return $this->viewUserForm()->with('failed_user', $user);

            }
        }
    }
    public function suspendUser(Request $request)
    {
        $auth_user_type = Auth::user()->type;
        if ($auth_user_type != 'super_adm' && $auth_user_type != 'uom_adm' && $auth_user_type != 'ntc_adm'){
            return view('error404');
        }

        $user = User::find($request->route('active_user_id'));
        if ($user == null ){
            return view('error404');
        }
        else{
            if ($auth_user_type =='super_adm'){
                $user->state = 'inactive';
                $user->save();
                return $this->viewUserForm()->with('activated_user', $user);
            }
            elseif ($user->type == 'ntc_adm' && $auth_user_type== 'uom_adm'){
                $user->state = 'inactive';
                $user->save();
                return $this->viewUserForm()->with('suspended_user', $user);
            }
            else{
                return $this->viewUserForm()->with('failed_user', $user);

            }
        }
    }
}
