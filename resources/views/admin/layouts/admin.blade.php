<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ URL::asset('fonts/fontawesome-pro-5.8.2-web/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ URL::asset('css/admin/category.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/admin/skills.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('../adminlte/dist/css/adminlte.min.css')}}">
    <link href="{{ URL::asset('css/admin/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/admin/company.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/admin/register.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/admin/occupation.css') }}" rel="stylesheet">
    @yield('css')

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('admin.partials.header')

    @include('admin.partials.siderbar')

    @yield('content')
    @yield('script')

{{--    @include('admin.partials.footer')--}}
</div>
<script src="{{ URL::asset('js/jquery.min.js')}}"></script>
<script src="{{ URL::asset('js/toastr.min.js')}}"></script>
<script src="{{ URL::asset('js/popper.min.js')}}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('js/moment.min.js') }}"></script>
<script src="{{ URL::asset('js/datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('js/wow.min.js')}}"></script>
<script src="{{asset('../adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{ URL::asset('js/main.js')}}"></script>
{{--File ajax admin--}}
<script src="{{ URL::asset('js/admin/main-ajax.js')}}"></script>
{{--define variable URL route used javascript(ajax)--}}
<script>
    const URL_COMPANY_INDEX = '{{ route('company.index') }}';
    const URL_COMPANY_SEARCH_PAGINATION = '{{ route('company.search') }}';
    const URL_FILE_UPLOAD =  '{{ route('file.upload') }}';
    const URL_CREATE_USER_COMPANY = '{{ route('company.addCompanyUser') }}';
    const URL_UPDATE_USER_COMPANY = '{{ route('company.updateCompanyUser') }}';
    const URL_GET_USER_COMPANY = '{{ route('get-user.company') }}';
    const URL_DELETE_USER_COMPANY = '{{ route('user.company.delete') }}';
    const URL_GET_FILE_UPLOAD_COMPANY = '{{ route('get.file.upload.company') }}';
    const URL_JOB_SEARCH_PAGINATION = '{{ route('jobs.search.pagination') }}';
    const URL_JOB_CREATE = '{{ route('job.store') }}';
    const URL_JOB_CONFIRM = '{{ route('job.confirm.create') }}';
    const URL_JOB_DETAIL = '{{ route('job.detail') }}';

    const URL_CATEGORY_INDEX = '{{ route('categoryjob.pagination') }}';
    const URL_SKILL_INDEX = '{{ route('skill.pagination') }}';
    const URL_OCCUPATION_INDEX = '{{ route('occupation.pagination') }}';
    const URL_WORKER_SEARCH_PAGINATION = '{{ route('workers.search.pagination') }}';

</script>


{{--blade js--}}
@stack('scripts')
</body>
</html>
