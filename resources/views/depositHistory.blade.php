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
        <span class="text-muted fw-light">정산 / 입금내역 / </span>입금내역 등록 히스토리
    </h4>

    <div class="form-floating">
        <div class="row">

            {{--            content left        --}}
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-body">
                        <!-- Notifications -->
                        <div class="btn-group col-md-2">
                            <div class="card-body">
                                <h5 class="card-header text-primary" >입금 등록 현황</h5>
                                <div class="card-body">
                                    <select class="form-select">
                                        <option>2024년</option>
                                        <option>2023년</option>
                                        <option>2022년</option>
                                        <option>2021년</option>
                                        <option>2020년</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group col-md-8">
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
                                                    <div class="">
                                                        <h4 align="right">1월</h4>

                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">2월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">3월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">4월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">5월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">6월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">7월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">8월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">9월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">10월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">11월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h4 align="right">12월</h4>
                                                        <div
                                                            class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                            <div class="card-body my-xxl-5 mx-xxl-5">
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
</div>
@stop
