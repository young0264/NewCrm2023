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
                <div class="col-md-3">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->
                            <h5 class="card-header text-center">고객 검색</h5>
                            <div class="card-body">
                                <div class="form-floating">
                                    <div class="mb-3">
                                        <div class="demo-inline-spacing">
                                            <div class="btn-group col-md-12">
                                                <div class="col-md-4">
                                                    <select class="form-select">
                                                        <option>결제수단</option>
                                                        <option>카드</option>
                                                        <option>현금</option>
                                                        <option>후불</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-select">
                                                        <option>신탁여부</option>
                                                        <option>신탁</option>
                                                        <option>비신탁</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-select">
                                                        <option>통합</option>
                                                        <option>통합1</option>
                                                        <option>통합2</option>
                                                    </select>
                                                </div>
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
                                    <button type="button" class="btn btn-secondary">전체로드</button>
                                    <button type="button" class="btn btn-secondary">미등록만</button>
                                    <button type="button" class="btn btn-primary">청구&gt;</button>
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

                                <div class="form-floating col-md-4">
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
                                    <button type="button" class="btn btn-danger me-4"> &lt;청구 해제</button>
                                    <button type="button"
                                            class="btn btn-warning me-4"
                                            data-bs-toggle="modal"
                                            data-bs-target="#mocal_setting1">청구 설정 </button>
                                </div>
                            </div>
{{--                            모달시작--}}
                            <div class="modal fade" id="mocal_setting1" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="fw-bold py-3 mb-4">청구 대상 등록 설정</h3>
                                        </div>
                                            <div class="modal-body">
                                                <h5>정기적인 계산서 발행을 위해 청구 대상을 등록합니다.</h5>
                                                <h5>서비스 이용료나 공연보상금 등 품목과 계산서 종류를 </h5>
                                                <h5>설정할 수 있습니다.</h5>
                                                <div>
                                                    <h5 class="fw-bold">선택된 청구 <span class="alert alert-secondary">2건</span></h5>
                                                </div>

                                            </div>

{{--                                            <button--}}
{{--                                                type="button"--}}
{{--                                                class="btn-close"--}}
{{--                                                data-bs-dismiss="modal"--}}
{{--                                                aria-label="Close"--}}
{{--                                            ></button>--}}




                                        <div class="modal-body">
                                            <div class="card-body">
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
                                                    <div class="form-control btn-group row alert alert-secondary ">
                                                        <div class="col-md-6">
                                                            <label class="btn-group col-form-label">음저협</label>
                                                            <div class="btn-group col-md-6">
                                                                <input class="form-control">
                                                                <input class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">

                                                        <label class="btn-group col-form-label">음실련</label>
                                                            <div class="btn-group col-md-6 mx-4">
                                                                <input class="form-control">
                                                                <input class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="btn-group col-form-label">함저협</label>
                                                            <div class="btn-group col-md-6">
                                                                <input class="form-control">
                                                                <input class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">

                                                        <label class="btn-group col-form-label">연제협</label>
                                                            <div class="btn-group col-md-6 mx-4">
                                                                <input class="form-control">
                                                                <input class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 style="border: 1px dashed #bbb; "></h5>
                                                    </div>

                                                    <div class="btn-group">
                                                        <div class="col-md-6 ">
                                                            <div class="form-check form-switch mb-2">
                                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked />
                                                                <label class="form-check-label" for="flexSwitchCheckChecked"> 이용료 분할 / (세금)계산서 (일반)</label>
                                                            </div>

                                                            <div class="btn-group">
                                                                <label>품목1</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" placeholder="이용료">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" placeholder="이용료">
                                                                </div>
                                                            </div>
                                                            <div class="btn-group">
                                                                <label>품목2</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" placeholder="이용료">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" placeholder="이용료">
                                                                </div>
                                                            </div>
                                                            <div class="btn-group">
                                                                <label>품목3</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" placeholder="이용료">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" placeholder="이용료">
                                                                </div>
                                                            </div>
                                                            <div class="btn-group">
                                                                <label>품목4</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" placeholder="이용료">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" placeholder="이용료">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div >
                                                            <div class="btn btn-warning">
                                                                <h3 class="fw-bold">세금계산서 2건</h3>
                                                                <h5>이용료 세금계산서</h5>
                                                                <h5>연제협 공연보상금 세금계산서</h5>


                                                                <h3 class="fw-bold">계산서 3건</h3>
                                                                <h5>음저협 공연사용료 세금계산서</h5>
                                                                <h5>함저협 공연사용료 세금계산서</h5>
                                                                <h5>음실련 공연보상금 세금계산서</h5>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>



                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <div class=" gap-2 col-lg-4 mx-auto">
                                                <button type="button" class="btn btn-primary"> 신규등록</button>
                                                <button type="button" class="btn btn-secondary"> 취소</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--                            모달끝--}}
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
