{{--청구 대상 등록--}}

@extends('layouts.app')
@section('content')
    <script type="text/javascript">
        var f_billForm_param = Array(
            'f_shopname',
            'f_cb',
            'f_business',
            'f_cp_name',
            'f_name1',
            'f_pay_type',
            'f_rep_name',
            'f_mobile1',
            'f_pay_interval',
            'f_registration_number',
            'f_email1',
            'f_history',
            'f_addr',
            'f_name2',
            'f_reply',
            'f_public_addr1',
            'f_mobile2',
            'f_statement',
            'f_public_addr2',
            'f_email2',
            'f_tax_bill',
            'f_product1',
            'f_product2',
            'f_product3',
            'f_product4',
            'f_unitprice1',
            'f_unitprice2',
            'f_unitprice3',
            'f_unitprice4',
            'f_issue_type',
            'f_bigo1',
            'f_bigo2',
            'f_bigo3',
            'f_bigo4');
        //=========여기까지 기본 데이터 end ============//
        //=========공연권료 / (세금)계산서 (위수탁) start TODO 컬럼명 분기 ============//
        var f_billForm_param_0306 = Array(
            'f_product1_komca',
            'f_product1_koscap',
            'f_product1_fkmp',
            'f_product1_kapp',
            'f_unitprice_komca',
            'f_unitprice_koscap',
            'f_unitprice_fkmp',
            'f_unitprice_kapp',
            'f_issue_type_komca',
            'f_issue_type_koscap',
            'f_issue_type_fkmp',
            'f_issue_type_kapp',
            'f_bigo1_komca',
            'f_bigo1_koscap',
            'f_bigo1_fkmp',
            'f_bigo1_kapp',
            'f_bigo_komca',
            'f_bigo_koscap',
            'f_bigo_fkmp',
            'f_bigo_kapp',
        );
        //=========공연권료 / (세금)계산서 (위수탁) end ============//

        //========= 이용료 분할 / (세금)계산서 (일반) TODO 컬럼명 분기 ============//
        //checked -> db에서 row 4개를 찾고 이용료,단가,...,품목비고등 column1에 들어간거 2,3,4로 치환
        //unchecked -> 한로우에서 때려넣으면 됨
        var f_billForm_param_01 = Array(
            'f_product1',
            'f_product2',
            'f_product3',
            'f_product4',
            'f_unitprice1',
            'f_unitprice2',
            'f_unitprice3',
            'f_unitprice4',
            'f_issue_type_prod1',
            'f_issue_type_prod2',
            'f_issue_type_prod3',
            'f_issue_type_prod4',
            'f_bigo1',
            'f_bigo2',
            'f_bigo3',
            'f_bigo4');

        // bill form 등록
        let register = {
            BillFormRegister: function () {
                alert("hererer BillFormRegister");
                let method = "POST";
                let url = "{{route("billRegisterProcess")}}";
                let datas = $('#billForm').serialize();
                let dataType = "json";
                js.ajax_call(method, url, datas, dataType, false, "", true);
            },
        };

        //bill form 수정
        let  update = {
            result: null,
            BillFormShow: function (billId) {


                // 데이터를 전달할 요소의 값을 변경합니다.
                // modalBody.innerHTML = `수정할 Bill ID는 ${billId} 입니다.`;

                // 모달창을 엽니다.
                const modal = new bootstrap.Modal(document.querySelector('#modal_setting_update'));
                modal.show();

                //파라미터로 들어온 bill_id값으로 NEY_Bill테이블에서 bill을 가져옵니다.
                let res = js.ajax_call("POST", "{{route("findNEYBillById")}}", {"billId": billId}, "json", false, "", true)
                //String타입을 json형식으로 변환해 result에 저장합니다.
                this.result = JSON.parse(res['item'])[0];
                // f_billForm_param 필드에 해당하는 값들을 수정해줍니다.
                for (let i = 0; i < f_billForm_param.length; i++) {
                    document.querySelector('#update-modal-body').querySelector('#'+f_billForm_param[i]).value =  this.result[f_billForm_param[i]];
                }
            },

            process: function (billId) {

            },
        }
        document.addEventListener("DOMContentLoaded", ()=>{
            tables.initialize();
        });

        let tables = {
            items: null,
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

                console.log("=======ajax_call======");
                this.items = JSON.parse(ret['items']);
                console.log(ret);
                console.log("========ajax_call=====");
            },
            onDraw:function() {
                this.onDrawBody();
            },

            onDrawBody:function() {
                /**
                 * 바디에 데이터셋 입력 처리
                 * @type {string}
                 */
                let html = "";
                this.items.forEach((item, idx) => {
                    console.log("item : ", item);
                    html += `<tr class="text-center">`;
                    html += `    <td class="text-nowrap">${item['f_minor_business']}</td>`;
                    html += `    <td class="text-nowrap">${item['f_bizname']}</td>`;
                    html += `    <td class="text-nowrap">
                            <a href="#" onclick="update.BillFormShow('${item['f_billid']}')" > ${item['f_shopname']}</a>
                                 </td>`;
                    html += `    <td class="text-nowrap">${item['f_registration_number']}</td>`;
                    html += `    <td class="text-nowrap">${item['f_pay_type']}</td>`;
                    html += `    <td class="text-nowrap">${item['f_pay_interval']}</td>`;
                    html += `    <td class="text-nowrap">${item['f_price']}</td>`;
                    html += `</tr>`;
                });
                document.querySelector("#charge_tbody").innerHTML = html;
            },
        };

        <!--   data-bs-target="#modal_setting_update" , data-item_row=item-->

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

        let crud = {
            registBillForm: function () {
                // var formData = $('#billForm').serialize();
                let method = "POST";
                let url = "{{route("billRegisterProcess")}}";
                let datas = $('#billForm').serialize();
                let dataType = "json";
                js.ajax_call(method, url, datas, dataType, true);
            },
        };

    </script>


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
                                        <th class="text-nowrap text-center" > 브랜드</th>
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
                                            data-bs-target="#modal_setting_register">청구 설정
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
    @yield('billRegistForm', View::make('bill.include.billRegistForm'))
    @yield('billUpdateForm', View::make('bill.include.billUpdateForm'))
@endsection
