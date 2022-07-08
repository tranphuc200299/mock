<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LineLoginController extends Controller
{
    public function redirectToLine()
    {
        return Socialite::driver('line')->redirect();
    }

    public function lineSignIn()
    {
        try {
            $user = Socialite::driver('line')->user();
            $lineId = Worker::where('line_id', $user->id)->first();

            if($lineId){
                // Auth::login($facebookId);
                Session::put("worker",  $lineId);
                return redirect('/');
            }else{
                $createWorker = Worker::create([
                    'line_id' => $user->id,
                    'verify_email' => 1,
                ]);
                $createWorker->profile()->create([
                    'last_name' => $user->name,
                ]);

                Session::put("worker",  $createWorker);
                return redirect()->route('home');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
