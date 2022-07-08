<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkerProfileRequest;
use App\Models\Media;
use App\Traits\StorageImagetraits;
use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\WorkerProfile;
use Illuminate\Support\Facades\Session;
use App\Models\Area;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\ValidatedInput;
use Illuminate\Hashing\BcryptHasher;


class WorkerController extends Controller
{

    protected $workerProfile;

    public function __construct(WorkerProfile $workerProfile, StorageImagetraits $storageImagetraits)
    {
        $this->workerProfile = $workerProfile;
        $this->storageImagetraits = $storageImagetraits;
    }

    public function myPage(Request $request)
    {

       $data = $request->session()->all();
       $workerProfile = DB::table('worker_profile')
       ->where('worker_id', '=', $data['worker']['id'])
       ->first();

        return view('client.pages.worker.profile',compact('workerProfile'));
    }

    public function editProfile($id, Area $area)
    {
        $worker = Worker::find($id);
        $workerProfile = $worker->profile;
        $area = $area->area();

       return view('client.pages.worker.update-profile',compact('workerProfile','area','worker'));
    }

    public function upLoadFile(Request $request)
    {
        $data = $request->session()->all();
        $workerProfile = DB::table('worker_profile')
            ->where('worker_id', '=', $data['worker']['id'])
            ->first();
          
        return view('client.pages.worker.upload-file')->with(compact('workerProfile'));
    }

    public function storeFile(Request $request)
    {

        $data = $request->session()->get('worker');

        if($data->profile->status != 0) {
            $request->validate([
                'passport_image_front' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'passport_image_back' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if(isset($request->passport_image_front)) {
                $image = $request->file('passport_image_front');
                $filename = $image->storeAs('public/passport', $image->getClientOriginalName());
                WorkerProfile::where('worker_id', $data['id'])->update([
                    'passport_image_front' => Storage::url($filename),
                    'status'=> WorkerProfile::STATUS['PENDING-APPROVE'],
                ]);
            }
            if(isset($request->passport_image_back)) {
                $image2 = $request->file('passport_image_back');
                $filename2 = $image2->storeAs('public/passport', $image2->getClientOriginalName());
                WorkerProfile::where('worker_id', $data['id'])->update([
                    'passport_image_back' =>Storage::url($filename2),
                    'status'=> WorkerProfile::STATUS['PENDING-APPROVE'],
                ]);
            }

            if(isset($request->passport_image_front) || isset($request->passport_image_back)) {
                return redirect()->route('uploadfile.uploadSuccess');
            }
        }

        return redirect()->back();
    }
    public function uploadSuccess(Request $request) {

        $data = $request->session()->all();
        $workerProfile = DB::table('worker_profile')
            ->where('worker_id', '=', $data['worker']['id'])
            ->first();
        return view('client.pages.worker.confirm-upload-file',compact('workerProfile'));
    }
    public function confirmUploadFile(Request $request)
    {
    
        $data = $request->session()->all();
        $workerProfile = DB::table('worker_profile')->where('worker_id', '=', $data['worker']['id'])->first();

        return view('client.pages.worker.confirm-upload-file',compact('workerProfile'));
    }

    public function degree(Request $request)
    {
        $data = $request->session()->all();
        $workerProfile = DB::table('worker_profile')
            ->where('worker_id', '=', $data['worker']['id'])
            ->first();
        return view('client.pages.worker.degree',compact('workerProfile'));
    }

    public function uploadDegree(Request $request) {
        $request->validate([
            'degree.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        $delete_image_array = explode(',', $data['delete_image_array'] ?? '');
        $worker = Worker::find(Session::get('worker')->id);
        $get_image_degree_by_id = get_image_degree_by_id($worker->profile->id);

        if(isset($data['delete_image_array'])) {
            foreach ($delete_image_array as $key => $value) {
                Media::where('id', $get_image_degree_by_id[$value]->id)->delete();
            }
        }

        if(isset($data['degree'])) {
            $get_image_degree_by_id = get_image_degree_by_id($worker->profile->id);
            foreach ($data['degree'] as $key => $fileItem) {
                $dataDegreeImagesDetail = $this->storageImagetraits->storageTraitUploadMutible($fileItem, 'Occupation');
                if($key >= count($get_image_degree_by_id)) {
                    $modelType = WorkerProfile::class;
                    Media::create([
                        "modelable_id" => $worker->profile->id,
                        "modelable_type" => $modelType,
                        "model_type" => WorkerProfile::MODEL_TYPE,
                        "media_type" => 'images',
                        'path' => $dataDegreeImagesDetail['file_path'],
                        'title' => $dataDegreeImagesDetail['file_name'],
                    ]);
                } else {
                    Media::find($get_image_degree_by_id[$key]->id)->update([
                        'path' => $dataDegreeImagesDetail['file_path'],
                        'title' => $dataDegreeImagesDetail['file_name'],
                    ]);
                }
            }
        }

        Session::flash('success');
        return redirect()->back();
    }

    public function updateWorkerProfile(WorkerProfileRequest $request, $id)
    {

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

        Worker::find($id)->update([
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'token' => $token,
            'push_notify' => $data['push_notify'] ?? 0,
        ]);
        $worker = Worker::find($id);
        $id = $worker->id;
        $worker->profile()->update([
           'first_name' => $data['first_name'],
           'last_name' => $data['last_name'],
           'gender' => $data['gender'],
           'birthday' => $data['birthday'],
           'furigana_first_name' => $data['furigana_first_name'],
           'furigana_last_name' => $data['furigana_last_name'],
           'area' => $data['area'] ?? null,
       ]);
         $this->uploadProfileImage($request,$id);
         Session::flash('success');
         return redirect()->route('edit.profile', [$id]);
    }

    public function uploadProfileImage(WorkerProfileRequest $request,$id)
    {
        $data = $request->all();
        $worker = Worker::find($id);

        if($request->hasFile('profile_image')){
            $avatarUpload = request()->file('profile_image');
            $avatarName = time().'.'.$avatarUpload->getClientOriginalExtension();
            $avatarPath = public_path('/upload/images/');
            $avatarUpload->move($avatarPath,$avatarName);
            $worker->profile()->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'gender' => $data['gender'],
                'birthday' => $data['birthday'],
                'profile_image' => '/upload/images/'.$avatarName,
                'furigana_first_name' => $data['furigana_first_name'],
                'furigana_last_name' => $data['furigana_last_name'],
                'area' => $data['area'] ?? null,
            ]);

        }

    }

    public function changePassword($id,Request $request)
    {
        $data = $request->all();
        //validate
        $worker = Worker::find($id);
        $validator = \Validator()->make($request->all(),[
            'oldpassword' => [
                'required', function($attribute,$value,$fail) use ($worker){
                    // $test = Hash::make('123123');
                    if( !Hash::check($value,$worker->password)){
                        return $fail('The current password is incorrect');
                    }
                },
                'max:30'
            ],
            'newpassword' =>'required|min:6|max:30',
            'cnewpassword' =>'required|same:newpassword'
            ],[
                'oldpassword.required'=>'Enter your current password',
                'oldpassword.min'=>'Old password must have atleast 6 characters',
                'oldpassword.max'=>'Old password must not be greater than 30 characters',
                'newpassword.required'=>'Enter new password',
                'newpassword.min'=>'New password must have atleast 6 characters',
                'newpassword.max'=>'New password must not be greater than 30 characters',
                'cnewpassword.required'=>'ReEnter your new password',
                'cnewpassword.same'=>'New password and Confirm new password must match'
            ]);


            if( !$validator->passes() ){
                return response()->json([
                    'status' => 0,
                    'error' =>$validator->errors()->toArray()
                ]);
            }else{
                $update = Worker::find($id)->update(['password'=>Hash::make($request->newpassword)]);
                if( !$update ){
                    return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
                }else{
                    return response()->json([
                        'status'=>1,
                        'msg'=>' Your password has been changed successfully'
                    ]);
                }
            }

    }

}
