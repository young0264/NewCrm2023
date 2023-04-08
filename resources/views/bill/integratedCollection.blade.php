{{--비회원 청구 대상 등록--}}

@extends('layouts.app')
@section('content')

    <div id='right_click_menu' class="custom-context-menu" style="display: none; z-index: 99">
        <div class="mt-3">
            <div class="row">
                <div class="col-md-12 col-12 mb-3 mb-md-0">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal"
                           data-bs-target="#bill_integrate">계산서 통합</a>
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal"
                           data-bs-target="#bill_divide">계산서 분할</a>
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal"
                           data-bs-target="#price_sync">단가 동기화</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">정산 / 계산서 / </span> 통합 징수 출력
        </h4>

        <div class="form-floating">
            <div class="row">

                {{--            content left        --}}
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-primary">통합 징수 리스트 다운로드</h5>
                                <div class="btn-group">
                                    <select class="form-select">
                                        <option>2023년</option>
                                        <option>2018년</option>
                                        <option>2011년</option>
                                    </select>
                                </div>
                                <button type="button"
                                        class="btn btn-primary float-end"
                                        data-bs-toggle="modal"
                                        data-bs-target="#KOMCA_info_edit">KOMCA 정보 관리
                                </button>
                                <div class="modal fade" id="KOMCA_info_edit" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="btn btn-group modal-header">

                                                <div class="col-md-8">
                                                    <h2>KOMCA 정보 수정</h2>

                                                </div>
                                                <div class="col-md-2 mx-1">
                                                    <select class="form-select">
                                                        <option>2023년</option>
                                                        <option>2022년</option>
                                                        <option>2021년</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 mx-1">
                                                    <select class="form-select">
                                                        <option>12월</option>
                                                        <option>4월</option>
                                                        <option>3월</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-primary alert-dismissible" role="alert">
                                                    꼬자사케 강서구청점이 수정되었으며 창을 닫아도 유지됩니다.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                <div class="btn-group col-sm-2">
                                                    <select class="form-select">
                                                        <option>선택</option>
                                                    </select>
                                                </div>

                                                <input class="alert alert-secondary" placeholder="검색어를 입력하세요.">

                                                <div>
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-borderless border-bottom">
{{--                                                        <table class="table-hover ">--}}

                                                            <thead class="alert-secondary">
                                                            <tr>
                                                                <th class="text-nowrap text-center">콤카센터명<i class="bx bx-caret-down-circle"></i></th>
                                                                <th class="text-nowrap text-center">콤카업소코드<i class="bx bx-caret-down-circle"></i></th>
                                                                <th class="text-nowrap text-center ">업종<i class="bx bx-caret-down-circle"></i></th>
                                                                <th class="text-nowrap text-center ">영업장명<i class="bx bx-caret-down-circle"></i></th>
                                                                <th class="text-nowrap text-center ">지점명<i class="bx bx-caret-down-circle"></i></th>
                                                                <th class="text-nowrap text-center ">사업자번호<i class="bx bx-caret-down-circle"></i></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td><input class="form-control" value="서울센터(1센터)"></td>
                                                                <td><input class="form-control" value="786456746"></td>
                                                                <td class="table-primary">커피업종</td>
                                                                <td class="table-secondary">꼬지사케</td>
                                                                <td class="table-secondary">강서구청점</td>
                                                                <td class="table-secondary">11965456438</td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-control" value="서울센터(1센터)"></td>
                                                                <td><input class="form-control" value="786456746"></td>
                                                                <td class="table-primary">커피업종</td>
                                                                <td class="table-secondary">꼬지사케</td>
                                                                <td class="table-secondary">강서구청점</td>
                                                                <td class="table-secondary">11965456438</td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-control" value="서울센터(1센터)"></td>
                                                                <td><input class="form-control" value="786456746"></td>
                                                                <td class="table-primary">커피업종</td>
                                                                <td class="table-secondary">꼬지사케</td>
                                                                <td class="table-secondary">강서구청점</td>
                                                                <td class="table-secondary">11965456438</td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-control" value="서울센터(1센터)"></td>
                                                                <td><input class="form-control" value="786456746"></td>
                                                                <td class="table-primary">커피업종</td>
                                                                <td class="table-secondary">꼬지사케</td>
                                                                <td class="table-secondary">강서구청점</td>
                                                                <td class="table-secondary">11965456438</td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-control" value="서울센터(1센터)"></td>
                                                                <td><input class="form-control" value="786456746"></td>
                                                                <td class="table-primary">커피업종</td>
                                                                <td class="table-secondary">꼬지사케</td>
                                                                <td class="table-secondary">강서구청점</td>
                                                                <td class="table-secondary">11965456438</td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-control" value="서울센터(1센터)"></td>
                                                                <td><input class="form-control" value="786456746"></td>
                                                                <td class="table-primary">커피업종</td>
                                                                <td class="table-secondary">꼬지사케</td>
                                                                <td class="table-secondary">강서구청점</td>
                                                                <td class="table-secondary">11965456438</td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="form-control" value="서울센터(1센터)"></td>
                                                                <td><input class="form-control" value="786456746"></td>
                                                                <td class="table-primary">커피업종</td>
                                                                <td class="table-secondary">꼬지사케</td>
                                                                <td class="table-secondary">강서구청점</td>
                                                                <td class="table-secondary">11965456438</td>
                                                            </tr>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <!-- Notifications -->
                                <div class="card-body">
                                    <div class="content-wrapper">
                                        <!-- Content -->
                                        <div class="container-xxl flex-grow-1 container-p-y">
                                            <!-- Icon container -->
                                            <div class="d-flex flex-wrap" id="icons-container">
                                                <!-- Content wrapper -->
                                                <div class="content-wrapper">
                                                    <!-- Content -->
                                                    <div class="container-xxl flex-grow-1 container-p-y">
                                                        <div class="d-flex flex-wrap" id="icons-container">

                                                            <div class="mx-3">
                                                                <h4 align="right">1월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6>31일 09:40:52</h6>
                                                                        <h6>31일 11:40:52</h6>
                                                                        <a  href="javascript:void(0);">31일 16:40:52</a>
                                                                        <div>
                                                                            <button class="btn btn-success">신규 다운로드</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">2월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6>31일 09:40:52</h6>
                                                                        <h6>31일 11:40:52</h6>
                                                                        <button class="btn btn-success">신규 다운로드</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">3월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6>31일 09:40:52</h6>
                                                                        <h6>31일 11:40:52</h6>
                                                                        <button class="btn btn-success">신규 다운로드</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">4월</h4>
                                                                <div class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6>31일 09:40:52</h6>
                                                                        <h6>31일 11:40:52</h6>
                                                                        <button class="btn btn-success">신규 다운로드</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">5월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <button class="btn btn-success">신규 다운로드</button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">6월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 class="text-white">22222공백222222</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">7월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 class="text-white">22222공백222222</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">8월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 class="text-white">22222공백222222</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">9월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 class="text-white">22222공백222222</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">10월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 class="text-white">22222공백222222</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">11월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 class="text-white">22222공백222222</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">12월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 class="text-white">22222공백222222</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
