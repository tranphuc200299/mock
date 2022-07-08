@extends('admin.layouts.admin')
@section('title')
    Occupation Detail
@endsection
@section('css')
    <link href="{{ URL::asset('css/admin/occupation.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header', [
            'name' => 'Add/Edit ',
            'key' => 'Occupation',
        ])
        <!-- Content Header (Page header) -->
        <div class="content my-2">
            <div class="card card-warning">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="card-body">
                            </div>
                            @yield('form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--modal confirm create occupation --}}
@include('admin.occupation.confirm-modal')



