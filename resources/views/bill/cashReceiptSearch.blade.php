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
    <div id='right_click_menu' class="custom-context-menu" style="display: none; z-index: 99">
        <div class="row">
            <div class="col-md-12 col-12 mb-3 mb-md-0">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">현금 영수증 분할</a>
                    <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">현금 영수증 통합</a>
                    <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">단가 동기화</a>
                    <a class="list-group-item list-group-item-action " data-bs-toggle="modal" data-bs-target="#">현금 영수증 삭제</a>
                </div>
            </div>
        </div>
    </div>


    </div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">정산 / 계산서 / </span>현금 영수증 조회
        </h4>

        <div class="form-floating">
            <div class="row">

                {{--            content left        --}}
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Notifications -->
                            <h5 class="card-header text-primary">현금 영수증 리스트</h5>

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
                                            <input class="form-control" value="6000">
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
                                <div class="table-responsive" id="both-scrollbars-example">
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
                                        @for($i=0; $i<5; $i++ )
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
                                        @endfor
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
