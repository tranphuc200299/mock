<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->categoryRepository->getAllCategoryPaginate(5);
        return view("admin.job-category.index")->with(compact('category'));
    }

    public function pagination(Request $request)
    {

        if ($request->ajax()) {
            $category = $this->categoryRepository->getAllCategoryByAjax($request, 5);
            return response()->json([
                'body' => view('admin.job-category.pagination', compact('category'))->render(),
                'category' => $category
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $queryCategory = $this->categoryRepository->getAllCategory();
        return view("admin.job-category.add")->with(compact('queryCategory'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        $category = $this->categoryRepository->addCategory($request);

        return redirect()->route('categoryjob.index')->with('message', 'Add Success Category');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category)
    {
        $queryCategoryEdit = $this->categoryRepository->getAllCategory();    // get all data
        $editCategory = $this->categoryRepository->getCategoryById($id); 
        // dd($editCategory);

        $parentName = ''; // get default
        foreach ($queryCategoryEdit as $data) {
            if ($data['id'] == $editCategory->parent_id) {
                $parentName = $data['name'];
                break;
            }
        }
        $query = $category->dequy($queryCategoryEdit, 0, '', $editCategory);
        return view('admin.job-category.edit')->with(compact('editCategory', 'queryCategoryEdit', 'parentName', 'query'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $updateCategory = $this->categoryRepository->updateCategory($request);
        return redirect()->route('categoryjob.index')->with('message', 'Update Success Category');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
