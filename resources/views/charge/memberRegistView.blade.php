{{--청구 대상 등록--}}
@extends('layouts.app')
@section('content')

    <script type="text/javascript">

        document.addEventListener("DOMContentLoaded", ()=>{
            tables.initialize();
        });
        function showUpdateForm(item) {
            alert(123123123);

            var modal = document.getElementById("modal_setting_update");
            modal.style.display = 'block';
            alert(item);
        }
        let tables = {
            items: null,
            initialize:function(){
                this.set();
                this.onDraw();
            },
            set:function(){
                let method = "POST";
                let url = "{{route("billList2")}}";
                let datas = {
                };
                let dataType = "json";
                let ret = js.ajax_call(method, url, datas, dataType, false, "", true);

                console.log("=======ajax_call======");
                console.log(ret);
                console.log("========ajax_call=====");
                this.items = JSON.parse(ret['items']);
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
                    html += `<tr class="text-center">`;
                    html += `    <td class="text-nowrap">${item['f_minor_business']}</td>`;
                    html += `    <td class="text-nowrap">${item['f_bizname']}</td>`;
                    html += `    <td class="text-nowrap"  >
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal_setting_update">${item['f_shopname']}
                                    </a></td>`;
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

        let crud ={
            registBillForm: function () {
                // var formData = $('#billForm').serialize();
                let method = "POST";
                let url = "{{route("billRegisterProcess")}}";
                let datas = $('#billForm').serialize();
                let dataType = "json";
                js.ajax_call(method, url, datas, dataType, true);
            },
        }



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
