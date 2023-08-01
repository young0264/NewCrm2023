{{--청구 대상 등록--}}
@extends('layouts.app')
@section('content')
<script>

    /**
     * tables.initialize() : 화면 셋팅
     */
    document.addEventListener("DOMContentLoaded", ()=>{
        validateBillForm();
        tables.initialize();
    });

    function modalClose(modalId) {
        $('#'+modalId).modal('hide');
    }

    /**
     * bill form 등록, input validate
     */
    function validateBillForm() {
        validation.email();
        validation.phoneNumber();
    }

    /**
     *  validate 함수들
     * */
    let validation = {
        phoneNumber: function () {
            $(document).on("keyup", ".phoneNumber", function () {
                $(this).val($(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})$/, "$1-$2-$3").replace("--", "-"));

                var phoneNumId = $(this).attr("id");
                var pattern = /^(?:\d{3}-\d{3,4}-\d{4}|\d{2,3}-\d{3,4}-\d{4})$/;
                const MOBILE_CNT = 2;
                for(let i = 1; i <= MOBILE_CNT; i++) {
                    if (document.getElementById(phoneNumId).value.match(pattern)) {
                        document.getElementById(phoneNumId).style.borderColor = "blue";
                    } else {
                        document.getElementById(phoneNumId).style.borderColor = "red";
                    }
                }
            });
        },

        email: function () {
            $(document).on("keyup", ".email", function () {
                var emailId = $(this).attr("id");
                var pattern = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
                const EMAIL_CNT = 2;
                for(let i = 1; i <= EMAIL_CNT; i++) {
                    if (document.getElementById(emailId).value.match(pattern)) {
                        document.getElementById(emailId).style.borderColor = "blue";
                    } else {
                        document.getElementById(emailId).style.borderColor = "red";
                    }
                }
            })
        },
    };

    let tables = {
        billChargeItems: null,
        clientItems: null,
        billChargeData: {},
        clientData: {},
        clientExtraInfo: [],
        selectedClient : [],
        selectedClientLoginId: "",
        selectedClientShopname: "",
        selectedClientCompany: "",
        selectedClientSite: "",
        selectedClientShopId: "",
        selectedClientBizId: "",
        selectedClientBizName: "",
        clientClassList : null,
        billClassList: new Set(),

        /** f_deleted 컬럼 Y:삭제(숨기기), 컬럼N:노출 */
        billDelete: function () {
            if (!confirm("삭제 하시겠습니까?")) {
                return;
            }
            let method = "POST";
            let url = "{{route("billDelete")}}";
            let data = {f_billid: Array.from(this.billClassList)};
            let dataType = "json";
            let result = js.ajax_call(method, url, data, dataType, false, "", true);
            console.log("result : ", result);
            this.billChargeTableDataSet();
        },

        /** 청구대상 마우스 왼쪽 버튼 클릭 */
        billLeftClick: function (obj) {
            if(obj.classList.contains('selected')) {
                obj.classList.remove("selected");
                this.billClassList.delete(obj.querySelector("#f_billid").innerText);
            } else {
                obj.classList.add("selected");
                this.billClassList.add(obj.querySelector("#f_billid").innerText);
            }
        },

        /** 고객 검색 마우스 왼쪽 버튼 클릭 */
        clientLeftClick:function(obj) {
            if (this.clientClassList === null) {
                this.clientClassList = obj.classList;
                obj.classList.add("selected");
            }else if (obj.classList.contains('selected')) {
                obj.classList.remove("selected");
                this.clientClassList =null;
                this.selectedClientLoginId = "";
                this.selectedClientShopname = "";
                this.selectedClientCompany = "";
                this.selectedClientSite = "";
                this.selectedClientShopId = "";
                this.selectedClientBizId = "";
                this.selectedClientBizName = "";
            } else {
                obj.classList.add("selected");
                this.clientClassList.remove("selected");
                this.clientClassList = obj.classList;
            }

            this.selectedClientLoginId = obj.querySelector("#f_loginid").innerText;
            this.selectedClientShopname = obj.querySelector("#f_shopname").innerText;
            this.selectedClientCompany = obj.querySelector("#f_company").innerText;
            this.selectedClientSite = obj.querySelector("#f_site").innerText;
            this.selectedClientShopId = obj.querySelector("#f_shopid").innerText;
            this.selectedClientBizId = obj.querySelector("#f_bizid").innerText;
            this.selectedClientBizName = obj.querySelector("#f_bizname").innerText;
        },

        /**
         * initialize : set()을 통해 화면 셋팅
         * set : db 조회 후 화면 셋팅
         * onChargeTableSearch : 검색시 검색 할 data 초기화 후 set() 호출
         * onChargeTableSearch : 검색시 검색 할 data 초기화 후 set() 호출
         * onDraw : html에 데이터 입력
         */
        initialize:function(){
            this.billChargeTableDataSet();
            this.clientStoreTableDataSet();
        },

        //TODO
        onClientTableDraw() {
            let html = "";
            if (this.clientItems===null) {
                html += `<tr class="text-center">`;
                html += `    <td colspan="4">조회된 데이터가 없습니다.</td>`;
                html += `</tr>`;
                document.querySelector("#client_tbody").innerHTML = html;
                return;
            }
            this.clientItems.forEach((item, idx) => {
                html += `<tr class="text-center" onclick="tables.clientLeftClick(this)" style="cursor:pointer">`;
                html += `    <td class="text-nowrap" id="f_loginid" style="text-overflow:ellipsis; overflow:hidden; white-space:nowrap;" >${item['f_loginid']}</td>`;
                html += `    <td class="text-nowrap" id="f_bizname" style="text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">${item['f_bizname'] === null ? "" : item['f_bizname']}</td>`;
                html += `    <td class="text-nowrap" id="f_shopname" style="text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">${item['f_shopname'] === null ? "" : item['f_shopname']}</td>`;
                html += `    <td class="text-nowrap" id="f_regid" style="text-overflow:ellipsis; overflow:hidden; white-space:nowrap;" hidden="hidden">${item['f_regid'] === null ? "" : item['f_company']}</td>`;
                html += `    <td class="text-nowrap" id="f_company" style="text-overflow:ellipsis; overflow:hidden; white-space:nowrap;" hidden="hidden">${item['f_company'] === null ? "" : item['f_company']}</td>`;
                html += `    <td class="text-nowrap" id="f_site" style="text-overflow:ellipsis; overflow:hidden; white-space:nowrap;" hidden="hidden">${item['f_site'] === null ? "" : item['f_site']}</td>`;
                html += `    <td class="text-nowrap" id="f_shopid" style="text-overflow:ellipsis; overflow:hidden; white-space:nowrap;" hidden="hidden">${item['f_shopid'] === null ? "" : item['f_shopid']}</td>`;
                html += `    <td class="text-nowrap" id="f_bizid" style="text-overflow:ellipsis; overflow:hidden; white-space:nowrap;" hidden="hidden">${item['f_bizid'] === null ? "" : item['f_bizid']}</td>`;
                html += `</tr>`;
            });
            document.querySelector("#client_tbody").innerHTML = html;
        },

        /**
         * clientStoreTableDataSet : 고객사 검색 데이터 조회
         */
        clientStoreTableDataSet: function () {
            let method = "POST";
            let url = "{{route("getStoreInfo")}}";
            let data = this.clientData;
            let dataType = "json";
            let result = js.ajax_call(method, url, data, dataType, false, "", true);
            this.clientItems = null;
            if (result !== "empty") {
                this.clientItems = JSON.parse(result);
            }
            this.onClientTableDraw();

        },

        /**
         * billChargeTableDataSet : 청구 대상 데이터 조회
         */
        billChargeTableDataSet:function(){
            let method = "POST";
            let url = "{{route("billListNEY")}}";
            let data = this.billChargeData;
            let dataType = "json";
            let result = js.ajax_call(method, url, data, dataType, false, "", true);
            this.billChargeItems = JSON.parse(result['items']);
            this.onChargeTableDraw();
        },

        onClientTableSearch: function () {
            this.clientData = {
                'sch_key': document.getElementById('client_sch_form').elements.sch_key.value,
                'sch_val': document.getElementById('client_sch_form').elements.sch_val.value,
            };
            this.clientStoreTableDataSet();
        },

        onChargeTableSearch: function () {
            this.billChargeData = {
                'f_pay_type':document.getElementById('f_pay_type').value,
                'sch_key': document.getElementById('charge_sch_form').elements.sch_key.value,
                'sch_val': document.getElementById('charge_sch_form').elements.sch_val.value,
            };
            this.billChargeTableDataSet();
        },

        onChargeTableDraw:function() {
            this.onChargeTableBodyDraw();
        },

        onChargeTableBodyDraw:function() {
            let html = "";
            if (this.billChargeItems.length===0) {
                html += `<tr class="text-center">`;
                html += `    <td colspan="7" >조회된 데이터가 없습니다.</td>`;
                html += `</tr>`;
                document.querySelector("#charge_tbody").innerHTML = html;
                return;
            }
            this.billChargeItems.forEach((item, idx) => {
                html += `<tr class="text-center" onclick="tables.billLeftClick(this)">`;
                html += `    <td class="text-nowrap" id="f_billid">${item['f_billid']}</td>`;
                html += `    <td class="text-nowrap">${item['f_bizname'] === null ? "" : item['f_bizname']}</td>`;
                html += `    <td class="text-nowrap">
                                <a href="#" onclick="update.BillFormShow('${item['f_billid']}', '${item['f_loginid']}')">${item['f_shopname'] === null ? "값없음" : item['f_shopname']} </a>
                             </td>`;
                html += `    <td class="text-nowrap">${item['f_registration_number'] === null ? "" : item['f_registration_number']}</td>`;
                html += `    <td class="text-nowrap">${item['f_pay_type'] === null ? "" : item['f_pay_type']}</td>`;
                html += `    <td class="text-nowrap">${item['f_pay_interval'] === null ? "" : item['f_pay_interval']}</td>`;
                html += `    <td class="text-nowrap">${item['f_price'] === null ? "" : item['f_price']}</td>`;
                html += `</tr>`;
            });
            document.querySelector("#charge_tbody").innerHTML = html;
        },

        /**
         * 비회원 신규 등록 버튼 클릭시
         */
        billRegistModelInit() {
            // 비회원 신규 등록 modal 등록창 form 내부의 특정 input ID에 해당하는 value 값을 변경합니다.
            let loginIdInput = document.getElementById('billModalForm').querySelector('#f_loginid');
            let companyInput = document.getElementById('billModalForm').querySelector('#f_company');
            let shopnameInput = document.getElementById('billModalForm').querySelector('#f_shopname');
            let siteInput = document.getElementById('billModalForm').querySelector('#f_site');
            let shopIdInput = document.getElementById('billModalForm').querySelector('#f_shopid');
            let bizIdInput = document.getElementById('billModalForm').querySelector('#f_bizid');
            let bizNameInput = document.getElementById('billModalForm').querySelector('#f_bizname');
            loginIdInput.value = this.selectedClientLoginId;
            companyInput.value = this.selectedClientCompany;
            shopnameInput.value = this.selectedClientShopname;
            siteInput.value = this.selectedClientSite;
            shopIdInput.value = this.selectedClientShopId;
            bizIdInput.value = this.selectedClientBizId;
            bizNameInput.value = this.selectedClientBizName;
        }
    };

</script>
    <div class="container-xxl flex-grow-1 container-p-y" >
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">정산 / 이용료 청구 / </span>청구 대상 등록1
        </h4>

        <div class="form-floating">
            <div class="row">
                {{--            content left        --}}
                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->
                            <h4 class="card-header text-center text-primary">고객 검색</h4>
                            <form id="client_sch_form"  onsubmit="return false;">
                                <div class="card-body">
                                    <div class="form-floating">
                                        <div class="mb-3">
                                            <div class="demo-inline-spacing">
                                                <div class="btn-group">
                                                    <div class="btn-group mx-1" style="width: 60%;">
                                                        <select class="form-select" >
                                                            <option value="">결제수단</option>
                                                            <option value="card">카드</option>
                                                            <option value="cash">현금</option>
                                                            <option value="post_payment">후불</option>
                                                        </select>
                                                    </div>
                                                    <div class="btn-group mx-1" style="width: 60%;">
                                                        <select class="form-select">
                                                            <option>신탁여부</option>
                                                            <option>신탁</option>
                                                            <option>비신탁</option>
                                                        </select>
                                                    </div>
                                                    <div class="btn-group mx-1" style="width: 60%;">
                                                        <select class="form-select" name="sch_key">
                                                            <option value="tonghap">통합</option>
                                                            <option value="f_loginid">로그인ID</option>
                                                            <option value="f_bizname">브랜드</option>
                                                            <option value="f_shopname">매장명</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating">
                                        <div class="btn-group my-2" style="width: 60%;">
                                            <input
                                                class="form-control mx-1"
                                                type="text"
                                                id="sch_val"
                                                name="sch_val"
                                                placeholder="검색어를 입력하세요."
                                            />
                                        </div>
                                        <div class="btn-group my-2">
                                            <button type="button" class="btn btn-info mx-1" onclick="tables.onClientTableSearch()">검색</button>
                                            <button type="button" class="btn btn-primary mx-1">청구</button>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <div class="mb-3" >
                                        </div>
                                    </div>
{{--                                    <div class="form-floating row my-2 mx-1">--}}
{{--                                        <button type="button" class="btn btn-primary">비회원 청구 대상 불러오기&gt;</button>--}}
{{--                                    </div>--}}
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover border-bottom" style="table-layout: fixed">
                                    <thead id="customer_thead" style="text-overflow: ellipsis; max-width: 120px;">
                                    <tr>
                                        <th class="text-nowrap text-center">로그인ID(점포코드)</th>
                                        <th class="text-nowrap text-center" > 브랜드</th>
                                        <th class="text-nowrap text-center">매장명</th>
                                    </tr>
                                    </thead>
                                    {{-- 고객검색 리스트 시작 --}}
                                    <tbody class="text-center" id="client_tbody">
                                    {{-- 고객검색 리스트 끝--}}
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
                            <form id="charge_sch_form">
                                <div class="card-body">
                                    <div class="form-floating">
                                        <div class="mb-3">
                                            <div class="demo-inline-spacing">
                                                <div class="btn-group">
                                                    <select class="form-select" id="f_pay_type" name="f_pay_type">
                                                        <option value="">결제수단</option>
                                                        <option value="card" {{request('f_pay_type')=="card" ? "selected" : ""}}>카드</option>
                                                        <option value="cash" {{request('f_pay_type')=="cash" ? "selected" : ""}}>현금</option>
                                                        <option value="post_payment" {{request('f_pay_type')=="post_payment" ? "selected" : ""}}>후불</option>
                                                    </select>
                                                </div>
                                                <div class="btn-group" >
                                                    <select class="form-select" >
                                                        <option>신탁여부</option>
                                                        <option>신탁</option>
                                                        <option>비신탁</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <div class="btn-group">
                                            <select class="form-select" id="sch_key" name="sch_key">
                                                <option value="tonghap">통합</option>
                                                <option value="f_billid">점포코드</option>
                                                <option value="f_bizname">브랜드</option>
                                                <option value="f_shopname">매장명</option>
                                                <option value="f_registration_number">사업자번호</option>
                                                <option value="f_interval">결제주기</option>
                                                <option value="f_price">단가</option>
                                            </select>
                                        </div>
                                        <div class="btn-group my-2">
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="sch_val" name="sch_val"
                                                placeholder="검색어를 입력하세요."
                                            />
{{--                                            <input class="form-control" id="sch_val" name="sch_val" value="{{request('sch_val')}}" placeholder="검색어를 입력하세요.">--}}
                                        </div>
                                        <div class="btn-group my-2">
                                            <button type="button" class="btn btn-info" onclick="tables.onChargeTableSearch()">검색</button>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <button type="button" class="btn btn-danger" onclick="tables.billDelete()">청구 해제</button>
                                        <button type="button"
                                                class="btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal_setting_register"
                                                onclick="tables.billRegistModelInit()"
                                        > 비회원 신규 등록
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover border-bottom">
                                    <thead id="charge_thead">
                                    <tr>
                                        <th class="text-nowrap text-center">billid(점포코드)</th>
                                        <th class="text-nowrap text-center">브랜드</th>
                                        <th class="text-nowrap text-center">매장명</th>
                                        <th class="text-nowrap text-center">사업자번호</th>
                                        <th class="text-nowrap text-center">결제수단</th>
                                        <th class="text-nowrap text-center">결제주기</th>
                                        <th class="text-nowrap text-center">단가</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center" id="charge_tbody">
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
    @yield('billRegistModal', View::make('bill.include.billRegistModal'))
    @yield('billUpdateModal', View::make('bill.include.billUpdateModal'))
@endsection
