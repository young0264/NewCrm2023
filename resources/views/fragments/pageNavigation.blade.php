<?php
/**
 * $currentPage : 현재 페이지
 * $start_page : navigation 시작점
 * $end_page : navigation 끝점
 * $max_page : 페이지 끝장
 */
?>


<div class="page-navigation">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item first">
                <a class="page-link"  onclick="pagination(1)">
                    <i class="tf-icon bx bx-chevrons-left"></i>
                </a>
            </li>
            <li class="page-item prev">
                <a class="page-link" onclick="pagination({{$currentPage-1}})" >
                    <i class="tf-icon bx bx-chevron-left"></i>
                </a>
            </li>

            @for($i = $start_page; $i <=$end_page; $i++)
                <li class="page-item {{request('page') == $i ? "active" : ""}}" >
                    <a class="page-link" onclick="pagination({{$i}})">{{$i}}</a>
                </li>
            @endfor

            <li class="page-item next">
                <a class="page-link" onclick="pagination({{$currentPage+1}})">
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
