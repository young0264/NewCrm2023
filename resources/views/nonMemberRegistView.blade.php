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
                            <h5 class="card-header text-center text-primary" >고객 검색</h5>
                            <div class="card-body">
                                <div class="error"></div>
                            </div>
                            <div class="card-body">

                                <div class="form-floating">
                                    <div class="mb-3">
                                        <div class="demo-inline-spacing">
                                            <div class="btn-group">
                                                <select class="form-select">
                                                    <option>결제수단</option>
                                                    <option>카드</option>
                                                    <option>현금</option>
                                                    <option>후불</option>
                                                </select>
                                            </div>
                                            <div class="btn-group">
                                                <select class="form-select">
                                                    <option>신탁여부</option>
                                                    <option>신탁</option>
                                                    <option>비신탁</option>
                                                </select>
                                            </div>
                                            <div class="btn-group">
                                                <select class="form-select">
                                                    <option>통합</option>
                                                    <option>통합1</option>
                                                    <option>통합2</option>
                                                </select>
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
                                <table class="table table-hover border-bottom">
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
                                                            <h5 class="text-primary">대표 회원 정보</h5>
                                                            <div class="alert alert-primary text-white mb-3">

                                                                <div class="card-body">
                                                                    <div class="col-md-12">

                                                                        <div class=" btn-group col-md-3">
                                                                            <label class="col-md-2 col-form-label mb-3 text-dark">아이디</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder="아이디"
                                                                                       id="html5-text-input"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="btn-group col-md-3">
                                                                            <label class="col-md-2 col-form-label mb-3 text-dark" >브랜드</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder="브랜드"
                                                                                       id="html5-text-input"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="btn-group col-md-3">
                                                                            <label class="col-md-2 col-form-label mb-3 text-dark">지점명</label>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control" type="text" placeholder="지점명"
                                                                                       id="html5-text-input"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-check form-switch mb-2">
                                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked />
                                                                <label class="form-check-label" for="flexSwitchCheckChecked"
                                                                >공연권료 / (세금)계산서 (위수탁)</label
                                                                >
                                                            </div>
                                                            <div class="card-body">

                                                            <div class="form-control row alert alert-secondary ">

                                                                    <div class="btn-group col-md-4">
                                                                        <div class="row my-3 ">
                                                                            <div class="col-md-3">
                                                                                <span class="col-form-label">면적</span>
                                                                            </div>
                                                                            <div class="col-md-7">
                                                                                <input class="form-control" placeholder="영업장면적">
                                                                            </div>(㎡)

                                                                            <div class="col-md-3">
                                                                                <span class="col-form-label">납부금액</span>
                                                                            </div>
                                                                            <div class="col-md-7">
                                                                                <input class="form-control" placeholder="납부금액">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="btn-group row col-md-2 align-bottom">
                                                                        <span class="text-muted">음저협</span>

                                                                        <input class="form-control" placeholder="음저협">
                                                                    </div>

                                                                    <div class="btn-group row col-md-2 align-bottom">
                                                                        <span class="text-muted">함저협</span>
                                                                        <input class="form-control" placeholder="함저협">
                                                                    </div>

                                                                    <div class="btn-group row col-md-2 align-bottom">
                                                                        <div>
                                                                            <select class="form-select align-top">
                                                                                <option>업종</option>
                                                                                <option>업종1</option>
                                                                                <option>업종2</option>
                                                                            </select>
                                                                        </div>
                                                                        <span class="text-muted">음실련</span>
                                                                        <input class="form-control" placeholder="음실련">
                                                                    </div>
                                                                    <div class="btn-group row col-md-2 align-bottom">
                                                                        <div>
                                                                            <select class="form-select align-top">
                                                                                <option>농어촌</option>
                                                                                <option>농촌1</option>
                                                                                <option>어촌1</option>
                                                                            </select>
                                                                        </div>
                                                                        <span class="text-muted">연제협</span>
                                                                        <input class="form-control" placeholder="연제협">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="card-body">
                                                                        <div class="mb-3 row">
                                                                            <div class="row my-2">
                                                                                <div class="col-md-3">
                                                                                    <span  class="col-md-2 col-form-label mb-3">매장명</span>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input class="form-control" type="text" placeholder="매장명" id="html5-text-input"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row my-2">
                                                                                <div class="col-md-3">
                                                                                    <span  class="col-md-2 col-form-label mb-3">상호명</span>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input class="form-control" type="text" placeholder="상호명"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row my-2">
                                                                                <div class="col-md-3">
                                                                                    <span  class="col-md-2 col-form-label mb-3">대표자명</span>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input class="form-control" type="text" placeholder="대표자명"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row my-2">
                                                                                <div class="col-md-3">
                                                                                    <span  class="col-md-2 col-form-label mb-3">사업자번호</span>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input class="form-control" type="text" placeholder="사업자번호"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>


                                                                            <div class="row my-2">
                                                                                <div class="col-md-3">
                                                                                    <span  class="col-md-2 col-form-label mb-3">주소</span>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input class="form-control" type="text" placeholder="주소"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row my-2">
                                                                                <div class="col-md-3">
                                                                                    <span  class="col-md-2 col-form-label mb-3">발행주소1</span>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input class="form-control" type="text" placeholder="발행주소1"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row my-2">
                                                                                <div class="col-md-3">
                                                                                    <span  class="col-md-2 col-form-label mb-3">발행주소2</span>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input class="form-control" type="text" placeholder="발행주소2"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row my-2">
                                                                                <div class="col-md-3">
                                                                                    <span  class="col-md-2 col-form-label mb-3">발행주소2</span>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input class="form-control" type="text" placeholder="단가"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="card-body">
                                                                        <div class="mb-3 row">

                                                                            <div class="row my-2">
                                                                                <div class="col-md-4">
                                                                                    <span  class="col-md-2 col-form-label mb-3">담당자1</span>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input class="form-control" type="text" placeholder="담당자1"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row my-2">
                                                                                <div class="col-md-4">
                                                                                    <span  class="col-md-2 col-form-label mb-3">연락처1</span>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input class="form-control" type="text" placeholder="연락처1"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row my-2">
                                                                                <div class="col-md-4">
                                                                                    <span  class="col-md-2 col-form-label mb-3">담당자 이메일1</span>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input class="form-control" type="text" placeholder="담당자 이메일1"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row my-2">
                                                                                <div class="col-md-4">
                                                                                    <span  class="col-md-2 col-form-label mb-3">담당자2</span>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input class="form-control" type="text" placeholder="담당자2"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row my-2">

                                                                                <div class="col-md-4">
                                                                                    <span  class="col-md-2 col-form-label mb-3">연락처2</span>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input class="form-control" type="text" placeholder="연락처2"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row my-2">
                                                                                <div class="col-md-4">
                                                                                    <span  class="col-md-2 col-form-label mb-3">담당자 이메일2</span>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input class="form-control" type="text" placeholder="담당자 이메일2"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row my-2">
                                                                                <div class="col-md-4">
                                                                                    <span  class="col-md-2 col-form-label mb-3">비고</span>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input class="form-control" type="text" placeholder="비고"
                                                                                           id="html5-text-input"/>
                                                                                </div>
                                                                            </div>

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="demo-inline-spacing">
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <select class="form-select">
                                                                                    <option>업태</option>
                                                                                    <option>업태1</option>
                                                                                    <option>업태2</option>
                                                                                    <option>업태3</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <select class="form-select">
                                                                                    <option>업종</option>
                                                                                    <option>업종1</option>
                                                                                    <option>업종2</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <select class="form-select">
                                                                                    <option>결제수단</option>
                                                                                    <option>결제수단1</option>
                                                                                    <option>결제수단2</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <select class="form-select">
                                                                                    <option>결제주기</option>
                                                                                    <option>결제주기1</option>
                                                                                    <option>결제주기2</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <select class="form-select">
                                                                                    <option>내역</option>
                                                                                    <option>내역1</option>
                                                                                    <option>내역2</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <select class="form-select">
                                                                                    <option>회신</option>
                                                                                    <option>회신1</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <select class="form-select">
                                                                                    <option>거래명세서</option>
                                                                                    <option>거래명세서1</option>
                                                                                    <option>거래명세서2</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <select class="form-select">
                                                                                    <option>세금계산서</option>
                                                                                    <option>세금계산서1</option>
                                                                                    <option>세금계산서2</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group">
                                                                                <select class="form-select">
                                                                                    <option>발행날짜</option>
                                                                                    <option>발행날짜1</option>
                                                                                    <option>발행날짜2</option>
                                                                                </select>
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
                                <table class="table table-hover border-bottom">
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
