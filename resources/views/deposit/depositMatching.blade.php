
@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">정산 / 입금내역 / </span>입금내역 매칭(1)
    </h4>

    <div class="row ">
        <div class="col-md-3">
            <div class="form-control">
                <div class="card-body">
                    <h4 class="text-primary text-center ">고객 검색</h4>
                </div>
                <div>
                    <div class="btn-group">
                        <select class="form-select">
                            <option>결제수단</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select class="form-select">
                            <option>신탁여부</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <select class="form-select">
                            <option>통합</option>
                        </select>
                    </div>
                </div>
                <div>
                    <input class="form-control alert-secondary my-2" placeholder="검색어를 입력하세요.">
                </div>
                <div>
                    <div class="form-control alert alert-primary">
                        <h5 class="text-primary">(월납) 커피스미스</h5>
                        <h4 class="text-primary">커피스미스포항오천점</h4>
                        <h5><span class="text-info">194,700</span>원</h5>
                        <h5 class="text-muted">506-20-84466</h5>
                        <h5 class="text-muted">포항오천점(1231234A)</h5>
                    </div>
                    <div class="alert alert-secondary form-control outline">
                        <div>
{{--                            <button class="btn-close float-end"></button>--}}
                            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                        <div class="mx-2 my-4">
                                <button  class="btn btn-primary ">확정</button>
                                <button  class="btn btn-success  ">담기</button>
                                <button  class="btn btn-secondary ">히스토리 확정</button>
                        </div>
                        <div class=" fw-bold">
                            <h3>7231231A
                                <span class=" text-muted">정보</span>
                            </h3>
                        </div>
                        <div class="row">
                            <div class="btn-group my-2">
                                <div class="col-md-4">
                                    <h5>매장명</h5>
                                </div>
                                <div class="col-md-7">
                                    <input class="form-control" placeholder="매장명">
                                </div>
                            </div>
                            <div class="btn-group my-2">
                                <div class="col-md-4">
                                    <h5>상호명</h5>
                                </div>
                                <div class="col-md-7">
                                    <input class="form-control" placeholder="상호명">
                                </div>
                            </div>
                            <div class="btn-group my-2">
                                <div class="col-md-4">
                                    <h5>대표자명</h5>
                                </div>
                                <div class="col-md-7">
                                    <input class="form-control" placeholder="대표자명">
                                </div>
                            </div>
                            <div class="btn-group my-2">
                                <div class="col-md-4">
                                    <h5>사업자번호</h5>
                                </div>
                                <div class="col-md-7">
                                    <input class="form-control" placeholder="사업자번호">
                                </div>
                            </div>
                            <div class="btn-group my-2">
                                <div class="col-md-4">
                                    <h5>주소</h5>
                                </div>
                                <div class="col-md-7">
                                    <input class="form-control" placeholder="주소">
                                </div>
                            </div>
                            <div class="btn-group my-2">
                                <div class="col-md-4">
                                    <h5>발행주소1</h5>
                                </div>
                                <div class="col-md-7">
                                    <input class="form-control" placeholder="발행주소1">
                                </div>
                            </div>
                            <div class="btn-group my-2">
                                <div class="col-md-4">
                                    <h5>발행주소2</h5>
                                </div>
                                <div class="col-md-7">
                                    <input class="form-control" placeholder="발행주소2">
                                </div>
                            </div>
                            <div class="btn-group my-2">
                                <div class="col-md-4">
                                    <h5>단가</h5>
                                </div>
                                <div class="col-md-7">
                                    <input class="form-control" placeholder="단가">
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="text-primary text-center"> 청구 대상 컬럼 모두 출력</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-control">
                <div class="card-body">
                    <h4 class="text-primary text-center">1차 완전한 매칭 - 검토 리스트</h4>
                </div>
                <div class="float-end">
                    <button class="btn btn-primary my-2">돌아가기</button>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID 검색</th>
                        <th>거래일자</th>
                        <th>의뢰인</th>
                        <th>입금액</th>
                        <th>거래구분</th>
                        <th>거래점</th>
                        <th>검토</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-primary">723153</td>
                        <td>2023-03-03</td>
                        <td>YES24</td>
                        <td class="text-primary">61,000</td>
                        <td>전자금융</td>
                        <td>하나금융</td>
                        <td class="text-primary">완료</td>
                    </tr>
                    <tr>
                        <td class="text-primary">723153</td>
                        <td>2023-03-03</td>
                        <td>(주)91컴퍼니</td>
                        <td class="text-primary">514.800</td>
                        <td>전자금융</td>
                        <td>하나금융</td>
                        <td>
                            <button class="btn btn-secondary">확정</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-primary">723153</td>
                        <td>2023-03-03</td>
                        <td>교보문고</td>
                        <td class="text-primary">61,000</td>
                        <td>전자금융</td>
                        <td>하나금융</td>
                        <td>
                            <button class="btn btn-secondary">확정</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-secondary">null</td>
                        <td>2023-03-03</td>
                        <td>교보문고</td>
                        <td class="text-primary">61,000</td>
                        <td>전자금융</td>
                        <td>하나금융</td>
                        <td class="text-danger">미매칭
                        </td>
                    </tr>
                    <tr>
                        <td class="text-primary">723153</td>
                        <td>2023-03-03</td>
                        <td>알라딘</td>
                        <td class="text-primary">61,000</td>
                        <td>전자금융</td>
                        <td>하나금융</td>
                        <td>
                            <button class="btn btn-secondary">확정</button>
                        </td>                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@stop
