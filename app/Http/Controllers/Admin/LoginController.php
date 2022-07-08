<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\AdminForgotPasswordJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\MailUserForgotPassword;

class LoginController extends Controller
{
    public const StatusUserDisable = 0;
    public const StatusUserEnable = 1;

    public function index() {
        if(!empty(Auth::user())) {
            return redirect()->route('admin.home');
        }
        return view('admin.login.login');
    }

    public function loginPost(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = $request->all();
        $email = $data['email'];
        $password = $data['password'];
        $remember = isset($data['remember']) ?? false;
        $user = User::where('email', $email)->first();

        if(empty($user)) {
            Session::flash('error','Your email or password is incorrect. Please try enter!');
            return redirect()->route(('admin.login'));
        }

        if ($user->count == 1) {
            Session::flash('warningLoginFail','Bạn chỉ được thử tối đa 5 lần.');
        }
        if ($user->count == 5) {
            Session::flash('warningLoginFail','Bạn đã thử quá 5 lần. Vui lòng liên hệ admin để hỗ trợ');
            return redirect()->route('admin.login');
        }

        if(Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            if(Auth::user()->status == LoginController::StatusUserDisable) {
                Session::flash('error','your account is disable');
                return redirect()->route(('admin.login'));
            }

            Auth::user()->update([
                'count' => 0,
            ]);
            return redirect()->route('admin.home');
        } else {
            Session::flash('error','Your email or password is incorrect. Please try enter!');
            User::where('email', $email)->update([
                'count' => DB::raw('count+1'),
            ]);
            return redirect()->route(('admin.login'));
        }
    }

    public function forgotPassword() {
        return view('admin.login.forgotPasswordAdmin');
    }

    public function forgotPasswordPost(Request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);

        $data = $request->all();

        $user = User::where('email', $data['email'])->first();
        if(empty($user)) {
            Session::flash('error','Your login email is incorrect. Please try enter!');
            return redirect(route('admin.forgotPassword'));
        }

        $url = route('admin.login');
        $newPassword = Str::random(8);
//        Mail::to($data['email'])->send(new MailUserForgotPassword($user->email, $newPassword, $url));

        $forgotPasswordMail = new MailUserForgotPassword($user->email, $newPassword, $url);
        $queueForgotPasswordMail = new AdminForgotPasswordJob($user->email, $forgotPasswordMail);
        dispatch($queueForgotPasswordMail);

        $user->update([
            'password' => Hash::make($newPassword)
        ]);

        Session::flash('success','Email sent. Please check your email to receive new password');
        return view('admin.login.forgotPasswordAdmin');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
