{{--@php--}}
{{--    $arr = array(--}}
{{--        "Q"=>array(--}}
{{--            0,1,2--}}
{{--        ),--}}
{{--        "H"=>array(--}}
{{--            0,1,2,3,4,5--}}
{{--        ),--}}
{{--        "Y"=>array(--}}
{{--            0,1,2,3,4,5,6,7,8,9,10,11--}}
{{--        ),--}}
{{--    );--}}
{{--@endphp--}}
<?php
    $pay_interval_arr = array(
        "M"=>0,
        "Q"=>2,
        "H"=>5,
        "Y"=>11,
        "T"=>3,
    );
    ?>
<script>
    const loginId = null;

    function interval_option() {
        alert(111222);
        let f_pay_interval = document.getElementById("f_pay_interval").value;
       let f_interval_option = document.getElementById("f_interval_option");
        // let f_interval_option = document.querySelector("#f_interval_option");
        let pay_interval_arr = {"M":0, "Q":2, "H":5, "Y":11, "T":3 };
        let html = "";
        console.log("f_pay_interval : " + f_pay_interval);
        console.log("f_interval_option : " + f_interval_option);

        for (let i = 0; i <= pay_interval_arr[f_pay_interval]; i++) {
            html += `<option>${i.toString().padStart(2, '0')}</option>`;
        }

        f_interval_option.innerHTML = html;
    }

    let register = {
        BillFormRegister: function () {
            let method = "POST";
            let url = "{{route("billRegisterProcess")}}";
            let data = $('#billForm').serialize();
            let dataType = "json";
            console.log("data : " + data);

            js.ajax_call(method, url, data, dataType, true);

            $('#modal_setting_register').modal('hide');
            window.location.reload();
        },
    };

    let checkbox = {
        // (input.checkbox : id값 , 숨길 div : id값)
        showByChecked: function (checkboxId, isShowDivId) {
            if (this.isChecked(checkboxId)) {
                document.getElementById(isShowDivId).style.display = "block";
            } else {
                document.getElementById(isShowDivId).style.display = "none";
            }
        },

        isChecked: function (checkboxId) {
            var con = document.getElementById(checkboxId);
            return !!con.checked;
        },
    };
</script>

{{-- 청구 대상 등록 설정 모달 시작--}}
<div class="modal fade" id="modal_setting_register" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fw-bold ">청구 대상 등록 설정</h3>
            </div>
            <div class="modal-body">
                <h5 class="row mx-3">서비스 이용료나 공연권료 등 생성할 품목과 계산서 종류를 설정합니다. </h5>
                <form id="billForm" name="billForm">
                    {{-- 상단 공연정보 시작 --}}
                    <div class="card-body">
                        <div class="btn-group my-2">
                            <label class="btn-group fw-bold ">발행일</label>
                            <div class=" col-md-4 mx-2">
                                {{--                                                        <label class="btn-group fw-bold ">발행일</label>--}}
                                {{--                                                        <h6>발행일</h6>--}}
                                <input class="form-control alert-warning" id="f_issuedate" name="f_issuedate"
                                       placeholder="작성일자">
                            </div>
                            <div class="col-sm-2 mx-2">
                                <select class="form-select alert-info text-black fw-bold" id="f_tax_issue" name="f_tax_issue">
                                    <option value="normal">계산서</option>
                                    <option value="cash">현금영수증</option>
                                </select>
                                {{--                                <select id="f_tax_issue" name="f_tax_issue" class="btn btn-dark ">--}}
                                {{--                                    --}}
                                {{--                                </select>--}}
                            </div>
                            <div class="col-sm-2 mx-2">
                                <input class="form-control" id="f_opendate" name="f_opendate" placeholder="매장오픈일">
                            </div>
                            <div class="col-sm-2 mx-2">
                                <input class="form-control" id="f_closedate" name="f_closedate" placeholder="매장폐점일">
                            </div>
                        </div>
                        <div class="btn-group my-2">
                            {{--                            --}}
                            <div class=" col-sm-2 mx-4">
                                <select id="f_village" name="f_village" class="form-select text-black">
                                    <option value="">농어촌</option>
                                    <option value="farm">농촌</option>
                                    <option value="fishing">어촌</option>
                                </select>
                            </div>
                            <label >공연권료</label>
                            <div class=" col-sm-2 mx-4 text-black ">
                                <input class="form-control" id="f_pf_price" name="f_pf_price" placeholder="공연권료">
                                {{--                                <input class="form-control " id="f_tax_type" value="03?" placeholder="4,000">--}}
                            </div>
                            <label class="mx-2">면적</label>
                            <div class=" col-sm-1 text-black">
                                <input class="form-control" id="f_pyung" name="f_pyung" placeholder="60">
                            </div>
                            <span class="text-muted">(㎡)</span>
                        </div>
                    </div>
                    {{--                    @if(Auth::check())--}}
                    {{--                        {{Auth::user()->email}}--}}
                    {{--                    @endif--}}
                    {{--                    <input type="hidden" id="f_loginid" name="f_loginid" value="{{Auth::user()->email}}">--}}

                    @if(Auth::check() && !empty(Auth::user()->id))
                        <input type="hidden" id="f_loginid" name="f_loginid" value="{{ Auth::user()->id}}">
                    @endif

                    {{-- 공연정보 끝 --}}
                    {{-- 계산서 기본데이터 Form 시작 --}}
                    <h5 style="border: 1px dashed #bbb; "></h5>
                    <div class="card-body row">
                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                매장명
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_shopname" name="f_shopname"
                                       placeholder="매장명">
                            </div>
                            <div class="col-md-1 mx-2">
                                <span></span>
                            </div>
                            {{--                            업종? --}}
                            <div class="col-md-3">
                                <select class="form-select alert-info text-black fw-bold" id="f_cb" name="f_cb">
                                    <option value="">업종</option>
                                    <option value="COFFEE">커피</option>
                                    <option value="HEALTH">헬스장</option>
                                    <option value="COFFEE">커피</option>
                                </select>
                            </div>
                            <div class="col-md-3 mx-2 ">
                                <select class="form-select alert-info text-black fw-bold" id="f_business"
                                        name="f_business">
                                    <option value="">업태</option>
                                    <option value="업태option">업태option</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                상호명
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-warning" id="f_cp_name" name="f_cp_name"
                                       placeholder="상호명">
                            </div>
                            <div class="col-md-1 mx-2 nav-align-right" >
                                담당자1
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_name1" name="f_name1"
                                       placeholder="담당자1">
                            </div>
                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_pay_type" name="f_pay_type">
                                    <option value="">결제수단</option>
                                    <option value="BANKBOOK">무통장</option>
                                    <option value="CMS">카드</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                대표자명
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-warning" id="f_rep_name" name="f_rep_name"
                                       placeholder="대표자명">
                            </div>

                            <div class="col-md-1 mx-2 float-end nav-align-right">
                                연락처1
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary " id="f_mobile1" name="f_mobile1"
                                       placeholder="연락처1">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_pay_interval"
                                        name="f_pay_interval" onchange="interval_option(this.value)">
                                    <option value="">결제주기</option>
                                    <option value="M">월납</option>
                                    <option value="Q">분기납</option>
                                    <option value="T">삼기납</option>
                                    <option value="H">반기납</option>
                                    <option value="Y">연납</option>
                                    <option value="E">기타</option>
                                </select>
                            </div>
                            <select class="form-select-sm bg-label-secondary" id="f_interval_option" name="f_interval_option">
                            </select>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                사업자번호
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-warning" id="f_registration_number"
                                       name="f_registration_number" placeholder="사업자번호">
                            </div>

                            <div class="col-md-1 mx-2 nav-align-right">
                                이메일1
                            </div>
                            <div class="col-md-3 alert-secondary">
                                <input class="form-control alert-secondary" id="f_email1" name="f_email1"
                                       placeholder="이메일1">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_history" name="f_history">
                                    <option value="">내역</option>
                                    <option value="내역2">내역2</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                주소
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_addr" name="f_addr" placeholder="주소">
                            </div>

                            <div class="col-md-1 mx-2 nav-align-right">
                                담당자2
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_name2" name="f_name2"
                                       placeholder="담당자2">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_reply" name="f_reply">
                                    <option value="">회신</option>
                                    <option value="회신2">회신2</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1 ">
                                발행주소1
                            </div>
                            <div class="col-md-3">
                                <input class="form-control  alert-secondary" id="f_public_addr1" name="f_public_addr1"
                                       placeholder="발행주소1">
                            </div>

                            <div class="col-md-1 mx-2 nav-align-right">
                                연락처2
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_mobile2" name="f_mobile2"
                                       placeholder="연락처2">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_statement" name="f_statement">
                                    <option value="">거래명세서</option>
                                    <option value="거래명세서2">거래명세서2</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                발행주소2
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_public_addr2" name="f_public_addr2"
                                       placeholder="발행주소2">
                            </div>

                            <div class="col-md-1 mx-2 nav-align-right">
                                이메일2
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_email2" name="f_email2"
                                       placeholder="이메일2">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_tax_bill" name="f_tax_bill">
                                    <option value="">세금계산서</option>
                                    <option value="세금계산서2">세금계산서2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- 계산서 기본데이터 form 끝 --}}
                    <div class="card-body">
                        {{-- 공연권료 / (세금)계산서 (위수탁) 시작 --}}
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox"
                                   id="tax_type0306" name="tax_type0306"
                                   onclick="checkbox.showByChecked('tax_type0306', 'showByCheckedDiv1')" checked/>
                            <span class="form-check-label fw-bold  text-black"
                            >공연권료 / (세금)계산서 (위수탁)</span>
                        </div>
                        <div id="showByCheckedDiv1" class="form-control row alert alert-secondary">
                            @foreach (\App\Helpers\Common::assoArr() as $key => $val)
                                <div class="row my-1">
                                    <div class="col-md-1 text-black fw-bold">{{$val['name']}}</div>
                                    <div class="col-md-2">
                                        <input class="form-control text-black" id="f_product1_{{strtolower($key)}}"
                                               name="f_product1_{{strtolower($key)}}" placeholder="{{$val['product']}}">
                                    </div>
                                    <div class="col-md-2 ">
                                        <input class="form-control alert-warning text-black"
                                               id="f_unitprice_{{strtolower($key)}}"
                                               name="f_unitprice_{{strtolower($key)}}" placeholder="1,960">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select alert-warning text-black fw-bold"
                                                id="f_issue_type_{{strtolower($key)}}"
                                                name="f_issue_type_{{strtolower($key)}}">
                                            <option value="">F_ISSUE_TYPE</option>
                                            <option value="01">영수(01)</option>
                                            <option value="02">청구(02)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input id="f_bigo1_{{strtolower($key)}}" name="f_bigo1_{{strtolower($key)}}"
                                               class="form-control" placeholder="품목비고1">
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" id="f_bigo_{{strtolower($key)}}"
                                               name="f_bigo_{{strtolower($key)}}" placeholder="비고">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- 공연권료 / (세금)계산서 (위수탁) 끝 --}}

                        {{-- 이용료 분할 / (세금)계산서 (일반) 시작  --}}
                        <div class="form-check btn-group form-switch mb-2 ">
                            <div class="col-md-12">
                                {{--                                <input id="showChecked2" class="form-check-input" type="checkbox" checked/>--}}
                                {{--                                <input id="showChecked2" class="form-check-input" type="checkbox"--}}
                                {{--                                       onclick="checkbox.showByChecked('showChecked2', 'showCheckedDiv2')" checked/>--}}
                                {{--                                <label class="form-check-label fw-bold text-black">이용료 분할 / (세금)계산서 (일반)</label>--}}

                                <input class="form-check-input" type="checkbox"
                                       id="tax_type01" name="tax_type01"
                                       onclick="checkbox.showByChecked('tax_type1', null)" checked/>
                                <label class="form-check-label fw-bold text-black">이용료 분할 / (세금)계산서 (일반)</label>

                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-10 float-end">
                                <input id="f_bigo" name="f_bigo" class="form-control alert-info" placeholder="비고">
                            </div>
                        </div>
                        <div id="showCheckedDiv2" class="form-control btn-group row alert alert-secondary">
                            @for ($i=1; $i<=4; $i++)
                                <div class="row my-1">
                                    <div class="col-md-1 text-black fw-bold">품목{{$i}}</div>
                                    <div class="col-md-2">
                                        <input class="form-control" id="f_product{{$i}}" name="f_product{{$i}}"
                                               placeholder="이용료">
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control alert-warning" id="f_unitprice{{$i}}"
                                               name="f_unitprice{{$i}}" placeholder="단가{{$i}}">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select alert-warning text-black fw-bold"
                                                id="f_issue_type_prod{{$i}}" name="f_issue_type_prod{{$i}}">
                                            <option value="">F_ISSUE_TYPE</option>
                                            <option value="01">영수(01)</option>
                                            <option value="02">청구(02)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control alert-info" id="f_bigo{{$i}}" name="f_bigo{{$i}}"
                                               placeholder="품목비고1">
                                    </div>
                                </div>
                            @endfor
                        </div>
                        {{-- 이용료 분할 / (세금)계산서 (일반) 끝  --}}
                    </div>

                    <div class="card-body">
                        <div class="btn-group">
                            <div class="col-md-12">
                                <label>
                                    <input class="form-check-input me-1" type="checkbox">계산서 즉시 생성
                                </label>
                            </div>
                            <div class="col-md-6 text-center mx-1">
                                @csrf
                                <input class="hidden" type="hidden" id="mode" name="mode" value="insert">
                                <button type="button" class="btn btn-primary" onclick="register.BillFormRegister()"> 신규등록
                                </button>
                                <button type="button" class="btn btn-secondary" id="modalCloseBtn"
                                        onclick="modalClose('modal_setting_register')"> 닫기
                                </button>
                            </div>

                            <div class="col-md-11 float-end">
                                <button type="button" class="btn btn-success float-end "> 중복내역
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--                            모달끝--}}
