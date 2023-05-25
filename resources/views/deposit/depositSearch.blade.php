{{-- 정산 / 입금내역 / 입금내역 등록, 조회 --}}
@extends('layouts.app')
@section('content')
<script>
    function pagination(pageNumber) {
        var urlparams = new URLSearchParams(window.location.search);
        var urlparams = urlparams.toString().replace(/(&|\?|^)page=\d+/gi, '');
        location.href = "{{route('depositList')}}?" + urlparams + "&page="+pageNumber;
    }

    function onSearch(formid) {
        var formData = new FormData(document.getElementById(formid));
        formData.append('page','1');
        formData.submit();
    }

    function modalClose(modalId) {
        $('#'+modalId).modal('hide');
    }

    const excel = {
        download:function() {
            location.href="{{route('depositList')}}?mode=excel&{{request()->getQueryString()}}";
        },

        upload:function() {
            const file = document.getElementById("file");
            let form = new FormData();
            const pay_systems = (document.getElementsByName("f_pay_system"));

            form.append("file", file.files[0]);

            pay_systems.forEach(function (item, index) {
                if (item.checked) {
                    alert(item.value);
                    // checked_data['f_pay_system'] = item.value;
                    form.append('f_pay_system', item.value);
                }
            });

            $.ajax({
                // ('excelImportProcess')
                url : "{{route('depositUpload')}}",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type : "POST",
                processData : false,
                contentType : false,
                data : form,
                dataType : "json",
                success: function (response) {
                    if (response['status'] === "ok") {
                        alert("deposit save status ok");
                        modalClose('deposit_upload');
                    }
                },
                error: function (err) {
                    alert("error : " + err.responseText);
                }
            });
        },
    }
</script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">정산 / 입금내역 / </span>입금내역 등록, 조회
    </h4>

    <div class="form-floating">
        <div class="row">
            {{--            content left        --}}
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="card">
                        <!-- Notifications -->
                        <h4 class="card-header text-primary">입금 등록 현황</h4>

                        <div class="card-body">
{{--                            <form id="search_form" action="{{route('depositList')}}">--}}
                            <form id="search_form">
                                <div class="card-body">
                                <div class="my-2">
                                    <div class="btn-group">
                                        <select class="form-select" id="sch_year" name="sch_year">
                                            <option value="">연도선택</option>
                                            <option value="2023" {{request('sch_year')=="2023" ? "selected" : ""}}>2023년</option>
                                            <option value="2022" {{request('sch_year')=="2022" ? "selected" : ""}}>2022년</option>
                                            <option value="2021" {{request('sch_year')=="2021" ? "selected" : ""}}>2021년</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <select class="form-select" id="sch_month" name="sch_month">
                                            <option value="">월선택</option>
                                            @for($i=1; $i<=12; $i++)
                                                <option value="{{sprintf("%02d", $i)}}" {{request('sch_month')==sprintf("%02d", $i) ? "selected" : ""}}>{{sprintf("%02d", $i)}}월</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <select class="form-select" id="sch_day" name="sch_day">
                                            <option value="">일선택</option>
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{sprintf("%02d", $i)}}" {{request('sch_day')==sprintf("%02d", $i) ? "selected" : ""}}>{{sprintf("%02d", $i)}}일</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <select class="form-select btn-success">
                                            <option class="form-control">입금액 초과</option>
                                            <option class="form-control">입금액 전체</option>
                                            <option class="form-control">입금액 초과</option>
                                            <option class="form-control">입금액 미만</option>
                                            <option class="form-control">입금액 합산</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="btn-group">
                                        <select class="form-select" name="f_account">
                                            <option value="">계좌선택</option>
                                            <option value="account_all">계좌전체</option>
                                            <option value="592201-01-513261" {{request('f_account')=="592201-01-513261" ? "selected" : ""}}>592201-01-513261</option>
                                            <option value="140-009-167369" {{request('f_account')=="140-009-167369" ? "selected" : ""}}>140-009-167369</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <select class="form-select" id="sch_cols" name="sch_cols">
                                            <option value="">검색 필드선택</option>
                                            <option value="sch_all" {{request('sch_cols')=="sch_all" ? "selected" : ""}}>전체</option>
                                            <option value="f_company" {{request('sch_cols')=="f_company" ? "selected" : ""}}>기업명</option>
                                            <option value="f_client" {{request('sch_cols')=="f_client" ? "selected" : ""}}>의뢰인</option>
                                            <option value="f_payment" {{request('sch_cols')=="f_payment" ? "selected" : ""}}>입금액</option>
                                            <option value="f_trans_type" {{request('sch_cols')=="f_trans_type" ? "selected" : ""}}>거래구분</option>
                                            <option value="f_trade_branch" {{request('sch_cols')=="f_trade_branch" ? "selected" : ""}}>거래점</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <input class="form-control" id="sch_val" name="sch_val" value="{{request('sch_val')}}" placeholder="검색어를 입력하세요.">
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-success" onclick="onSearch('search_form')">검색</button>
                                    </div>

                                    <div class="btn-group float-end mx-1">
{{--                                        <a class="btn btn-success float-end" onclick="" href="{{route('downloadExcel',['parameter'=>request()->query()])}}">--}}
                                        <a class="btn btn-success float-end" href="#" onclick="excel.download()" >
                                            엑셀 다운로드
                                        </a>
                                    </div>
                                    <div class="btn-group float-end mx-1">
                                        <button
                                            type="button"
                                            class="btn btn-success float-end"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deposit_upload">입금내역 업로드
                                        </button>
                                    </div>
                                    <div class="modal fade" id="deposit_upload" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>입금내역 업로드</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <div class="form-control">
                                                            <h6 class="text-muted">파일 형식이 정확해야 합니다.</h6>
                                                            <h6 class="text-muted">샘플이 필요하신 경우 파일을 다운로드하세요. </h6>
                                                            <button class="btn btn-success">무통장</button>
                                                            <button class="btn btn-success">CMS</button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="text-black ">입금내역 유형을 선택하세요</h5>
                                                        <div class="alert-secondary rounded ">
                                                            <div class="card-body row" id="radio_check">
                                                                <div class="my-2">
                                                                    <input  type="radio" id="f_pay_system1" name="f_pay_system" value="무통장" checked><label for="f_pay_system1" class="text-black fw-bold mx-1">무통장</label>
                                                                </div>

                                                                <div class="my-2">
                                                                    <input  type="radio" id="f_pay_system2" name="f_pay_system" value="CMS"><label for="f_pay_system2" class="text-black fw-bold mx-1">CMS</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="text-black ">입금내역 엑셀 파일을 선택하세요.</h5>
                                                        <input type="file" class="form-control" id="file" name="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                                    </div>
                                                    <div class="text-center">
                                                        <button class="btn btn-primary" type="button" id="btn"  onclick="excel.upload()">업로드</button>
                                                        {{--  <button class="btn btn-primary">업로드</button>  --}}
                                                        <button class="btn btn-secondary" onclick="modalClose('deposit_upload')">취소</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <table class="table">
                                <thead class="table-primary">
                                <tr>
                                    <th>아이디</th>
                                    <th>기업명</th>
                                    <th>은행</th>
                                    <th>계좌</th>
                                    <th>거래일자</th>
                                    <th>의뢰인</th>
                                    <th>입금액</th>
                                    <th>거래구분</th>
                                    <th>거래점</th>
                                    <th>작성자</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($depositList as $deposit)
                                    <tr>
                                        <td>{{$deposit->f_depositid}}</td>
                                        <td>{{$deposit->f_company}}</td>
                                        <td>{{$deposit->f_bank}}</td>
                                        <td>{{$deposit->f_account}}</td>
                                        <td>{{$deposit->f_trans_date}}</td>
                                        <td>{{$deposit->f_client}}</td>
                                        <td>{{$deposit->f_payment}}</td>
                                        <td>{{$deposit->f_trans_type}}</td>
                                        <td>{{$deposit->f_trade_branch}}</td>
                                        <td>{{$deposit->f_user}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body align">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item first">
                                        <a class="page-link"  onclick="pagination(1)">
                                            <i class="tf-icon bx bx-chevrons-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item prev">
                                        <a class="page-link" onclick="pagination({{$now_page-1}})" >
                                            <i class="tf-icon bx bx-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($i = $start_page; $i <=$end_page; $i++)
                                        <li class="page-item {{request('page') == $i ? "active" : ""}}" >
                                            <a class="page-link" onclick="pagination({{$i}})">{{$i}}</a>
                                        </li>
                                    @endfor

                                    <li class="page-item next">
                                        <a class="page-link" onclick="pagination({{$now_page+1}})">
                                            <i class="tf-icon bx bx-chevron-right"></i>
                                        </a>
                                    </li>
                                    <li class="page-item last">
                                        <a class="page-link" onclick="pagination({{$max_page}})">
                                            <i class="tf-icon bx bx-chevrons-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
