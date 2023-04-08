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
            <span class="text-muted fw-light">정산 / 계산서 / </span>계산서 양식 출력
        </h4>

        <div class="form-floating">
            <div class="row">

                {{--            content left        --}}
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->
                            <h5 class="card-header text-primary">계산서 양식 다운로드</h5>

                            <div class="card-body">
                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <button
                                                type="button"
                                                class="nav-link active"
                                                role="tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#navs-top-1"
                                                aria-controls="navs-top-1"
                                                aria-selected="true">
                                                세금 계산서 일반(01)
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button
                                                type="button"
                                                class="nav-link"
                                                role="tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#navs-top-2"
                                                aria-controls="navs-top-2"
                                                aria-selected="false">
                                                세금 계산서 위수탁(03)
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button
                                                type="button"
                                                class="nav-link"
                                                role="tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#navs-top-3"
                                                aria-controls="navs-top-3"
                                                aria-selected="false">
                                                계산서 위수탁(06)
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="container">
                                    <div class="btn-group">
                                        <div class=" col-md-3">
                                            <div class="card-body">
                                                <h5>작성일자<span class="font-semibold">&emsp;20240413</span></h5>
                                                <h5 class="text-danger text-center">(06:위수탁)</h5>
                                                <h5 class="text-danger text-center">(01:일반)</h5>
                                                <h5 style="border: 1px dashed #bbb; "></h5>
                                                <table class="table table-hover border-bottom">
                                                    <thead class="alert-danger">
                                                    <tr>
                                                        <th>공급가액</th>
                                                        <th>세액</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>899,100</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>450,100</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>900</td>
                                                        <td>0</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="card-body float-end">
                                                    <button class="btn btn-success">양식 다운로드</button>
                                                </div>
                                                <div class="card-body float-end">
                                                <div class="form-control">
                                                    <h5 class="text-primary">최근 다운로드 정보</h5>
                                                    <h5>영심이</h5>
                                                    <span class="text-muted fw-light align-content-center">2023-04-13 13:20:31</span>
                                                    <label></label>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" col-md-3">
                                            <div class="card-body">
                                                <div class="form-control">
                                                    <h3 align="center">공급 받는자</h3>
                                                    <input class="form-control btn-primary text-center" value="에이케이에스앤디(주)AK광명">
                                                    <div class="card-body">
                                                        <h5 style="border: 1px dashed #bbb; "></h5>
                                                    </div>
                                                    <h3 align="center"><span class="text-muted fw-light align-content-center">공급자</span>
                                                    </h3>
                                                    <div class="card">
                                                        <div class="btn btn-secondary container-fluid ">음저협</div>
                                                        <div class="btn btn-secondary container-fluid my-2">음실연</div>
                                                        <div class="btn btn-secondary container-fluid">함저협</div>
                                                        <div class="btn btn-secondary container-fluid my-2">연제협</div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 style="border: 1px dashed #bbb; "></h5>
                                                    </div >
                                                    <h3 ><span class="text-muted fw-light">수탁자</span></h3>
                                                    <div class="btn btn-primary container-fluid">(주)샵캐스트</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" col-md-5">
                                        <div class="card-body">
                                            <div class="alert alert-info container-fluid text-center">
                                                <div class="btn-group">
                                                    <h3 align="center"><span class="text-muted fw-light">수탁자</span>
                                                        (주)샵캐스트</h3>
                                                </div>
                                                <div class="btn-group float-end">
                                                    <button class="form-control btn-primary ">저장</button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <label>작성일자</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="alert alert-danger container-fluid text-black" value="20240413">
                                                </div>
                                                <label>등록번호</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="alert alert-warning container-fluid text-black" value="20240413">
                                                </div>
                                                <label> 공급가액</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="alert alert-warning container-fluid text-black" value="20240413">
                                                </div>
                                                <label>&emsp;품목&emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="form-control container-fluid my-2 text-black" value="20240413">
                                                </div>
                                                <label> &emsp;일자 &emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="alert alert-warning container-fluid text-black" value="20240413">
                                                </div>
                                                <label> &emsp;상호 &emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="alert alert-warning container-fluid text-black" value="20240413">
                                                </div>
                                                <label>&emsp;성명&emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="alert alert-warning container-fluid text-black" value="20240413">
                                                </div>
                                                <label>사업장주소</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="form-control container-fluid text-black" value="20240413">
                                                </div>
                                                <label>&emsp;업태&emsp;&emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="form-control container-fluid text-black my-2 " value="20240413">
                                                </div>
                                                <label>&emsp;종목&emsp;&emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="form-control container-fluid text-black" value="20240413">
                                                </div>
                                                <label>&emsp;이메일&emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="form-control container-fluid text-black my-2" value="20240413">
                                                </div>
                                                {{--                                                계산서 음실연--}}
                                                <label>&emsp;일자1</label>
                                                <div class="btn-group col-md-10 ">
                                                    <select
                                                        class="btn-group col-md-3 alert alert-warning text-black container-fluid">
                                                        <option>1</option>
                                                        <option>31</option>
                                                    </select>
                                                </div>
                                                <label>공급가액1</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="alert alert-warning container-fluid text-black" value="20240413">
                                                </div>
                                                <label>&emsp;품목1&emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="form-control container-fluid my-2" value="20240413">
                                                </div>
                                                <label>&emsp;일자2</label>
                                                <div class="btn-group col-md-10">
                                                    <select
                                                        class="btn-group col-md-3 alert alert-warning container-fluid text-black">
                                                        <option>1</option>
                                                        <option>31</option>
                                                    </select>
                                                </div>
                                                <label>공급가액2</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="alert alert-warning container-fluid text-black" value="20240413">
                                                </div>
                                                <label>&emsp;품목2&emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="form-control container-fluid text-black my-2" value="20240413">
                                                </div>

                                                <label>&emsp;일자3</label>
                                                <div class="btn-group col-md-10">
                                                    <select
                                                        class="btn-group col-md-3 alert alert-warning container-fluid text-black">
                                                        <option>1</option>
                                                        <option>31</option>
                                                    </select>
                                                </div>
                                                <label>공급가액3</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="alert alert-warning container-fluid text-black" value="20240413">
                                                </div>
                                                <label>&emsp;품목3&emsp;</label>
                                                <div class="btn-group col-md-10">
                                                    <input class="form-control container-fluid text-black" value="20240413">
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
