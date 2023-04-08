@extends('layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">정산 / 입금내역 / </span>입금내역 매칭(2)
        </h4>

        <div class="row ">
            <div class="col-md-3">
                <div class="form-control">
                    <div class="mx-2 my-2">
                        <div class="row">
                            <div class="col-md-7 alert btn-primary text-white text-center">
                                1차 완전한 매칭
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-muted text-center my-3"> 0 / <span class="text-black fw-bold">20</span>
                                    / 100</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 alert alert-secondary text-center">
                                2차 히스토리 매칭
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-muted text-center my-3"> 0 / 0 / 100</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 alert alert-secondary text-center">
                                3차 매칭?
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-muted text-center my-3"> 0 / 0 / 0</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 alert alert-secondary text-center">
                                4차 매칭?
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-muted text-center my-3"> 0 / 0 / 0</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 alert alert-secondary text-center">
                                5차 매칭?
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-muted text-center my-3"> 0 / 0 / 0</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 alert alert-secondary text-center">
                                6차 매칭
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-muted text-center my-3"> 0 / 0 / 100</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-control">
                    <div class="card-body">
                        <h5 class="text-primary">완전한 일치 - 정확도 100%</h5>
                        <h5 class="text-black">상호명과 단가로 완전하게 일치하는 매장을 연결합니다.</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h4>청구 대상</h4>
                                <div class="form-control my-4">상호명</div>
                                <div class="form-control my-4">단가</div>
                            </div>
                            <div class="col-md-1">
                                <h4 class=" my-6">~</h4>
                                <div class="alert form-control my-4">. . .</div>
                            </div>
                            <div class="col-md-3">
                                <h4>입금내역</h4>
                                <div class="form-control my-4">의뢰인</div>
                                <div class="form-control my-4">입금액</div>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col-md-7">
                                <div class="progress">
                                    <div
                                        class="progress-bar"
                                        role="progressbar"
                                        style="width: 35%"
                                        aria-valuenow="35"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                    >
                                        35%
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="card-body">
                                <h5 class="fw-bold">결과</h5>
                                <div class="alert alert-secondary">
                                    <h5>미매칭 입금내역 <span class="fw-bold">100건</span>이 발견되었습니다.</h5>
                                    <h5>완전한 일치로
                                        <span class="text-primary fw-bold">20건</span>이
                                        <span class="text-primary fw-bold">매칭</span>되었습니다.
                                    </h5>
                                    <div class="btn btn-dark">
                                        검토 후 확정하기
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="card-body">
                                <button class="btn btn-primary float-end">시작하기</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
