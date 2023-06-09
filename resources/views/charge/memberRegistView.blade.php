{{--청구 대상 등록--}}
@extends('layouts.app')
@section('content')
    <script>
        function onSearch(formid) {
            var formData = new FormData(document.getElementById(formid));
            formData.append('page','1');
            formData.submit();
        }

        document.addEventListener("DOMContentLoaded", ()=>{
            tables.initialize();
        });

        function modalClose(modalId) {
            $('#'+modalId).modal('hide');
        }

        let tables = {
            items: null,
            initialize:function(){
                this.set();
                this.onDraw();
            },
            set:function(){
                let method = "POST";
                let url = "{{route("billListNEY")}}";
                let datas = {};
                let dataType = "json";
                let ret = js.ajax_call(method, url, datas, dataType, false, "", true);
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
                    // console.log(item);
                    // return;
                    html += `<tr class="text-center">`;
                    html += `    <td class="text-nowrap">${item['f_minor_business']}</td>`;
                    html += `    <td class="text-nowrap">${item['f_bizname']}</td>`;
                    html += `    <td class="text-nowrap">
                            <a href="#" onclick="update.BillFormShow('${item['f_billid']}', '${item['f_loginid']}')" > ${item['f_shopname']}</a>
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
    </script>


    <div class="container-xxl flex-grow-1 container-p-y" >
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">정산 / 이용료 청구 / </span>청구 대상 등록1212
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
                                                    <select class="form-select" id="f_pay_type" name="f_pay_type">
                                                        <option value="">결제수단</option>
                                                        <option value="card">카드</option>
                                                        <option value="cash">현금</option>
                                                        <option value="post_payment">후불</option>
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
                                <form id="sch_form">
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
                                </form>
                                <div class="form-floating col-md-4">
                                    <div class="btn-group my-2">
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="exampleFormControlReadOnlyInput1"
                                            placeholder="검색어를 입력하세요."
                                        />
                                    </div>
                                    <div class="btn-group my-2">
                                        <button class="btn btn-info" onclick="onSearch('sch_form')">검색12</button>
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <button type="button" class="btn btn-danger me-4"> &lt;청구 해제</button>
                                    <button type="button"
                                            class="btn btn-primary me-4 float-end"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal_setting_register"> 비회원 신규 등록
                                    </button>

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
    @yield('billRegistForm', View::make('bill.include.billRegistForm'))
    @yield('billUpdateForm', View::make('bill.include.billUpdateForm'))
@endsection
