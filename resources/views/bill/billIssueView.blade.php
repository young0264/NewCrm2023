{{--비회원 청구 대상 등록--}}

@extends('layouts.app')
@section('content')
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
    <script type="text/javascript">

        window.oncontextmenu = function () {
            return false;
        };

        document.addEventListener("DOMContentLoaded", ()=>{
            const mouse_end = async (event) => {
                let is_right_click = (event.which == 3) || (event.button == 2);
                if(is_right_click) {
                    console.log(event);
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
    </script>
    {{--    <nav>--}}
    {{--        <ul>--}}
    {{--            <li><a href="http://gmail.com/">구글</a></li>--}}
    {{--            <li><a href="http://heodolf.tistory.com/">블로그</a></li>--}}
    {{--            <li><img src="https://tistory1.daumcdn.net/tistory/2803323/skin/images/img.jpg" width="100"></li>--}}
    {{--        </ul>--}}
    {{--    </nav>--}}

    <div id='right_click_menu' class="custom-context-menu" style="display: none; z-index: 99">
        <div class="mt-3">
            <div class="row">
                <div class="col-md-12 col-12 mb-3 mb-md-0">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#bill_integrate">계산서 통합</a>
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#bill_divide">계산서 분할</a>
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#price_sync">단가 동기화</a>
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">계산서 양식 출력</a>
                        <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">계산서 삭제</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bill_integrate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="btn-group">
                        <h3 class="modal-title" id="modalCenterTitle" style="color:black; font-weight: bold">계산서 통합하기</h3>
                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="card-body">
                    <div class="modal-body" >
                        <div class="row">
                            <div class="col mb-3">
                                <h6 style="color:black;"> 선택 (최대 4건)된 계산서가 하나로 통합됩니다.</h6>
                                <h6 style="color:black;">계산서 단가는 합산되어 생성됩니다.</h6>
                                <h6 style="color:black;">단가 수정이 필요한 경우 단가를 편집하고</h6>
                                <h6 style="color:black;">통합 버튼을 클릭하세요.</h6>
                            </div>
                        </div>
                        <div class="card-body" style="background-color:lightgrey">

                            <div class="btn group col-md-7" style="color:black;">
                                <label>품목1</label>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 공연">
                                </div>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 공연">
                                </div>

                                <label>품목2</label>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 셋탑">
                                </div>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="4월 6000">
                                </div>

                                <label>품목3</label>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="" disabled>
                                </div>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="" disabled>
                                </div>

                                <label>품목4</label>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="" disabled>
                                </div>
                                <div class="btn-group col-md-5">
                                    <input class="form-control" value="" disabled>
                                </div>
                            </div>
                            <div class="btn group col-md-4">
                                <button class="btn btn-xl btn-warning" type="button" >2건 통합</button>
                            </div>
{{--                            <div--}}
{{--                                class=" btn group col-md-4 bs-toast toast fade show bg-warning"--}}
{{--                            >--}}
{{--                                <div class="toast-header">--}}
{{--                                </div>--}}
{{--                                <div class="toast-body">--}}
{{--                                    2건 통합--}}
{{--                                </div>--}}
{{--                            </div>--}}
                                <h4 class="fw-bold py-3 mb-4" style="color: #007bff; text-align: right">
                                <span class="text-muted fw-bold"> 통합 단가</span> 12,000<span class="text-muted fw-bold">원</span>
                            </h4>
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
                <div class="card-body" >
                    <div class="modal-body" >
                        <div class="row">
                            <div class="col mb-3">
                                <h6> 선택된 계산서가 최대 4개로 분할됩니다.</h6>
                                <h6>계산서 단가는 품목별로 분할되어 생성됩니다.</h6>
                                <h6>단가 수정이 필요한 경우 단가를 편집하고</h6>
                                <h6>분할 버튼을 클릭하세요.</h6>
                            </div>
                        </div>

                        <div class="card-body" style="background-color:lightgrey">
                            <div>
                                <div class="btn-group">
                                    <h5>분할 품목</h5>
                                </div>
                                <div class="btn-group">
                                    <div class="card-body">
                                        <select class="form-select">
                                            <option>2개</option>
                                            <option>3개</option>
                                            <option>4개</option>
                                        </select>
                                    </div>
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
                                <button class="btn btn-xl btn-info" type="button" style="width: 100%; color: black;" >
                                    <span>계산서</span>
                                    <span style="font-weight: bold; font-size: 30px">2</span>
                                    <span>개로 분할</span>
                                </button>
                            </div>
                            <div class="btn group col-md-5">
                                <h4 class="fw-bold py-3 mb-4" style="color: #007bff; text-align: right">
                                    <span class="text-muted fw-bold">  단가 총액</span> 12,000<span class="text-muted fw-bold">원</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
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
                <div class="card-body" >
                    <div class="modal-body" >
                        <div class="row">
                            <div class="col mb-3">
                                <h6>CRM에서 관리되는 서비스 이용료룰</h6>
                                <h6>자동으로 연결하여 단가 동기화를 진행합니다.</h6>
                                <h6 style="color: dodgerblue">입금내역이 매칭되지 않은 계산서만 적용됩니다.</h6>
                            </div>
                        </div>

                        <div class="card-body" style="background-color:lightgrey">
                            <div class="btn-group col-md-3">
                                <div class="form-check form-switch mb-2 ">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked />
                                </div>
                            </div>

                            <div class="btn-group col-md-5">
                                <div class="card-body w-px-250" style="text-align: center">
                                    <h5 style="color: black">지정월 전체 단가 동기화</h5>
                                </div>
                            </div>
                            <div class="btn-group col-md-2">
                                <div class="card">
                                    <div class="card-body">
                                        <span style="font-size: 30px; font-weight: bold">2</span><span style="font-size: 15px">건             </span>
                                    </div>
                                </div>
                            </div>
                            <h5 style="border: 1px dashed #bbb; "></h5>

                            <div class="btn group col-md-8">
                                <h6 style="color: black">해당 옵션이 활성화 될 경우 계산서 선택과 상관없이 </h6>
                                <h6 style="color: black">지정된 월의 전체 단가를 동기화 시켜줍니다.</h6>
                                <h6>(단, 입금내역이 미매칭된 계산서의 경우만 업데이트)</h6>
                            </div>
                        </div>


                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">동기화</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">취소</button>
                </div>
            </div>
        </div>

    </div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">정산 / 계산서 / </span>계산서 발행 조회
        </h4>

        <div class="form-floating">
            <div class="row">

                {{--            content left        --}}
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->
                            <h5 class="card-header" style="color: dodgerblue">계산서 발행 리스트</h5>

                            <div class="card-body">
                                {{--1~12번 호출--}}
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
                                {{--1~12번 end--}}
                            </div>
                            <div class="card-body">
                                <div class="btn-group col-md-4 form-floating">
                                    <div class="nav-align-top mb-4">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <button
                                                    type="button"
                                                    class="nav-link active"
                                                    role="tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#navs-top-1"
                                                    aria-controls="navs-top-1"
                                                    aria-selected="true">
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
                                                    aria-selected="false">
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
                                                    aria-selected="false">
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
                                                    aria-selected="false">
                                                    품목정보
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="btn-group col-md-5">
                                    <input type="text"
                                           class="form-control" placeholder="검색어를 입력하세요.">
                                </div>
                                <div class="btn-group" style="float:right">
                                    <button class="btn btn-success">목록 다운로드</button>
                                </div>
                            </div>

                            <div class="card-body">
                                <nav class="navbar navbar-example navbar-expand-lg navbar-light bg-light">
                                    <div class="horizontal-scrollable">
{{--                                    <div class="container-fluid ">--}}
{{--                                        class="card overflow-hidden mb-4"--}}
                                        <div class="btn-group">
                                            <button class="btn btn-primary">컬럼 일괄 업데이트</button>
                                        </div>

                                        <div class="btn-group">
                                            <input value="6000">
                                        </div>
                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>결제방식</option>
                                                <option>카드</option>
                                                <option>현금</option>
                                                <option>후불</option>
                                            </select>
                                        </div>
                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>결제주기</option>
                                                <option>반기납</option>
                                                <option>분납</option>
                                                <option>연납</option>
                                                <option>월납</option>
                                            </select>
                                        </div>
                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>내역</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>회신</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>거래명세서</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>세금계산서</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>발행날짜</option>
                                                <option>10일</option>
                                                <option>15일</option>
                                                <option>19일</option>
                                            </select>
                                        </div>


                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>사업자번호</option>
                                            </select>
                                        </div>


                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>상호명</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>대표자</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>주소</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>업태</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>종목</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>발행주소1</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>발행주소2</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>담당자1</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>연락처1</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>이메일1</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>담당자2</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>연락처2</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>이메일2</option>
                                            </select>
                                        </div>
                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>품목1</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>공급가액1</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>품목2</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>공급가액2</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>품목3</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>공급가액3</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>품목4</option>
                                            </select>
                                        </div>

                                        <div class="btn-group">
                                            <select class="form-select">
                                                <option>공급가액4</option>
                                            </select>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                            <div class="tab-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered border-bottom">
                                        <thead>
                                        <tr>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle active"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >본사명
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="javascript:void(0);">본사명1</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);">본사명2</a>
                                                        </li>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider"/>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);">Separated
                                                                link</a></li>
                                                    </ul>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle active"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >매장명
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="javascript:void(0);">매장명1</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);">매장명2</a>
                                                        </li>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider"/>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);">Separated
                                                                link</a></li>
                                                    </ul>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >단가
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >결제방식
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >결제주기
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >내역
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >회신
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >거래명세서
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >세금계산서
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >발행날짜
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <div class="card-body">
                                                            <li>
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="terms-conditions" name="terms"/>
                                                                <label class="form-check-label" for="terms-conditions">
                                                                    10일
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="terms-conditions" name="terms"/>
                                                                <label class="form-check-label" for="terms-conditions">
                                                                    15일
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="terms-conditions" name="terms"/>
                                                                <label class="form-check-label" for="terms-conditions">
                                                                    19일
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="terms-conditions" name="terms"/>
                                                                <label class="form-check-label" for="terms-conditions">
                                                                    20일
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <hr class="dropdown-divider"/>
                                                            </li>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >사업자번호
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >상호명
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >대표자
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >주소
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >업태
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >종목
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >발행주소1
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >발행주소2
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >담당자1
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >연락처1
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >이메일1
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >담당자2
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >연락처2
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >이메일2
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >품목1
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >공급가액1
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >품목2
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >공급가액2
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >품목3
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >공급가액3
                                                    </button>
                                                </div>
                                            </th>

                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >품목4
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="text-nowrap text-center">
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                    >공급가액4
                                                    </button>
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        {{-- <td class="align-middle"><small class="text-light fw-semibold">Text Highlight</small></td>--}}

                                        <tr class="text-center">
                                            <td class="text-nowrap">만렙커피</td>
                                            <td class="text-nowrap">신설동역점</td>
                                            <td class="text-nowrap"><mark>6000</mark></td>
                                            <td class="text-nowrap">CMS</td>
                                            <td class="text-nowrap">월납</td>
                                            <td class="text-nowrap">X</td>
                                            <td class="text-nowrap">X</td>
                                            <td class="text-nowrap">X</td>
                                            <td class="text-nowrap">25일</td>
                                            <td class="text-nowrap">25일</td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="text-nowrap">만렙커피</td>
                                            <td class="text-nowrap">신설동역점</td>
                                            <td class="text-nowrap"><mark>6000</mark></td>
                                            <td class="text-nowrap">CMS</td>
                                            <td class="text-nowrap">월납</td>
                                            <td class="text-nowrap">X</td>
                                            <td class="text-nowrap">X</td>
                                            <td class="text-nowrap">X</td>
                                            <td class="text-nowrap">25일</td>
                                            <td class="text-nowrap">25일</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
