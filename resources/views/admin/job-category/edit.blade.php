@extends('admin.layouts.admin')
@section('title')
    Category
@endsection
@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header', [
            'name' => 'Category ',
            'key' => 'Edit',
        ])
        <!-- Content Header (Page header) -->
        <div class="content my-2">
            <div class="card card-warning">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="card-body">
                            </div>
                            <form action="{{ route('categoryjob.update', [$editCategory->id]) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12 col-lg-8 col-md-6 col-sm-6 col-6 ">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Name</label>
                                            <input type="text" class="form-control form-control-lg" name="name"
                                                id="name-category" placeholder="Category name"
                                                value="{{ $editCategory->name }}">
                                            @error('name')
                                                <span style="color:red;">{{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-8 col-md-6 col-sm-6 col-6  ">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" placeholder="Enter ..." id="description-category" name="description" rows="5"
                                                style=" resize: none;">{{ $editCategory->description }}</textarea>
                                            @error('description')
                                                <span style="color:red;">{{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-8 col-md-6 col-sm-6 col-6  ">
                                        <div class="form-group">
                                            <label for="">Parent Category</label>

                                            <select class="form-control" name="parent_id"
                                                aria-label="Default select example">
                                                <option value="0"> ---parent---</option>
                                                {{-- <option selected value="{{$editCategory->parent_id }}"> {{ $parentName }}</option> --}}

                                                {!! $query !!}
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-button">
                                    <div class="row float-right">
                                        <button type="submit" class="btn btn-outline-primary"
                                            id="btn-jobcategory">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
