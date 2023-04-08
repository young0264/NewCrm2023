{{--계산서 양식 출력 내역(임시)--}}

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
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">계산서
                            양식 출력</a>
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">계산서
                            삭제</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">정산 / 계산서 / </span>계산서 양식 출력 내역(임시)
        </h4>

        <div class="form-floating">
            <div class="row">

                {{--            content left        --}}
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->

                            <div class="card-body">
                                <h5 class=" text-primary">계산서 양식 출력 내역</h5>

                                <div class="my-2">
                                    <div class="btn-group">
                                        <select class="form-select">
                                            <option>2023년</option>
                                            <option>2022년</option>
                                            <option>2021년</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <select class="form-select">
                                            <option>4월<option>
                                            <option>3월</option>
                                            <option>2월</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <select class="form-select">
                                            <option>선택</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <input class="form-control alert-secondary" placeholder="검색어를 입력하세요.">
                                    </div>
                                </div>
                                <table class="table">
                                    <thead class="table-primary">
                                    <tr>
                                        <th>결제방식</th>
                                        <th>회사코드</th>
                                        <th>본사명</th>
                                        <th>매장명</th>
                                        <th>사업자번호</th>
                                        <th>입금매칭</th>
                                        <th>종류</th>
                                        <th>작성일자</th>
                                        <th>품목1</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="text-black">
                                        <td class="badge bg-warning my-1">C</td>
                                        <td class="text-secondary">ABIZZ012321</td>
                                        <td>탐앤탐스</td>
                                        <td>경기도 광주점</td>
                                        <td class="text-secondary">214-85-57282</td>
                                        <td class="text-primary">완료</td>
                                        <td>01:일반</td>
                                        <td class="text-secondary">2023-04-13</td>
                                        <td class="text-secondary">3월공연사용료</td>
                                    </tr>
                                    <tr class="text-black">
                                        <td class="badge bg-primary my-1">무</td>
                                        <td class="text-secondary">ABIZZ012321</td>
                                        <td>탐앤탐스</td>
                                        <td>경기도 광주점</td>
                                        <td class="text-secondary">214-85-57282</td>
                                        <td class="text-primary">완료</td>
                                        <td>01:일반</td>
                                        <td class="text-secondary">2023-04-13</td>
                                        <td class="text-secondary">3월공연사용료</td>
                                    </tr>
                                    <tr class="text-black">
                                        <td class="badge bg-primary my-1">무</td>
                                        <td class="text-secondary">ABIZZ012321</td>
                                        <td>탐앤탐스</td>
                                        <td>경기도 광주점</td>
                                        <td class="text-secondary">214-85-57282</td>
                                        <td class="text-primary">완료</td>
                                        <td>01:일반</td>
                                        <td class="text-secondary">2023-04-13</td>
                                        <td class="text-secondary">3월공연사용료</td>
                                    </tr>
                                    <tr class="text-black">
                                        <td class="badge bg-warning my-1">C</td>
                                        <td class="text-secondary">ABIZZ012321</td>
                                        <td>탐앤탐스</td>
                                        <td>경기도 광주점</td>
                                        <td class="text-secondary">214-85-57282</td>
                                        <td class="text-primary">완료</td>
                                        <td>01:일반</td>
                                        <td class="text-secondary">2023-04-13</td>
                                        <td class="text-secondary">3월공연사용료</td>
                                    </tr>
                                    <tr class="text-black">
                                        <td class="badge bg-primary my-1">무</td>
                                        <td class="text-secondary">ABIZZ012321</td>
                                        <td>탐앤탐스</td>
                                        <td>경기도 광주점</td>
                                        <td class="text-secondary">214-85-57282</td>
                                        <td class="text-secondary">미완료</td>
                                        <td>01:일반</td>
                                        <td class="text-secondary">2023-04-13</td>
                                        <td class="text-secondary">3월공연사용료</td>
                                    </tr>
                                    <tr class="text-black">
                                        <td class="badge bg-warning my-1">C</td>
                                        <td class="text-secondary">ABIZZ012321</td>
                                        <td>탐앤탐스</td>
                                        <td>경기도 광주점</td>
                                        <td class="text-secondary">214-85-57282</td>
                                        <td class="text-primary">완료</td>
                                        <td>01:일반</td>
                                        <td class="text-secondary">2023-04-13</td>
                                        <td class="text-secondary">3월공연사용료</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body align">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item first">
                                            <a class="page-link" href="javascript:void(0);"
                                            ><i class="tf-icon bx bx-chevrons-left"></i
                                                ></a>
                                        </li>
                                        <li class="page-item prev">
                                            <a class="page-link" href="javascript:void(0);"
                                            ><i class="tf-icon bx bx-chevron-left"></i
                                                ></a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">2</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="javascript:void(0);">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">4</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">5</a>
                                        </li>
                                        <li class="page-item next">
                                            <a class="page-link" href="javascript:void(0);"
                                            ><i class="tf-icon bx bx-chevron-right"></i
                                                ></a>
                                        </li>
                                        <li class="page-item last">
                                            <a class="page-link" href="javascript:void(0);"
                                            ><i class="tf-icon bx bx-chevrons-right"></i
                                                ></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
