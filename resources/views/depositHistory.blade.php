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
                        <!-- Notifications -->
                        <h5 class="card-header" style="color: dodgerblue">입금 등록 현황</h5>

                        <div class="card-body">
                            {{--1~12번 호출--}}
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-lg">
                                    <li>
                                        <div class="btn-group">
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                            >2023년
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:void(0);">2024년</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">2023년</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">2022년</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">2021년</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">2020년</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">2019년</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                            {{--1~12번 end--}}
                        </div>
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
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-adobe mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                adobe</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-algolia mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                algolia</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-audible mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                audible</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-figma mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                figma</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-redbubble mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                redbubble</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-etsy mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                etsy</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-gitlab mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                gitlab</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-patreon mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                patreon</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-facebook-circle mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                facebook-circle</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-imdb mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                imdb</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-jquery mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                jquery</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card icon-card cursor-pointer text-center mb-4 mx-2">
                                                        <div class="card-body">
                                                            <i class="bx bxl-pinterest-alt mb-2"></i>
                                                            <p class="icon-name text-capitalize text-truncate mb-0">
                                                                pinterest-alt</p>
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
