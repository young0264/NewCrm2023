<?php

namespace App\Helpers;

class Pagination
{

    /**
     * @param $query : 페이징을 적용시킬 데이터의 query
     * @param $total_data_cnt : 페이징을 적용시킬 데이터의 갯수
     * @param $currentPage : 현재 이동해 있는 page number
     * @param $rowsPerPage : 한 페이지에 보여줄 row 개수
     * @param $pageNavRange : 페이징 네비게이션에 보여줄 페이지 범위
     * @return array : 페이징을 적용시킬 query, Model로 return
     * max_page : 페이징 nav의 전체 갯수
     * min_page : 현재 페이지 기준으로 보여줄 페이징 nav의 시작
     * end_page : 현재 페이지 기준으로 보여줄 페이징 nav의 끝
     */

    public static function paginate($query, $total_data_cnt,  $currentPage, $rowsPerPage, $page_gap)
    {
        $skip_page = ($currentPage - 1) * $rowsPerPage;
        $paged_query = "
            select * from
                (select
                     t1.*,
                     ROWNUM AS rn
                    from
                        (select *
                             from ($query)
                                where rownum <= ($skip_page+$rowsPerPage)
                        ) t1
                    )
         where rn > $skip_page
         ";

        $max_page = ceil($total_data_cnt / $rowsPerPage);
        $start_page = max(1,  $currentPage%$page_gap==0 ? floor(($currentPage-1) / $page_gap)*$rowsPerPage + 1 : floor($currentPage / $page_gap)*$rowsPerPage + 1);
        $end_page = min($max_page, $start_page + $page_gap-1);

        return [
            'paged_query' => $paged_query,
            'max_page' => $max_page,
            'start_page' => $start_page,
            'end_page' => $end_page,
            'page_gap' => $page_gap
        ];

    }
}
