<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateUserCompanyRequest;
use App\Http\Requests\UserPostRequest;
use App\Models\Area;
use App\Models\Station;
use App\Models\Store;
use App\Repositories\StoreRepository\StoreRepositoryInterface;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function index(Request $request) {
        $store = $this->storeRepository->getStorePagination(4);

        if ($request->ajax())
        {
            $store = $this->storeRepository->getSearchStoreByKey($request, 4);

            return response()->json([
                'body' => view('admin.store.search', compact('store'))->render(),
                'store' => $store
            ]);
        }

        return view('admin.store.index', compact('store'));
    }

    public function create(Area $area,  Station $station) {
        $routes = $station->route();
        $cities = $area->city();

        return view('admin.store.add', compact('routes', 'cities'));
    }

    public function store(StoreRequest $request) {
        $data = $request->all();
        $store = $this->storeRepository->addEditStore($data);
        if(isset($data['area'])) {
            foreach ($data['area'] as $area) {
                $store->storeStation()->attach($area);
            }
        }
        return redirect()->route('store.edit', [$store->id]);
    }

    public function edit($id, Area $area,  Station $station)
    {
        $routes = $station->route();
        $cities = $area->city();
        $store = $this->storeRepository->getStoreById($id);

        return view('admin.store.edit', compact('store', 'routes', 'cities'));
    }

    public function update(StoreRequest $request, $id)
    {
        $data = $request->all();

        $this->storeRepository->addEditStore($data, $id);

        return redirect()->route('store.index');
    }

    public function delete($id)
    {
        return redirect()->route('store.index');
    }

    public function getUserByStore(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $store = $this->storeRepository->getStoreById($data['id']);
        $storeUser = $store->userStore;

        return response()->json([
            'body' => view('admin.store.list-user-store', compact('storeUser'))->render(),
            'storeUser' => $storeUser
        ]);
    }

    public function addStoreUser(UserPostRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $user = $this->storeRepository->addEditStoreUser($data);
        $user->assignRole('store');
        $user->store()->attach($data['storeId']);

        return response()->json([
            'user' => $user
        ]);
    }

    public function updateStoreUser(UpdateUserCompanyRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $user = $this->storeRepository->addEditStoreUser($data, $data['id']);

        return response()->json([
            'user' => $user
        ]);
    }

    public function deleteStoreUser(Request $request)
    {
        $data = $request->all();
        $user = $this->storeRepository->deleteUserOfStore($data);
        return response()->json([
            'user' => $user
        ]);
    }
}
