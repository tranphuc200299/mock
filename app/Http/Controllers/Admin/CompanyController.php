<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\UserPostRequest;
use App\Models\Area;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\CompanyRepository\CompanyRepositoryInterface;
use App\Repositories\MediaRepository\MediaRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportCompany;
use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\UpdateUserCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    protected $companyRepository;

    protected $mediaRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository,
                                MediaRepositoryInterface $mediaRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->mediaRepository = $mediaRepository;
    }

    public function index(Request $request)
    {
        $company = $this->companyRepository->getCompanyPagination(4);
        return view('admin.company.index', compact("company"));
    }

    public function showCompany(Request $request)
    {
        if ($request->ajax())
        {
            $company = $this->companyRepository->getSearchCompanyByKey($request, 4);
            return response()->json([
                'body' => view('admin.company.search', compact('company'))->render(),
                'company' => $company
            ]);
        }
    }

    public function create(Area $area)
    {
        $cities = $area->city();
        $categories = Category::all();

        return view('admin.company.add', compact('cities', 'categories'));
    }

    public function store(CompanyRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $company = $this->companyRepository->addEditCompany($data);
        return redirect()->route('company.edit', [$company->id]);
    }

    public function edit($id, Area $area)
    {
        $company = $this->companyRepository->getCompanyById($id);
        $companyUser = $company->userCompany;
        $cities = $area->city();
        $categories = Category::all();

        return view('admin.company.add', compact('companyUser', 'company', 'cities', 'categories'));
    }

    public function addCompanyUser(UserPostRequest $request): \Illuminate\Http\JsonResponse
    {

        $data = $request->all();
        $user = $this->companyRepository->addCompanyUser($data);
        $company = $this->companyRepository->getCompanyById($data['companyId']);
        $company->userCompany()->attach($user->id);

        return response()->json([
            'user' => $user
        ]);
    }

    public function update(CompanyRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();

        $this->companyRepository->addEditCompany($data, $id);

        return redirect()->route('company.index');
    }


    public function exportCompanyIntoCSV(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new ExportCompany, 'company.csv');
    }

    public function uploadFile(FileUploadRequest  $request): \Illuminate\Http\JsonResponse
    {
        $fileUpload = $this->mediaRepository->saveFileUploadCompany($request);
        return response()->json([
            'fileUpload' => $fileUpload
        ]);
    }

    //function update user company
    public function updateCompanyUser(UpdateUserCompanyRequest $request): \Illuminate\Http\JsonResponse
    {

        $data = $request->all();
        $user = $this->companyRepository->updateCompanyUser($data);

        return response()->json([
            'user' => $user
        ]);
    }

    //function get user by company id
    public function getUserByCompanyId(Request $request): \Illuminate\Http\JsonResponse
    {

        $data = $request->all();
        $company = $this->companyRepository->getCompanyById($data['id']);
        $companyUser = $company->userCompany;

        return response()->json([
            'body' => view('admin.company.list-user-company', compact('companyUser'))->render(),
            'companyUser' => $companyUser
        ]);
    }

    //function delete user of company
    public function deleteUserCompany(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $user = $this->companyRepository->deleteUserOfCompany($data);
        return response()->json([
            'user' => $user
        ]);
    }

    public function getFileUploadOfCompany(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $fileUpload = $this->mediaRepository->getFileUploadedById($data['id'],Company::class, Company::MODEL_TYPE);
        return response()->json([
            'body' => view('admin.company.item-file-upload', compact('fileUpload'))->render(),
            'fileUpload' => $fileUpload
        ]);
    }
}
