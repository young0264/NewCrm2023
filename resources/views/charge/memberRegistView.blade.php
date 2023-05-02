{{--청구 대상 등록--}}
@extends('layouts.app')
@section('content')
    <script type="text/javascript">

        document.addEventListener("DOMContentLoaded", ()=>{
            tables.initialize();
        });

        let tables = {
            headers: null,
            items: null,
            dataset: [],

            initialize:function(){
                this.set();
                this.onDraw();
            },

            set:function(){
                let method = "POST";
                let url = "{{route("billList")}}";
                let datas = {
                };
                let dataType = "json";
                let ret = js.ajax_call(method, url, datas, dataType, false, "", true);

                this.headers = JSON.parse(ret['header']);
                this.items = JSON.parse(ret['items']);

                // 전체 데이터를 받아서, 각각의 셀렉트 옵션에 데이터처리
                this.setDataset();
            },

            setDataset:function() {
                this.headers.forEach((item, idx)=> {
                    this.dataset[item.key] = [];
                });

                this.items.forEach((item, idx)=>{
                    this.headers.forEach((header, header_idx)=>{
                        if (this.dataset[header.key][item[header.key]] === undefined)
                            this.dataset[header.key][item[header.key]] = [];

                        if (item[header.key]!==null)
                            this.dataset[header.key][item[header.key]] = "";
                    });
                });
            },

            onDraw:function() {
                // this.onDrawHeader();
                this.onDrawBody();
            },

            onDrawHeader:function() {

                /**
                 * Thead
                 * @type {string}
                 */
                let html = "<tr>";
                console.log(this.headers);
                this.charge_thead.forEach((col_name, idx)=> {
                    this.headers.forEach((value, idx2) => {
                        if (value.key === col_name) {
                            html += `<td class="text-nowrap text-center">${value.name}</td>`;
                            return;
                        }
                    });
                });

                html += "</tr>";

                document.querySelector("#charge_thead").innerHTML = html;
            },

            onDrawBody:function() {
                /**
                 * 바디에 데이터셋 입력 처리
                 * @type {string}
                 */

                let html = "";

                this.items.forEach((item, idx) => {
                    html += `<tr class="text-center">`
                    html += `<td class="text-nowrap">${item['f_minor_business']}</td>`
                    html += `<td class="text-nowrap">${item['f_bizname']}</td>`
                    html += `<td class="text-nowrap">${item['f_shopname']}</td>`
                    html += `<td class="text-nowrap">${item['f_registration_number']}</td>`
                    html += `<td class="text-nowrap">${item['f_pay_type']}</td>`
                    html += `<td class="text-nowrap">${item['f_pay_interval']}</td>`
                    html += `<td class="text-nowrap">${item['f_price']}</td>`
                });
                document.querySelector("#charge_tbody").innerHTML = html;
            },
        };


        {{--    체크박스 스위치버튼 isCheck에 따른 div 노출 유무     --}}
        let checkbox = {
            // (input.checkbox : id값 , 숨길 div : id값)
            showByChecked: function (checkboxId, isShowDivId) {
                console.log(checkboxId, isShowDivId);
                if (this.isChecked(checkboxId)) {
                    document.getElementById(isShowDivId).style.display="block";
                }else{
                    document.getElementById(isShowDivId).style.display="none";
                }
            },

            isChecked: function (checkboxId) {
                var con = document.getElementById(checkboxId);
                return !!con.checked;
            },
        }
    </script>

    {{-- 청구 대상 등록 설정 모달 시작--}}
    <div class="modal fade" id="mocal_setting1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="fw-bold ">청구 대상 등록 설정</h3>
                </div>

                <div class="modal-body">
                    <h5 class="row mx-3">서비스 이용료나 공연권료 등 생성할 품목과 계산서 종류를 설정합니다. </h5>

                    <div class="card-body">
                        <div class="btn-group">
                            <label class="btn-group fw-bold ">발행일</label>
                            <div class=" col-md-2 mx-1">
                                {{--                                                        <label class="btn-group fw-bold ">발행일</label>--}}
                                {{--                                                        <h6>발행일</h6>--}}
                                <input class="form-control alert-warning" id="f_issuedate" placeholder="작성일자">
                            </div>
                            <div class="col-sm-2 mx-1">
                                <select id="f_tax_type" class="btn btn-dark ">
                                    <option>계산서</option>
                                    <option>현금영수증</option>
                                </select>
                            </div>
                            <div class=" col-sm-2 mx-1">
                                <select class="form-select text-black">
                                    <option>농어촌</option>
                                    <option>농촌</option>
                                    <option>어촌</option>
                                </select>
                            </div>
                            <label class="mx-2">공연권료</label>
                            <div class=" col-sm-1 mx-1 text-black ">
                                <input class="form-control " id="F_TAX_TYPE" value="03?" placeholder="4,000">
                            </div>
                            <label class="mx-2">면적</label>
                            <div class=" col-sm-1 mx-1 text-black">
                                <input class="form-control" placeholder="60">
                            </div>
                            <span class="text-muted">(㎡)</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 style="border: 1px dashed #bbb; "></h5>
                    </div>

                    <div class="card-body row">
                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                매장명
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="???" placeholder="매장명">
                            </div>
                            <div class="col-md-1 mx-2">
                                <span></span>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select alert-info text-black fw-bold" id="f_event">
                                    <option>업종</option>
                                    <option>업종2</option>
                                </select>
                            </div>
                            <div class="col-md-3 mx-2 ">
                                <select class="form-select alert-info text-black fw-bold" id="f_business">
                                    <option>업태</option>
                                    <option>업태2</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                상호명
                            </div>

                            <div class="col-md-3">
                                <input class="form-control alert-warning" id="f_cp_name" placeholder="상호명">
                            </div>
                            <div class="col-md-1 mx-2">
                                <span>담당자1</span>
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_name1" placeholder="담당자1">
                            </div>
                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_pay_type">
                                    <option value="">결제수단</option>
                                    <option value="카드">카드</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                대표자명
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-warning" id="f_rep_name" placeholder="대표자명">
                            </div>

                            <div class="col-md-1 mx-2 float-end">
                                <span>연락처1</span>
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary " id="f_mobile1" placeholder="연락처1">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_pay_interval">
                                    <option>결제주기</option>
                                    <option>한달</option>
                                </select>
                            </div>
                            <span class="badge badge-center bg-label-secondary">0</span>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                사업자번호
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-warning" id="f_registration_number" placeholder="사업자번호">
                            </div>

                            <div class="col-md-1 mx-2 ">
                                <span>이메일1</span>
                            </div>
                            <div class="col-md-3 alert-secondary">
                                <input class="form-control alert-secondary" id="f_email1" placeholder="이메일1">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_history">
                                    <option>내역</option>
                                    <option>내역2</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                주소
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_addr" placeholder="주소">
                            </div>

                            <div class="col-md-1 mx-2">
                                <span>담당자2</span>
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_name2" placeholder="담당자2">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_reply">
                                    <option>회신</option>
                                    <option>회신2</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1 ">
                                발행주소1
                            </div>
                            <div class="col-md-3">
                                <input class="form-control  alert-secondary" id="f_public_addr1" placeholder="발행주소1">
                            </div>

                            <div class="col-md-1 mx-2">
                                <span>연락처2</span>
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_mobile2" placeholder="연락처2">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_statement">
                                    <option>거래명세서</option>
                                    <option>거래명세서2</option>
                                </select>
                            </div>
                        </div>

                        <div class="btn-group my-1">
                            <div class="col-md-1">
                                발행주소2
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_public_addr2" placeholder="발행주소2">
                            </div>

                            <div class="col-md-1 mx-2">
                                <span>이메일2</span>
                            </div>
                            <div class="col-md-3">
                                <input class="form-control alert-secondary" id="f_email2" placeholder="이메일2">
                            </div>

                            <div class="col-md-3 mx-2">
                                <select class="form-select text-black fw-bold" id="f_tax_bill">
                                    <option>세금계산서</option>
                                    <option>세금계산서2</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox"
                                   id="showChecked1" onclick="checkbox.showByChecked('showChecked1', 'showByCheckedDiv1')" checked />
                            <span class="form-check-label fw-bold  text-black"
                            >공연권료 / (세금)계산서 (위수탁)</span>
                        </div>
                        <div id="showByCheckedDiv1" class="form-control row alert alert-secondary" >
                            <div class="row my-1" id="f_asso">
                                <div class="col-md-1 text-black fw-bold">음저협?</div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="공연사용료">
                                </div>
                                <div class="col-md-2 ">
                                    <input class="form-control alert-warning text-black"
                                           placeholder="1,960">
                                </div>
                                <div class="col-md-2">
                                    <select
                                        class="form-select alert-warning text-black fw-bold">
                                        <option>청구(02)</option>
                                        <option>청구(07)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="품목비교1">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="비고">
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-1 text-black fw-bold">함저협</div>
                                <div class="col-md-2">
                                    <input class="form-control text-black" placeholder="공연사용료">
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control alert-warning text-black"
                                           placeholder="1,960">
                                </div>
                                <div class="col-md-2">
                                    <select
                                        class="form-select alert-warning text-black fw-bold">
                                        <option>청구(02)</option>
                                        <option>청구(07)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="품목비교1">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="비고">
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-1 text-black fw-bold">음실련</div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="공연사용료">
                                </div>
                                <div class="col-md-2 ">
                                    <input class="form-control alert-warning text-black"
                                           placeholder="1,960">
                                </div>
                                <div class="col-md-2">
                                    <select
                                        class="form-select alert-warning text-black fw-bold">
                                        <option>청구(02)</option>
                                        <option>청구(07)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="품목비교1">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="비고">
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-1 text-black fw-bold">연제협</div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="공연사용료">
                                </div>
                                <div class="col-md-2 ">
                                    <input class="form-control alert-warning text-black"
                                           placeholder="1,960">
                                </div>
                                <div class="col-md-2">
                                    <select
                                        class="form-select alert-warning text-black fw-bold">
                                        <option>청구(02)</option>
                                        <option>청구(07)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="품목비교1">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="비고">
                                </div>
                            </div>
                        </div>

                        <div class="form-check btn-group form-switch mb-2 ">
                            <div class="col-md-12">
                                <input id="showChecked2" class="form-check-input" type="checkbox" checked/>
{{--                                <input id="showChecked2" class="form-check-input" type="checkbox"--}}
{{--                                       onclick="checkbox.showByChecked('showChecked2', 'showCheckedDiv2')" checked/>--}}
                                <label class="form-check-label fw-bold text-black">이용료 분할 / (세금)계산서 (일반)</label>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-10 float-end">
                                <input class="form-control alert-info" placeholder="비고">
                            </div>
                        </div>

                        <div id="showCheckedDiv2" class="form-control btn-group row alert alert-secondary">
                            <div class="row my-1">
                                <div class="col-md-1 text-black fw-bold">품목1</div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="이용료">
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control alert-warning" placeholder="단가2">
                                </div>
                                <div class="col-md-2">
                                    <select
                                        class="form-select alert-warning text-black fw-bold">
                                        <option>청구(02)</option>
                                        <option>청구(07)</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control alert-info" placeholder="품목비고1">
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-1 text-black fw-bold">품목2</div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="이용료">
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control alert-warning" placeholder="단가3">
                                </div>
                                <div class="col-md-2">
                                    <select
                                        class="form-select alert-warning text-black fw-bold">
                                        <option>청구(02)</option>
                                        <option>청구(07)</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control alert-info" placeholder="품목비고1">
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-1 text-black fw-bold">품목3</div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="이용료">
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control alert-warning" placeholder="단가4">
                                </div>
                                <div class="col-md-2">
                                    <select
                                        class="form-select alert-warning text-black fw-bold">
                                        <option>청구(02)</option>
                                        <option>청구(07)</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control alert-info" placeholder="품목비고1">
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-1 text-black fw-bold">품목4</div>
                                <div class="col-md-2">
                                    <input class="form-control" placeholder="이용료">
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control alert-warning" placeholder="단가4">
                                </div>
                                <div class="col-md-2">
                                    <select
                                        class="form-select alert-warning text-black fw-bold">
                                        <option>청구(02)</option>
                                        <option>청구(07)</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control alert-info" placeholder="품목비고1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="btn-group">
                            <div class="col-md-12">
                                <label>
                                    <input class="form-check-input me-1" type="checkbox">계산서 즉시
                                    생성
                                </label>
                            </div>
                            <div class="col-md-6 text-center mx-1">
                                <button type="button" class="btn btn-primary"> 신규등록</button>
                                <button type="button" class="btn btn-secondary"> 취소</button>

                            </div>
                            <div class="col-md-11 float-end">
                                <button type="button" class="btn btn-success float-end "> 중복내역
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    {{--                            모달끝--}}

    <div class="container-xxl flex-grow-1 container-p-y" >
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
                            <h4 class="card-header text-center text-primary">고객 검색</h4>
                            <div class="card-body">
                                <div class="form-floating">
                                    <div class="mb-3">
                                        <div class="demo-inline-spacing">
                                            <div class="btn-group">
                                                <div class="btn-group mx-1">
                                                    <select class="form-select">
                                                        <option>결제수단</option>
                                                        <option>카드</option>
                                                        <option>현금</option>
                                                        <option>후불</option>
                                                    </select>
                                                </div>
                                                <div class="btn-group mx-1">
                                                    <select class="form-select">
                                                        <option>신탁여부</option>
                                                        <option>신탁</option>
                                                        <option>비신탁</option>
                                                    </select>
                                                </div>
                                                <div class="btn-group mx-1">
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

                                <div class="form-floating mx-1">
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
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-secondary mx-1">전체로드</button>
                                        <button type="button" class="btn btn-secondary mx-1">미등록만</button>
                                        <button type="button" class="btn btn-primary mx-1">청구&gt;</button>
                                    </div>
                                </div>
                                <div class="form-floating row my-2 mx-1">
                                    <button type="button" class="btn btn-primary">비회원 청구 대상 불러오기&gt;</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover border-bottom">
                                    <thead id="customer_thead">
                                    <tr>
                                        <th class="text-nowrap text-center">점포코드</th>
                                        <th class="text-nowrap text-center">브랜드</th>
                                        <th class="text-nowrap text-center">매장명</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center" id="customer_tbody">
                                    @for($i=0; $i<6; $i++)
                                    <tr class="text-center">
                                        <td class="text-nowrap">7323231A</td>
                                        <td>더벤티</td>
                                        <td>가산테라타</td>
                                    </tr>
                                    @endfor
                                    </tbody>
                                </table>

                                <div class="col-md text-center">
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
                {{--            content left end     --}}

                {{--            content right        --}}
                <div class="col-md-8">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->
                            <h4 class="card-header text-center text-primary">청구 대상</h4>
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
                                            data-bs-target="#mocal_setting1">청구 설정
                                    </button>
                                    <button type="button" class="btn btn-primary me-4 float-end"> 비회원 신규등록</button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover border-bottom">
                                    <thead id="charge_thead">
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
                                    <tbody class="text-center" id="charge_tbody">
{{--                                    @for($i=0; $i<6; $i++)--}}
{{--                                    <tr class="text-center">--}}
{{--                                        <td class="text-nowrap">7323231A</td>--}}
{{--                                        <td>더벤티</td>--}}
{{--                                        <td>가산테라타</td>--}}
{{--                                        <td>123-123-123</td>--}}
{{--                                        <td>CMS</td>--}}
{{--                                        <td>월납</td>--}}
{{--                                        <td>1,200</td>--}}
{{--                                    </tr>--}}
{{--                                    @endfor--}}
                                    </tbody>
                                </table>
                                <div class="col-md text-center">
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
                {{--            content end        --}}

            </div>
        </div>
    </div>
@endsection
