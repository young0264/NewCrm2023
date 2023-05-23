{{--비회원 청구 대상 등록--}}
@extends('layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4" >
            <span class="text-muted fw-light">정산 / 이용료 청구 / </span>비회원 청구 대상 등록
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
                                <div class="error"></div>
                            </div>
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
                                <div class="form-floating ">
                                    <div class="mb-3">
                                        <button class="btn btn-primary btn-lg" type="button">비회원 청구 매장 불러오기&gt;</button>
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
                                <div class="error"></div>
                            </div>
                            <div class="card-body">
                                <div class="form-floating">
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-danger"> &lt;청구 해제</button>
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalCharge2"
                                            style="float:right"
                                        >신규등록</button>

                                        {{--     XL 모달      --}}
                                        <div class="modal fade" id="modalCharge2" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="fw-bold py-3 mb-4">
                                                            <span class="text-muted fw-light"></span>비회원 청구 대상 신규 등록
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <h5 style="color: cornflowerblue">대표 회원 정보</h5>
                                                            <div class="card bg-secondary text-white mb-3">

                                                                <div class="card-body">
                                                                    <div class="col-md-12">

                                                                        <div class=" btn-group col-md-3">
                                                                            <label class="col-md-2 col-form-label mb-3" style="color: black">아이디</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder="73212315A"
                                                                                       id="html5-text-input"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="btn-group col-md-3">
                                                                            <label class="col-md-2 col-form-label mb-3" style="color: black">브랜드</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder="더벤티"
                                                                                       id="html5-text-input"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="btn-group col-md-3">
                                                                            <label class="col-md-2 col-form-label mb-3" style="color: black">지점명</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder="가산테라타"
                                                                                       id="html5-text-input"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="card-body">
                                                                        <div class="mb-3 row">
                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3" style="color: black">매장명</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="매장명" id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">상호명</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="상호명"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">대표자명</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="대표자명"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">사업자번호</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="사업자번호"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">주소</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="주소"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">발행주소1</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="발행주소1"
                                                                                       id="html5-text-input"/>
                                                                            </div>
                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">발행주소2</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="발행주소2"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label">단가</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="단가"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="card-body">
                                                                        <div class="mb-3 row">

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">담당자1</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="담당자1"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">연락처1</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="연락처1"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">담당자 이메일1</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="담당자 이메일1"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">담당자2</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="담당자2"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">연락처2</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="연락처2"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">담당자 이메일2</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="담당자 이메일2"
                                                                                       id="html5-text-input"/>
                                                                            </div>
                                                                            <label for="html5-text-input" class="col-md-2 col-form-label mb-3">비고</label>
                                                                            <div class="col-md-10">
                                                                                <input class="form-control" type="text" placeholder="비고"
                                                                                       id="html5-text-input"/>
                                                                            </div>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="demo-inline-spacing">
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <button
                                                                                    type="button"
                                                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false"
                                                                                >업태
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">업태1</a></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">업태2</a></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">업태3</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <hr class="dropdown-divider"/>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <button
                                                                                    type="button"
                                                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    업종
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">업종1</a></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">업종2</a></li>
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">업종3</a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <hr class="dropdown-divider"/>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <button
                                                                                    type="button"
                                                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    결제수단
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">결제수단1</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <button
                                                                                    type="button"
                                                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    결제주기
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">결제주기</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <button
                                                                                    type="button"
                                                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    내역
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">내역</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <button
                                                                                    type="button"
                                                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    회신
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">회신</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <button
                                                                                    type="button"
                                                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    거래명세서
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">거래명세서</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <button
                                                                                    type="button"
                                                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    세금계산서
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">세금계산서</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <button
                                                                                    type="button"
                                                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    발행날짜
                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <li><a class="dropdown-item" href="javascript:void(0);">발행날짜</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class=" gap-2 col-lg-4 mx-auto">
                                                            <button type="button" class="btn btn-primary"> 신규등록</button>
                                                            <button type="button" class="btn btn-secondary"> 취소</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
