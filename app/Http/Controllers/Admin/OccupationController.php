<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Occupation;
use App\Models\Media;
use App\Models\Station;
use App\Models\Job;
use App\Models\Store;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Repositories\OccupationRepository\OccupationRepositoryInterface;
use App\Repositories\StoreRepository\StoreRepositoryInterface;
use App\Repositories\MediaRepository\MediaRepositoryInterface;
use Illuminate\Http\Request;
use App\Traits\StorageImagetraits;
use App\Http\Requests\OccupationRequest;


class OccupationController extends Controller
{
    protected $OccupationRepository;
    protected $categoryRepository;
    protected $storageImagetraits;
    protected $storeRepository;
    protected $mediaRepository;

    public function __construct(
        OccupationRepositoryInterface $OccupationRepository,
        CategoryRepositoryInterface $categoryRepository,
        StorageImagetraits $storageImagetraits,
        StoreRepositoryInterface $storeRepository,
        MediaRepositoryInterface $mediaRepository
    )

    {

        $this->OccupationRepository = $OccupationRepository;
        $this->categoryRepository = $categoryRepository;
        $this->storageImagetraits = $storageImagetraits;
        $this->storeRepository = $storeRepository;
        $this->mediaRepository = $mediaRepository;
    }


    public function index()
    {
        $occupations = $this->OccupationRepository->getOccupationPaginate(4);
        return view("admin.occupation.index")->with(compact('occupations'));
    }
    public function pagination(Request $request)
    {

        if ($request->ajax()) {
            $occupations = $this->OccupationRepository->getOccupationByAjax($request, 4);
            return response()->json([
                'body' => view('admin.occupation.pagination', compact('occupations'))->render(),
                'occupations' => $occupations
            ]);
        }
    }

    public function create(Station $station)
    {
        $routes = $station->route();
        $htmlOption = $this->categoryRepository->getCategory($parentId = '');
        return view('admin.occupation.add', compact('routes', 'htmlOption'));
    }

    public function store(OccupationRequest $request)
    {
        $data = $request->all();
        if($data['confirm'] == 'true') {
            $occupation = $this->OccupationRepository->addOccupation($data);

            $stations = explode(',', $data['station']);
            $occupation->OccupationStation()->sync($stations);

            if(isset($data['file'])) {
                foreach ($data['file'] as $fileItem) {
                    $dataBooksImagesDetail = $this->storageImagetraits->storageTraitUploadMutible($fileItem, 'Occupation');
                    $modelType = Occupation::class;
                    Media::create([
                        "modelable_id" => $occupation->id,
                        "modelable_type" => $modelType,
                        "model_type" => Occupation::MODEL_TYPE,
                        "media_type" => 'images',
                        'path' => $dataBooksImagesDetail['file_path'],
                        'title' => $dataBooksImagesDetail['file_name']
                    ]);
                }
            }

            return response()->json([
                'urlCreateJob' => route('job.create',[$occupation->id]),
                'url' => route('occupation.edit', [$occupation->id]),
            ]);
        }
    }

    public function edit($id, Station $station)
    {
        $occupation = $this->OccupationRepository->getOccupationById($id);
        $htmlOption = $this->categoryRepository->getCategory($parentId = '',  $occupation);
        $routes = $station->route();
        return view('admin.occupation.edit', compact('routes', 'htmlOption', 'occupation'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'work_address' => 'required',
            'status' => 'required',
            'speciality' => 'required',
            'count_image' => 'numeric|min:3',
            'bring_item' => 'max:254',
            'title' => 'required|max:254',
        ]);
        $data = $request->all();
        if($data['confirm'] == 'true') {
            $occupation = $this->OccupationRepository->editOccupation($data, $id);

            $stations = explode(',', $data['station']);
            $occupation->OccupationStation()->sync($stations);

            if(isset($data['file'])) {
                foreach ($data['file'] as $fileItem) {
                    $dataBooksImagesDetail = $this->storageImagetraits->storageTraitUploadMutible($fileItem, 'Occupation');
                    $modelType = Occupation::class;
                    Media::create([
                        "modelable_id" => $occupation->id,
                        "modelable_type" => $modelType,
                        "model_type" => Occupation::MODEL_TYPE,
                        "media_type" => 'images',
                        'path' => $dataBooksImagesDetail['file_path'],
                        'title' => $dataBooksImagesDetail['file_name']
                    ]);
                }
            }

            if(isset($data['idImageRemove'])) {
                foreach ($data['idImageRemove'] as $idImageRemove) {
                    Media::where('id', $idImageRemove)->delete();
                }
            }

            return response()->json([
                'urlCreateJob' => route('job.create',[$occupation->id]),
                'url' => route('occupation.edit', [$occupation->id]),
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $getId = $request->input('delete_id'); //get id input hidden
        $job = Job::where('occupation_id', $getId)->first();
        if (empty($job)) {
            $this->OccupationRepository->deleteOccupation($getId);
            return back();
        } else {
            return back()->with('message', 'exist job! Cannot delete');
        }
    }
}
