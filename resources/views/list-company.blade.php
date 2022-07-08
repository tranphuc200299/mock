<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>List company</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5375a15451.js" crossorigin="anonymous"></script>


</head>
<body>
<div class="card">
    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 p-3">
        <div class="d-flex justify-content-between">
            <span class="d-inline-block">List company</span>
            <a href="javascript:(0)" class="btn-add-new"><i class="fas fa-plus"></i></a>
        </div>
        <div class="">
            <form action="" method="get">
                <input type="text" name="search" placeholder="Search by keyword">
            </form>
        </div>
        <div class="d-flex justify-content-between">
            <span>Total: 2</span>
            <a href="javascript:(0)">Export list company</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                    <thead class="thead-light">
                    <tr role="row">
                        <th class="sorting sorting_asc">ID</th>
                        <th class="sorting" >Company name</th>
                        <th class="sorting" >HP URL</th>
                        <th class="sorting" >Contact infor</th>
                        <th class="sorting" >Adress</th>
                        <th class="sorting" >Status</th>
                        <th class="sorting" >Created date</th>
                        <th class="sorting" ></th>
                        <th class="sorting" >File uploaded</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd">
                        <td class="dtr-control sorting_1" tabindex="0">1</td>
                        <td>空いた時間で働ける！アシスタントタッフ</td>
                        <td>東京都渋谷区宇田川町３６-２　
                            ノア渋谷４０２号室</td>
                        <td>
                            name: ThaiDuong
                            Phone: 0347214898
                            Email: chien.can@ntq-solution.com
                        </td>
                        <td>東京都渋谷区宇田川町３６-２　 ノア渋谷４０２号室</td>
                        <td>Enable</td>
                        <td>2020-05-20 08:28:23</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn-edit"><i class="fas fa-pen"></i></button>
                                <button class="btn-delete"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </td>
                        <td><i class="fas fa-upload"></i></td>
                    </tr>
                    <tr class="even">
                        <td class="dtr-control sorting_1" tabindex="0">2</td>
                        <td>空いた時間で働ける！アシスタントタッフ</td>
                        <td>東京都渋谷区宇田川町３６-２　
                            ノア渋谷４０２号室</td>
                        <td>
                            name: ThaiDuong
                            Phone: 0347214898
                            Email: chien.can@ntq-solution.com
                        </td>
                        <td>東京都渋谷区宇田川町３６-２　 ノア渋谷４０２号室</td>
                        <td>Enable</td>
                        <td>2020-05-20 08:28:23</td>
                        <td>
                            <div class="d-flex">
                                <button><i class="fas fa-pen"></i></button>
                                <button class="btn-delete"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </td>
                        <td><i class="fas fa-upload"></i></td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    <ul class="pagination">
                        <li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                        <li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                        <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                        <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
