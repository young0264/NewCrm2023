@extends('layouts.app')
@section('content')

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
                            <div class="card-header">
                                <h4 class="text-primary">입금 등록 현황</h4>
                                <div class="btn-group">
                                    <select class="form-select">
                                        <option>2023년</option>
                                        <option>2018년</option>
                                        <option>2011년</option>
                                    </select>
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
                                                                        <h6><span class="badge badge-center bg-warning">C</span> 31일 09:40:52</h6>
                                                                        <h6><span class="badge badge-center bg-primary">무</span> 31일 11:40:52</h6>
                                                                        <a  href="javascript:void(0);"><span class="badge badge-center bg-warning">C</span> 31일 16:40:52</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">2월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6><span class="badge badge-center bg-primary">무</span> 31일 09:40:52</h6>
                                                                        <h6><span class="badge badge-center bg-primary">무</span> 31일 11:40:52</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">3월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6><span class="badge badge-center bg-warning">C</span> 31일 09:40:52</h6>
                                                                        <h6><span class="badge badge-center bg-primary">무</span> 31일 11:40:52</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">4월</h4>
                                                                <div class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6><span class="badge badge-center bg-warning">C</span> 31일 09:40:52</h6>
                                                                        <h6><span class="badge badge-center bg-warning">C</span> 31일 11:40:52</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">5월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3 alert-secondary">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">6월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3 alert-secondary">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">7월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3 alert-secondary">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mx-3">
                                                                <h4 align="right">8월</h4>
                                                                <div
                                                                    class="card icon-card cursor-pointer text-center mb-4 mx-3 alert-secondary">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        <h6 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
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
@endsection
