<?php

namespace App\Helpers;

class Pagination
{
    public static function paging() {
        return "paging";
    }

    /**
     * @param $query : 페이징을 적용시킬 데이터의 query
     * @param $currentPage : 현재 이동해 있는 page number
     * @param $rowsPerPage : 한 페이지에 보여줄 row 개수
     * return : 페이징을 적용시킬 query, Model로 return
     */
    /**
     * @param $query : 페이징을 적용시킬 데이터의 query
     * @param $total_data_cnt : 페이징을 적용시킬 데이터의 갯수
     * @param $currentPage : 현재 이동해 있는 page number
     * @param $rowsPerPage : 한 페이지에 보여줄 row 개수
     * @param $pageNavRange : 페이징 네비게이션에 보여줄 페이지 범위
     * @return array : 페이징을 적용시킬 query, Model로 return
     */
    public static function paginate($query, $total_data_cnt,  $currentPage, $rowsPerPage, $pageNavRange)
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
        $start_page = max(1, $currentPage-$pageNavRange);
        $end_page = min($max_page, $currentPage+$pageNavRange);

        return [
            'paged_query' => $paged_query,
            'max_page' => $max_page,
            'start_page' => $start_page,
            'end_page' => $end_page,
        ];

    }
}
