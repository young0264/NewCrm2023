{{--청구 대상 등록--}}
@extends('layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">정산 / 이용료 청구 / </span>청구 대상 등록
        </h4>

        <div class="form-floating">
            <div class="row">

                {{--            content left        --}}
                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->
                            <h5 class="card-header text-center" style="color: cornflowerblue">고객 검색</h5>

                            <div class="card-body">

                                <div class="form-floating">
                                    <div class="mb-3">
                                        <div class="demo-inline-spacing">
                                    <div class="btn-group">
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >결제수단
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">카드</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">현금</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">후불</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider"/>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >신탁여부
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">신탁</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">비신탁</a></li>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider"/>
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            통합
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">통합</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">통합1</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">통합2</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider"/>
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                                        </ul>
                                    </div>
                                </div>
                                    </div>
                                </div>

                                <div class="form-floating">
                                    <div class="mb-3">
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="exampleFormControlReadOnlyInput1"
                                            placeholder="검색어를 입력하세요."
                                            readonly
                                        />
                                    </div>
                                </div>

                                <div class="form-floating">
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-secondary me-4">전체로드</button>
                                        <button type="button" class="btn btn-secondary me-4">미등록만</button>
                                        <button type="button" class="btn btn-primary">청구></button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless border-bottom">
                                    <thead>
                                    <tr>
                                        <th class="text-nowrap text-center">점포코드</th>
                                        <th class="text-nowrap text-center">브랜드</th>
                                        <th class="text-nowrap text-center">매장명</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    <tr class="text-center">
                                        <td class="text-nowrap">7323231A</td>
                                        <td>더벤티</td>
                                        <td>가산테라타</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">7323231A</td>
                                        <td>더벤티</td>
                                        <td>가산테라타</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">7323231A</td>
                                        <td>더벤티</td>
                                        <td>가산테라타</td>

                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">7323231A</td>
                                        <td>더벤티</td>
                                        <td>가산테라타</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="col-md" style="text-align: center">
                                    <div class="demo-inline-spacing">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Notifications -->
                        </div>
                    </div>
                </div>

                {{--            content right        --}}
                <div class="col-md-8">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->
                            <h5 class="card-header text-center" style="color: cornflowerblue">청구 대상</h5>
                            <div class="card-body">

                                <div class="form-floating">
                                    <div class="mb-3">
                                        <div class="demo-inline-spacing">
                                    <div class="btn-group">
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >결제수단
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">카드</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">현금</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">후불</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider"/>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >신탁여부
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">신탁</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">비신탁</a></li>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider"/>
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            통합
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">통합</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">통합1</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">통합2</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider"/>
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                                        </ul>
                                    </div>
                                </div>
                                    </div>
                                </div>

                                <div class="form-floating">
                                    <div class="mb-3">
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="exampleFormControlReadOnlyInput1"
                                            placeholder="검색어를 입력하세요."
                                            readonly
                                        />
                                    </div>
                                </div>

                                <div class="form-floating">
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-danger me-4"> &lt;청구 해제</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless border-bottom">
                                    <thead>
                                    <tr>
                                        <th class="text-nowrap text-center">점포코드</th>
                                        <th class="text-nowrap text-center">브랜드</th>
                                        <th class="text-nowrap text-center">매장명</th>
                                        <th class="text-nowrap text-center">사업자번호</th>
                                        <th class="text-nowrap text-center">결제방식</th>
                                        <th class="text-nowrap text-center">결제주기</th>
                                        <th class="text-nowrap text-center">단가</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    <tr class="text-center">
                                        <td class="text-nowrap">7323231A</td>
                                        <td>더벤티</td>
                                        <td>가산테라타</td>
                                        <td>123-123-123</td>
                                        <td>CMS</td>
                                        <td>월납</td>
                                        <td>1,200</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">7323231A</td>
                                        <td>더벤티</td>
                                        <td>가산테라타</td>
                                        <td>123-123-123</td>
                                        <td>CMS</td>
                                        <td>월납</td>
                                        <td>1,200</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">7323231A</td>
                                        <td>더벤티</td>
                                        <td>가산테라타</td>
                                        <td>123-123-123</td>
                                        <td>CMS</td>
                                        <td>월납</td>
                                        <td>1,200</td>

                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">7323231A</td>
                                        <td>더벤티</td>
                                        <td>가산테라타</td>
                                        <td>123-123-123</td>
                                        <td>CMS</td>
                                        <td>월납</td>
                                        <td>1,200</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="col-md" style="text-align: center">
                                    <div class="demo-inline-spacing">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Notifications -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
