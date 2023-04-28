{{-- 정산 / 입금내역 / 입금내역 등록, 조회 --}}
@extends('layouts.app')
@section('content')

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
                                            <option>4월</option>
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
                                    <div class="btn-group">
                                        <select class="form-select btn-success">
                                            <option class="form-control">입금액 초과</option>
                                            <option class="form-control">입금액 전체</option>
                                            <option class="form-control">입금액 초과</option>
                                            <option class="form-control">입금액 미만</option>
                                            <option class="form-control">입금액 합산</option>
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

                                    <div class="btn-group float-end mx-1">
                                        <button class="btn btn-success float-end">결과 다운로드</button>
                                    </div>
                                    <div class="btn-group float-end mx-1">
                                        <button
                                            type="button"
                                            class="btn btn-success float-end"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deposit_upload">입금내역 업로드
                                        </button>
                                    </div>
                                    <div class="modal fade" id="deposit_upload" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>입금내역 업로드</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <div class="form-control">
                                                            <h6 class="text-muted">파일 형식이 정확해야 합니다.</h6>
                                                            <h6 class="text-muted">샘플이 필요하신 경우 파일을 다운로드하세요. </h6>
                                                            <button class="btn btn-success">무통장</button>
                                                            <button class="btn btn-success">CMS</button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="text-black ">입금내역 유형을 선택하세요</h5>
                                                        <div class="alert-secondary rounded ">
                                                            <div class="card-body row">
                                                                <div class="my-2">
                                                                    <input  type="radio"><span class="text-black fw-bold">무통장</span>
                                                                </div>
                                                                <div class="my-2">
                                                                    <input  type="radio"><span class="text-black fw-bold">CMS</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="text-black ">입금내역 엑셀 파일을 선택하세요.</h5>
                                                        <input class="form-control " type="file" id="formFileDisabled" disabled />
                                                    </div>
                                                    <div class="text-center">
                                                        <button class="btn btn-primary">업로드</button>
                                                        <button class="btn btn-secondary">취소</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                    <td><span class="badge badge-center bg-warning">C</span> YES24</td>
                                    <td class="text-primary">61,600</td>
                                    <td>전자금융</td>
                                    <td>하나은행</td>
                                </tr>
                                <tr class="text-black">
                                    <td>CMS</td>
                                    <td>국민</td>
                                    <td>5434153-01-54153135</td>
                                    <td>2023-03-03</td>
                                    <td><span class="badge badge-center bg-warning">C</span> YES24</td>
                                    <td class="text-primary">61,600</td>
                                    <td>전자금융</td>
                                    <td>하나은행</td>
                                </tr>
                                <tr class="text-black">
                                    <td>CMS</td>
                                    <td>국민</td>
                                    <td>5434153-01-54153135</td>
                                    <td>2023-03-03</td>
                                    <td><span class="badge badge-center bg-primary">무</span> YES24</td>
                                    <td class="text-primary">61,600</td>
                                    <td>전자금융</td>
                                    <td>신한은행</td>
                                </tr>
                                <tr class="text-black">
                                    <td>CMS</td>
                                    <td>국민</td>
                                    <td>5434153-01-54153135</td>
                                    <td>2023-03-03</td>
                                    <td><span class="badge badge-center bg-warning">C</span> YES24</td>
                                    <td class="text-primary">61,600</td>
                                    <td>전자금융</td>
                                    <td>우리은행</td>
                                </tr>
                                <tr class="text-black">
                                    <td>CMS</td>
                                    <td>국민</td>
                                    <td>5434153-01-54153135</td>
                                    <td>2023-03-03</td>
                                    <td><span class="badge badge-center bg-primary">무</span> YES24</td>
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
