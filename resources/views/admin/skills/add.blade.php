@extends('admin.layouts.admin')

@section('title')
    Skills
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header', [
            'name' => 'Skills ',
            'key' => 'Add',
        ])
        <div class="content my-2">
            <div class="card card-warning">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="card-body">
                            </div>
                            <form action="{{ route('skill.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12 col-lg-8 col-md-6 col-sm-6 col-6 ">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Name</label>
                                            <input type="text" class="form-control form-control-lg" name="name"
                                                id="name-category" placeholder="Skills name">
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
                                                style=" resize: none;"></textarea>
                                            @error('description')
                                                <span style="color:red;">{{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-button">
                                    <div class="row float-right">
                                        <button type="submit" class="btn btn-outline-primary"
                                            id="btn-jobcategory">Add</button>
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
