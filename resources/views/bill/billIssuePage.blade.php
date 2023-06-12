{{-- --}}

@extends('layouts.app')
@section('content')

    <script type="text/javascript">

        let checkbox = {
            // (input.checkbox : id값 , 숨길 div : id값)
            showByChecked: function (checkboxId, isShowDivId) {
                // console.log(checkboxId, isShowDivId);
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

        window.oncontextmenu = function () {
            return false;
        };

        document.addEventListener("DOMContentLoaded", () => {
            const mouse_end = async (event) => {
                let is_right_click = (event.which === 3) || (event.button === 2);
                if (is_right_click) {
                    // console.log(event);
                    // 기본 Context Menu가 나오지 않게 차단
                    event.preventDefault();

                    const ctxMenu = document.getElementById('right_click_menu');

                    // 노출 설정
                    ctxMenu.style.display = 'block';
                    // 위치 설정

                    ctxMenu.style.top = event.pageY + 'px';
                    ctxMenu.style.left = event.pageX + 'px';
                } else {
                    const ctxMenu = document.getElementById('right_click_menu');

                    // 노출 초기화
                    ctxMenu.style.display = 'none';
                    ctxMenu.style.top = null;
                    ctxMenu.style.left = null;
                }
                // 이벤트 발생
            };
            let tables = document.querySelector(".table");
            tables.addEventListener("mouseup", mouse_end);
        });

        // ===============table 그리기===============//
        document.addEventListener("DOMContentLoaded", ()=>{
            tables.initialize();
        });

        let tables = {
            /**
             * initialize : set()을 통해 화면 셋팅
             * set : db 조회 후 화면 셋팅
             * onSearch : 검색시 검색 할 data 초기화 후 set() 호출
             * onDraw : html에 데이터 입력
             */
            headers: null,
            items: null,
            data: {},
            selectOptionData: {},
            // tab0: new Set(["f_bizname", "f_shopname", "f_price"]),
            tab1: new Set(["f_pay_type", "f_pay_interval", "f_history", "f_reply",
                "f_statement", "f_tax_bill", "f_issuedate"]),
            tab2: new Set(["f_registration_number",
                "f_minor_business", "f_cp_name", "f_rep_name",
                "f_addr", "f_business", "f_event",
                "f_public_addr1", "f_public_addr2"]),
            tab3: new Set(["f_name1", "f_mobile1", "f_email1",
                "f_name2", "f_mobile2", "f_email2"]),
            tab4: new Set(["f_day1", "f_product1", "f_standard1", "f_unitprice1", "f_count1", "f_price1", "f_tax1", "f_bigo1",
                "f_day2", "f_product2", "f_standard2", "f_unitprice2", "f_count2", "f_price2", "f_tax2", "f_bigo2",
                "f_day3", "f_product3", "f_standard3", "f_unitprice3", "f_count3", "f_price3", "f_tax3", "f_bigo3",
                "f_day4", "f_product4", "f_standard4", "f_unitprice4", "f_count4", "f_price4", "f_tax4", "f_bigo4", "f_issue_type"]),

            initialize: function () {
                this.dataSet();
                this.selectOptionsInit();
                this.onDraw();
                // console.log("selectOptionData : ", this.selectOptionData);
                console.log("set : ", this.tab1);
            },

            /**
             * selectOptionsInit : select option에 들어갈 데이터 초기화
             */
            selectOptionsInit: function () {
                this.items.forEach((item, idx) => {
                    this.headers.forEach((head, idx) => {
                        if (this.selectOptionData[head['key']] === undefined) {
                            this.selectOptionData[head['key']] = new Set();
                        } else {
                            this.selectOptionData[head['key']].add(item[head['key']]);
                        }
                    });
                });
                console.log("selectOptionData", this.selectOptionData);
            },

            /**
             * tab에 따른 class name 반환
             */
            getClassNameByTabs: function (key) {
                if (this.tab1.has(key)) {
                    return "table_tab table_tab1";
                }
                if (this.tab2.has(key)) {
                    return "table_tab table_tab2";
                }
                if (this.tab3.has(key)) {
                    return "table_tab table_tab3";
                }
                if (this.tab4.has(key)) {
                    return "table_tab table_tab4";
                }
            },

            /**
             * tab선택시 data 변경
             */
            onTabChange: function (obj) {
                alert($(obj).data("tab"));

                $(".table_tab").hide();
                $("." + $(obj).data("tab")).show();
            },

            dataSet: function () {
                let method = "POST";
                let url = "{{route("billList")}}";
                let data = this.data;
                let dataType = "json";
                let result = js.ajax_call(method, url, data, dataType, false, "", true);

                this.headers = JSON.parse(result['header']);
                this.items = JSON.parse(result['items']);

            },

            onDraw: function () {
                this.onDrawSelectOptions();
                // this.onDrawTableBody();
            },

            // 컬럼일괄업데이트 부분 select option 그리기
            onDrawSelectOptions: function () {

                //컬럼 일괄 업데이트 버튼 추가
                document.getElementById("select_group_update").innerHTML = this.makeUpdateSelectBox();
                document.getElementById("table_head_select").innerHTML = this.makeTableSelectBox();
                document.getElementById("table_body").innerHTML = this.makeTableBody();
            },

            //table header 그리기
            onDrawTableHeader: function () {

            },

            //table body 그리기
            onDrawTableBody: function () {

            },

            /**
             * update group select box 그리기
             */
            makeUpdateSelectBox: function () {
                let updateSelectBoxHtml = "";

                updateSelectBoxHtml += `
                                    <div class="btn-group"> \n
                                        <button class="btn btn-primary" style="width:180px;  max-width:95%">컬럼 일괄 업데이트</button> \n
                                    </div>`;

                //select-option 그리기
                this.headers.forEach((head, idx) => {
                    let className = this.getClassNameByTabs(head['key']);

                    updateSelectBoxHtml +=
                        `<div class="btn-group ${className}"> \n
                                <select class="form-select" style="width:130px; max-width:95%">\n
                                    <option value="">${head['name']}</option>`;

                    //select-option data 가져오기
                    this.selectOptionData[head['key']].forEach((item, idx) => {
                        updateSelectBoxHtml += `<option value="${item}">${item}</option>`;
                    });

                    //html tag close
                    updateSelectBoxHtml += `</select> </div> </div>`;
                });
                return updateSelectBoxHtml;
            },

            /**
             * table head select box(검색) 그리기
             */
            //TODO : 이미지에 맞춘다고 button으로 구현함 -> select box
            makeTableSelectBox: function () {
                let tableHeadHtml = "";

                tableHeadHtml += `<tr>`
                this.headers.forEach((head, idx) => {
                    let className = this.getClassNameByTabs(head['key']);

                    tableHeadHtml += `<th class="text-nowrap text-center ${className}"> \n
                                        <div class="btn-group "> \n
                                            <select class="form-select" style="width:130px; max-width:95%">
                                                <option value="">${head['name']}</option>`

                    this.selectOptionData[head['key']].forEach((item, idx) => {
                        tableHeadHtml += `<option value="${item}"><a href="javascript:void(0);"></a>${item}</option>`;
                    });

                });
                tableHeadHtml += `</tr>`;

                return tableHeadHtml;

            },
            makeTableBody() {
                console.log(this.items);
                console.log(this.items);
                console.log(this.items);
                let html = "";
                this.items.forEach((item, idx) => {
                    html += `<tr class="text-center">`
                    this.headers.forEach((head, idx) => {
                        let className = this.getClassNameByTabs(head['key']);
                        html += `<td class="text-nowrap ${className}">${item[head['key']]}</td>`
                    });
                    html += `</tr>`;
                });
                return html;
            }
        };
        {{--                                        <tbody class="text-center" id="tbody">--}}
        {{--                                        @for ($i=0; $i<3; $i++)--}}
        {{--                                            <tr class="text-center">--}}
        {{--                                                <td class="text-nowrap">만렙커피</td>--}}
        {{--                                                <td class="text-nowrap">신설동역점</td>--}}
        {{--                                                <td class="text-nowrap" id="" >--}}

        {{--                                                    <a class="text-nowrap"--}}
        {{--                                                       data-bs-toggle="modal"--}}
        {{--                                                       data-bs-target="#unitPriceModal"><mark>6000x</mark></a>--}}
        {{--                                                </td>--}}
        {{--                                                <td class="text-nowrap">CMS</td>--}}
        {{--                                                <td class="text-nowrap">월납1212</td>--}}
        {{--                                                <td class="text-nowrap">X</td>--}}
        {{--                                                <td class="text-nowrap">X</td>--}}
        {{--                                                <td class="text-nowrap">X</td>--}}
        {{--                                                <td class="text-nowrap">21일</td>--}}
        {{--                                                <td class="text-nowrap">21일</td>--}}
        {{--                                            </tr>--}}
        {{--                                        @endfor--}}
        {{--                                        </tbody>--}}

    </script>

    <style type="text/css">
        html, body {
            height: 100%;
        }

        .custom-context-menu {
            position: absolute;
            box-sizing: border-box;
            min-height: 100px;
            min-width: 200px;
            background-color: #ffffff;
            box-shadow: 0 0 1px 2px lightgrey;
        }

        .custom-context-menu ul {
            list-style: none;
            padding: 0;
            background-color: transparent;
        }

        .custom-context-menu li {
            padding: 3px 5px;
            cursor: pointer;
        }

        .custom-context-menu li:hover {
            background-color: #f0f0f0;
        }
    </style>


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">정산 / 계산서 / </span>계산서 발행 조회2
        </h4>

        <div class="form-floating">
            <div class="row">

                {{--            content left        --}}
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->
                            <h4 class="card-header text-primary">계산서 발행 리스트2</h4>

                            <div class="card-body">
                                {{--1~12번 년월 선택 start--}}
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-lg">
                                        <li>
                                            <div class="btn-group">
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-secondary dropdown-toggle"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                >2023년
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="javascript:void(0);">2024년</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">2023년</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">2022년</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">2021년</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">2020년</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">2019년</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">2</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="javascript:void(0);">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">4</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">5</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">6</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">7</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">8</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">9</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">10</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">11</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">12</a>
                                        </li>
                                    </ul>
                                </nav>
                                {{--1~12번 년월 선택 end--}}
                            </div>
                            <div class="card-body">
                                <div class="btn-group col-md-4 form-floating">
                                    <div class="nav-align-top mb-4">
                                        {{-- 탭 1~4 시작 --}}
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <button
                                                    type="button"
                                                    class="nav-link active"
                                                    role="tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#navs-top-1"
                                                    aria-controls="navs-top-1"
                                                    aria-selected="true"
                                                    data-tab="table_tab1"
                                                    onclick="tables.onTabChange(this)"
                                                >
                                                    정산정보
                                                </button>

                                            </li>
                                            <li class="nav-item">
                                                <button
                                                    type="button"
                                                    class="nav-link"
                                                    role="tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#navs-top-2"
                                                    aria-controls="navs-top-2"
                                                    aria-selected="false"
                                                    data-tab="table_tab2"
                                                    onclick="tables.onTabChange(this)"
                                                >
                                                    매장정보
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button
                                                    type="button"
                                                    class="nav-link"
                                                    role="tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#navs-top-3"
                                                    aria-controls="navs-top-3"
                                                    aria-selected="false"
                                                    data-tab="table_tab3"
                                                    onclick="tables.onTabChange(this)"
                                                >
                                                    담당자정보
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button
                                                    type="button"
                                                    class="nav-link"
                                                    role="tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#navs-top-3"
                                                    aria-controls="navs-top-3"
                                                    aria-selected="false"
                                                    data-tab="table_tab4"
                                                    onclick="tables.onTabChange(this)"
                                                >
                                                    품목정보
                                                </button>
                                            </li>
                                        </ul>
                                        {{-- 탭 1~4 끝 --}}
                                    </div>
                                </div>
                                <div class="btn-group col-md-5">
                                    <input type="text"
                                           class="form-control" placeholder="검색어를 입력하세요.">
                                </div>
                                <div class="btn-group float-end">
                                    <button class="btn btn-success">목록 다운로드</button>
                                </div>

                                {{--컬럼 업데이트 head group 시작--}}
                                <nav class="navbar navbar-example navbar-expand-lg navbar-light bg-light">
                                    <div class="horizontal-scrollable" >
                                        {{--                                    <div class="container-fluid ">--}}
                                        {{--                                        class="card overflow-hidden mb-4"--}}
                                        {{-- 컬럼일괄 업데이트 시작--}}
{{--                                        <div class="btn-group" id="select_group_update">--}}
{{--                                            <button class="btn btn-primary">컬럼 일괄 업데이트</button>--}}
{{--                                        </div>--}}

                                        <div class="btn-group" id="select_group_update" >
{{--                                            <input class="form-control" value="" placeholder="input box">--}}
                                        </div>
                                        {{-- 컬럼일괄 업데이트 끝--}}
                                    </div>
                                </nav>
                                {{--컬럼 업데이트 head group 끝--}}
                            </div>

                            {{-- table content --}}
                            <div class="tab-content">
                                <div class="table-responsive" id="both-scrollbars-example">
                                    <table class="table table-hover table-bordered border-bottom">

                                        <thead id="table_head_select">
                                        </thead>
                                        <tbody id="table_body">
                                        </tbody>

{{--                                        <tbody class="text-center" id="tbody">--}}
{{--                                        @for ($i=0; $i<3; $i++)--}}
{{--                                            <tr class="text-center">--}}
{{--                                                <td class="text-nowrap">만렙커피</td>--}}
{{--                                                <td class="text-nowrap">신설동역점</td>--}}
{{--                                                <td class="text-nowrap" id="" >--}}

{{--                                                    <a class="text-nowrap"--}}
{{--                                                       data-bs-toggle="modal"--}}
{{--                                                       data-bs-target="#unitPriceModal"><mark>6000x</mark></a>--}}
{{--                                                </td>--}}
{{--                                                <td class="text-nowrap">CMS</td>--}}
{{--                                                <td class="text-nowrap">월납1212</td>--}}
{{--                                                <td class="text-nowrap">X</td>--}}
{{--                                                <td class="text-nowrap">X</td>--}}
{{--                                                <td class="text-nowrap">X</td>--}}
{{--                                                <td class="text-nowrap">21일</td>--}}
{{--                                                <td class="text-nowrap">21일</td>--}}
{{--                                            </tr>--}}
{{--                                        @endfor--}}
{{--                                        </tbody>--}}

                                    </table>
                                    <div class="modal fade" id="unitPriceModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5>단가를 합산한 세부 내역을 <br>엑셀 파일로 다운로드 할까요?</h5>
                                                </div>
                                                <div class="modal-body text-center ">
                                                    <button class="btn btn-primary mx-2">네</button>
                                                    <button class="btn btn-primary mx-2">아니오</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--오른쪽 버튼 클릭 시작--}}
    <div id='right_click_menu' class="custom-context-menu" style="display: none; z-index: 99">
        <div class="row">
            <div class="col-md-12 col-12 mb-3 mb-md-0">
                <a class="list-group-item list-group-item-action "
                   data-bs-toggle="modal"
                   data-bs-target="#bill_integrate">계산서 통합</a>
                <a class="list-group-item list-group-item-action "
                   data-bs-toggle="modal"
                   data-bs-target="#bill_divide">계산서 분할</a>
                <a class="list-group-item list-group-item-action " data-bs-toggle="modal"
                   data-bs-target="#price_sync">단가 동기화</a>
                <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">계산서
                    양식 출력</a>
                <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">계산서
                    삭제</a>
            </div>
        </div>
    </div>
    {{--오른쪽 버튼 클릭 끝--}}

    {{--오른쪽 버튼 클릭 content 시작--}}
    <div class="modal fade" id="bill_integrate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="btn-group">
                        <h3 class="modal-title" id="modalCenterTitle" style="color:black; font-weight: bold">계산서
                            통합하기</h3>
                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <h6 class="text-black" style="color:black;"> 선택 (최대 4건)된 계산서가 하나로 통합됩니다.</h6>
                                <h6 class="text-black">계산서 단가는 합산되어 생성됩니다.</h6>
                                <h6 class="text-black">단가 수정이 필요한 경우 단가를 편집하고</h6>
                                <h6 class="text-black">통합 버튼을 클릭하세요.</h6>
                            </div>
                        </div>
                        <div class="card-body alert alert-secondary">

                            <div class="btn group col-md-6 ">
                                <label class="text-black fw-bold">품목1</label>
                                <div class="btn-group col-md-5 my-1 ">
                                    <input class="form-control" value="4월 공연">
                                </div>
                                <div class="btn-group col-md-5 my-1">
                                    <input class="form-control" value="4월 공연">
                                </div>

                                <label class="text-black fw-bold">품목2</label>
                                <div class="btn-group col-md-5 my-1">
                                    <input class="form-control" value="4월 셋탑">
                                </div>
                                <div class="btn-group col-md-5 my-1 ">
                                    <input class="form-control" value="4월 6000">
                                </div>

                                <label class="text-black fw-bold">품목3</label>
                                <div class="btn-group col-md-5 my-1">
                                    <input class="form-control" value="" disabled>
                                </div>
                                <div class="btn-group col-md-5 my-1">
                                    <input class="form-control" value="" disabled>
                                </div>

                                <label class="text-black fw-bold">품목4</label>
                                <div class="btn-group col-md-5 my-1">
                                    <input class="form-control" value="" disabled>
                                </div>
                                <div class="btn-group col-md-5 my-1">
                                    <input class="form-control" value="" disabled>
                                </div>
                                <h4 class="text-black fw-bold py-3 mb-4">
                                    통합 단가 <span class="text-primary">12,000</span>원
                                </h4>
                            </div>
                            <div class="btn group col-md-5">
                                <button class="btn btn-warning btn-xl" type="button">2건 통합</button>
                                <h4 class="text-black fw-bold py-3 mb-4">
                                    통합 단가<span class="text-primary">12,000</span>원
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">통합</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">취소</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bill_divide" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="btn-group">
                        <h3 class="modal-title" id="modalCenterTitle" style="font-weight: bold">계산서 분할하기</h3>
                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <h6> 선택된 계산서가 최대 4개로 분할됩니다.</h6>
                                <h6>계산서 단가는 품목별로 분할되어 생성됩니다.</h6>
                                <h6>단가 수정이 필요한 경우 단가를 편집하고</h6>
                                <h6>분할 버튼을 클릭하세요.</h6>
                            </div>
                        </div>

                        <div class="card-body alert-secondary">
                            <div>
                                <div class="btn-group">
                                    <h5>분할 품목</h5>
                                </div>
                                <div class="btn-group mx-4 my-4">
                                    <select class="form-select">
                                        <option>2개</option>
                                        <option>3개</option>
                                        <option>4개</option>
                                    </select>
                                </div>
                            </div>
                            <h5 style="border: 1px dashed #bbb; "></h5>

                            <div class="btn group col-md-8">
                                {{--                            <div class="form-control"></div>--}}
                                <label>계산서1</label>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 공연">
                                </div>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 공연">
                                </div>

                                <label>계산서2</label>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 셋탑">
                                </div>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 6000">
                                </div>
                                <label>계산서3</label>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 셋탑">
                                </div>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 6000">
                                </div>
                                <label>계산서4</label>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 셋탑">
                                </div>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 6000">
                                </div>

                            </div>
                            <div class="btn group col-md-6">
                                <button class="btn btn-lg alert-info text-black fw-bold col-sm-12" type="button">
                                    <span>계산서</span>
                                    <span style="font-weight: bold; font-size: 30px">2</span>
                                    <span>개로 분할</span>
                                </button>
                            </div>
                            <div class="btn group col-md-5">
                                <h4 class="text-black fw-bold"> 단가 총액 <span class="text-primary">12,000</span>원</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <button type="button" class="btn btn-primary">분할</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">취소</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="price_sync" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="btn-group">
                        <h3 class="modal-title" id="modalCenterTitle" style="font-weight: bold">단가 동기화</h3>
                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <h6>CRM에서 관리되는 서비스 이용료룰</h6>
                                <h6>자동으로 연결하여 단가 동기화를 진행합니다.</h6>
                                <h6 style="color: dodgerblue">입금내역이 매칭되지 않은 계산서만 적용됩니다.</h6>
                            </div>
                        </div>

                        <div class="card-body alert-secondary ">
                            <div class="btn-group">
                                <div class="col-md-2">
                                    <div class="form-check form-switch mb-2 ">
                                        <input id="showChecked1"
                                               onclick="checkbox.showByChecked('showChecked1', 'showCheckedDiv1')"
                                               class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                               checked/>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h5 class="text-black ">지정월 전체 단가 동기화</h5>
                                </div>
                                <div id="showCheckedDiv1" class="col-md-10">
                                    <div class="card">
                                        <div class="card-body ">
                                            <h4 class="text-center">
                                                <span class="fw-bold">2</span>건
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="my-3" style="border: 1px dashed #bbb; "></h5>

                            <div class="btn group col-md-12">
                                <h6 style="color: black">해당 옵션이 활성화 될 경우 계산서 선택과 상관없이 </h6>
                                <h6 style="color: black">지정된 월의 전체 단가를 동기화 시켜줍니다.</h6>
                                <h6>(단, 입금내역이 미매칭된 계산서의 경우만 업데이트)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mx-1">동기화</button>
                        <button class="btn alert-secondary mx-1">취소</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--오른쪽 버튼 클릭 content 끝--}}

@endsection
