<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    public function favorite() {
        if(Session::has('worker')) {
            $worker = Worker::find(Session::get('worker')->id);
            $workerFavorite = $worker->jobFavorite;
            $jobs = $worker->jobFavorite;
            return view('client.pages.home.favorite', compact('jobs','workerFavorite'));
        }
       return redirect()->route('home');
    }

    public function history() {
        $jobs = [];
        if(Session::has('history')) {
            $jobs = Session::get('history');
        }
        $workerFavorite = null;
        if(Session::has('worker')) {
            $worker = Worker::find(Session::get('worker')->id);
            $workerFavorite = $worker->jobFavorite;
        }
        return view('client.pages.home.history', compact('jobs', 'workerFavorite'));
    }

    public function addFavorite(Request $request) {
        if(Session::has('worker')) {
            $worker = Worker::find(Session::get('worker')->id);

            foreach ($worker->jobFavorite as $job) {
                if($job->id == $request->id) {
                    $worker->jobFavorite()->detach($request->id);
                    $worker = Worker::find(Session::get('worker')->id);
                    $countFavorite = count($worker->jobFavorite);
                    Session::put('favorite', $worker->jobFavorite);
                    return response()->json([
                        'active' => false,
                        'countFavorite' => $countFavorite,
                    ]);
                }
            }
            $worker->jobFavorite()->attach($request->id);

            $worker = Worker::find(Session::get('worker')->id);
            $countFavorite = count($worker->jobFavorite);
            Session::put('favorite', $worker->jobFavorite);

            return response()->json([
                'active' => true,
                'countFavorite' => $countFavorite,
            ]);
        }
        return response()->json([
            'active' => false,
            'countFavorite' => 0,
        ]);
    }

}
