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
                                                            @for($month=1; $month<=12; $month++)
                                                            <div class="mx-3">
                                                                <h4 align="right">{{$month}}월</h4>
                                                                <div class="card icon-card cursor-pointer text-center mb-4 mx-3">
                                                                    <div class="card-body my-xxl-4 mx-xxl-4">
                                                                        @if(isset($history_res[sprintf("%02d", $month)]))
                                                                            @foreach ($history_res[sprintf("%02d", $month)] as $key => $res)
                                                                                <h6 {!! $key=="0" ? "style='font-weight:bold'" : "" !!}>
                                                                                    <a href="{{Storage::url($res['filepath'])}}">
                                                                                        <span class="badge badge-center bg-primary">{{$res['pay_system']}}
                                                                                        </span>
                                                                                        {{$res['day_time']}}
                                                                                    </a>
                                                                                </h6>
                                                                            @endforeach
                                                                        @else
                                                                        <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            <br><br><br><br><br>
                                                                        </h6>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endfor
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
