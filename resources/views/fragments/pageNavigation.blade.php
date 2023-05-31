@php use Illuminate\Support\Facades\Request; @endphp
@php
    /**
     * [PAGINATION NAVIGATION INCLUDE]
     *
     * $currentPage : 현재 페이지
     * $start_page : navigation 시작점
     * $end_page : navigation 끝점
     * $max_page : 페이지 끝장
     */

@endphp
<div class="page-navigation">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item first">
                <a class="page-link" href="{{URL::current()."?".Request::getQueryString()."&page=1"}}">
{{--                <a class="page-link" href="#" onclick="pagination(1)">--}}

                    <i class="tf-icon bx bx-chevrons-left"></i>
                </a>
            </li>
            <li class="page-item prev">
                <a class="page-link" href="{{ route('depositList')."?".Request::getQueryString()."&page=". max((intdiv($currentPage, $page_gap)-1)*$page_gap+1, 1 )}}">
{{--                <a class="page-link" href="#" onclick="pagination({{(($currentPage-$page_gap) > 1 ? ($currentPage-$page_gap) : 1 )}})" >--}}

                    <i class="tf-icon bx bx-chevron-left"></i>
                </a>
            </li>
            @for($i = $start_page; $i <= $end_page; $i++)
                <li class="page-item {{$currentPage == $i ? "active" : ""}}">
                    <a class="page-link" href="{{route('depositList')."?".Request::getQueryString()."&page=".$i}}">{{$i}}</a>
{{--                    <a class="page-link" href="#" onclick="pagination({{$i}})">{{$i}}</a>--}}
                </li>
            @endfor
            <li class="page-item next">
                <a class="page-link" href="{{ route('depositList')."?".Request::getQueryString()."&page=".(min((intdiv($currentPage, $page_gap)+1)*$page_gap+1, $max_page))}}">
{{--                <a class="page-link" href="#" onclick="pagination({{($currentPage+$page_gap)>$max_page ? $max_page : ($currentPage+$page_gap)}})">--}}
                    <i class="tf-icon bx bx-chevron-right"></i>
                </a>
            </li>
            <li class="page-item last">
                <a class="page-link" href="{{URL::current()."?".Request::getQueryString()."&page=".$max_page}}">
{{--                <a class="page-link" href="#" onclick="pagination({{$max_page}})">--}}
                    <i class="tf-icon bx bx-chevrons-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>
