<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Jobs\WorkerVerifyMailJob;
use App\Mail\WorkerVerifyMail;
use App\Models\Area;
use App\Models\Worker;
use App\Notifications\VerifyPhoneWorker;
use Illuminate\Http\Request;
use App\Http\Requests\WorkerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function register() {
        return view('client.pages.worker.register-page');
    }

    public function registerWithPhone(Area $area) {
        $area = $area->area();
        return view('client.pages.worker.create-worker-profile', compact('area'));
    }

    public function registerWithPhonePost(WorkerRequest $request, \Nexmo\Client $nexmo) {
        $data = $request->all();
        $token = rand(100000, 999999);

        if(Str::length($data['phone']) == 10) {
            if($data['phone'][0] != '0') {
                Session::flash('number_phone_error','The number phone format is invalid.');
                return redirect()->refresh();
            }
        }
        if(Str::length($data['phone']) == 11) {
            if($data['phone'][0].$data['phone'][1] != '84') {
                Session::flash('number_phone_error','The number phone format is invalid.');
                return redirect()->refresh();
            }
        }

        $nexmo->message()->send([
            'to' => $data['phone'],
            'from' => '84971086910',
            'text' => $token,
        ]);

        $worker = Worker::create([
            'email' => $data['email'],
            'phone' => $data['phone'],
            'token' => $token,
            'push_notify' => $data['push_notify'] ?? 0,
        ]);

        $worker->profile()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'furigana_first_name' => $data['furigana_first_name'],
            'furigana_last_name' => $data['furigana_last_name'],
            'area' => $data['area'],
        ]);

        $id = $worker->id;
        return redirect()->route('confirm.worker.sms', [$id]);
    }

    public function confirmSmsWorker($id) {
        return view('client.pages.worker.confirm_otp_page', compact('id'));
    }

    public function confirmSmsWorkerPost(Request $request, $id) {
        $request->validate([
            'otp' => 'required',
        ]);
        $data = $request->all();
        $worker = Worker::find($id);
        if($worker->token != $data['otp']) {
            Session::flash('error', '間違ったOTPコードを入力してください再入力してください');
            return redirect()->back();
        }

        return redirect()->route('setPassword.worker',  ['id' => $id,'token' => $worker->token]);
    }

    public function setPassword($id, $token) {
        return view('client.pages.worker.confirm-password', compact('id', 'token'));
    }

    public function setPasswordPost($id, $token, Request $request) {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        $worker = Worker::find($id);
        if(empty($worker) || $worker->token != $token) {
            abort(403);
        }
        if($worker->password != null) {
            $worker->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('home');
        }

        $verifyMail = new WorkerVerifyMail($id, route('confirm.mail', ['id' => $id,'token' => $worker->token]), $worker->token);
        $queueVerifyMail = new WorkerVerifyMailJob($worker->email, $verifyMail);
        dispatch($queueVerifyMail);
        $worker->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('alert.check.mail');
    }

    public function alertCheckMail() {
        return view('client.pages.worker.alert_check_mail');
    }

    public function confirmMail($id, $token) {
        $worker = Worker::find($id);
        if(empty($worker) || $worker->token != $token) {
            abort(404);
        }
        $worker->update([
            'verify_email' => 1,
        ]);
        session(['worker' => $worker]);
        return view('client.pages.worker.success-register-worker');
    }

    public function login(Request $request) {
        $data = $request->all();
        $request->validate([
            'phone' => 'required|numeric',
            'password' => 'required',
        ]);

        $worker = Worker::where('phone', $data['phone'])->first();
        if(empty($worker)) {
            return response()->json('your phone number or password is incorrect. Please try enter!');
        } else {
            if(Hash::check($data['password'], $worker->password)) {
                if($worker->verify_email == 1) {
                    session(['favorite' => $worker->jobFavorite]);
                    session(['worker' => $worker]);
                } else {
                    return response()->json('your phone is not verify!');
                }
            } else {
                return response()->json('your phone number or password is incorrect. Please try enter!');
            }
        }
    }

    public function forgotPassword() {
        return view('client.pages.worker.forgot_password_page');
    }

    public function forgotPasswordPost(Request $request, \Nexmo\Client $nexmo) {
        $data = $request->all();
        $request->validate([
            'phone' => 'required|numeric',
        ]);
        $worker = Worker::where('phone', $data['phone'])->first();
        if(empty($worker) || !$worker->verify_email) {
            Session::flash('error', 'Your phone number or password is incorrect. Please try enter!');
            return redirect()->route('worker.forgotPassword');
        }
        $token = rand(100000, 999999);

        $nexmo->message()->send([
            'to' => $data['phone'],
            'from' => '84971086910',
            'text' => $token,
        ]);

        $worker->update([
            'token' => $token,
        ]);

        return redirect()->route('confirm.worker.sms', [$worker->id]);
    }

    public function forgotPasswordSuccess() {
        return view('client.pages.worker.success-forgot-password');
    }

    public function logout() {
        Session::forget('worker');
        Session::forget('favorite');
        return redirect()->route('home');
    }
}
