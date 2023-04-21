{{--deposit search--}}

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
        <span class="text-muted fw-light">정산 / 입금내역 / </span>입금내역 등록, 조회
    </h4>

    <div class="form-floating">
        <div class="row">

            {{--            content left        --}}
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="card">
                        <!-- Notifications -->
                        <h5 class="card-header text-primary">입금 등록 현황</h5>

                        <div class="card-body">
                            <div class="card-body">
                                <div>
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
                                            <option>일선택</option>
                                            <option>1일</option>
                                            <option>31일</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="btn-group">
                                        <select class="form-select">
                                            <option>계좌</option>
                                            <option>계좌1</option>
                                            <option>계좌2</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <select class="form-select">
                                            <option>검색 필드선택</option>
                                            <option>필드1</option>
                                            <option>필드22</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <input class="form-control" placeholder="검색어를 입력하세요.">
                                    </div>

                                    <div class="btn-group">
                                        <button class="btn btn-success align-items-end">입금내역 업로드</button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-success ">결과 다운로드</button>
                                    </div>
                                </div>

                            </div>

                            <table class="table">
                                <thead class="table-primary">
                                <tr>
                                    <th>입금코드</th>
                                    <th>은행</th>
                                    <th>계좌</th>
                                    <th>거래일자</th>
                                    <th>의뢰인</th>
                                    <th>입금액</th>
                                    <th>거래구분</th>
                                    <th>거래점</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-black">
                                    <td>CMS</td>
                                    <td>국민</td>
                                    <td>5434153-01-54153135</td>
                                    <td>2023-03-03</td>
                                    <td>YES24</td>
                                    <td class="text-primary">61,600</td>
                                    <td>전자금융</td>
                                    <td>하나은행</td>
                                </tr>
                                <tr class="text-black">
                                    <td>CMS</td>
                                    <td>국민</td>
                                    <td>5434153-01-54153135</td>
                                    <td>2023-03-03</td>
                                    <td>YES24</td>
                                    <td class="text-primary">61,600</td>
                                    <td>전자금융</td>
                                    <td>하나은행</td>
                                </tr>
                                <tr class="text-black">
                                    <td>CMS</td>
                                    <td>국민</td>
                                    <td>5434153-01-54153135</td>
                                    <td>2023-03-03</td>
                                    <td>YES24</td>
                                    <td class="text-primary">61,600</td>
                                    <td>전자금융</td>
                                    <td>신한은행</td>
                                </tr>
                                <tr class="text-black">
                                    <td>CMS</td>
                                    <td>국민</td>
                                    <td>5434153-01-54153135</td>
                                    <td>2023-03-03</td>
                                    <td>YES24</td>
                                    <td class="text-primary">61,600</td>
                                    <td>전자금융</td>
                                    <td>우리은행</td>
                                </tr>
                                <tr class="text-black">
                                    <td>CMS</td>
                                    <td>국민</td>
                                    <td>5434153-01-54153135</td>
                                    <td>2023-03-03</td>
                                    <td>YES24</td>
                                    <td class="text-primary">61,600</td>
                                    <td>전자금융</td>
                                    <td>국민은행</td>
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
