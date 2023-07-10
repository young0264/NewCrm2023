<?php
namespace App\Service;
use App\Helpers\Common;
use App\Models\BRClient;
use App\Models\SCShop;

class ClientService {

    private static array $convert_oracle_names_to_mysql = array(
        'f_loginid' => 'client_id',
        'f_bizname' => 'company_name',
        'f_shopname' => 'client_name'
    );

    /**
     * select input검색 name값 : oracle
     */
    private static $select_search_key_oracle = array(
        'f_loginid', 'f_bizname', 'f_shopname'
    );

    /**
     * select input검색 name값 : mysql
     */
    private static $select_search_key_mysql = array(
        'client_id', 'company_name', 'client_name'
    );

    /**
     * 고객검색 리스트 가져오기
     * 샵캐스트      => SC
     * 브랜드라디오   => BR
     * 샵앤뮤직      => SM
     * 샵캐스트    => SHOPCAST
     * 브랜드라디오   => NUCATS
     * 샵앤뮤직      => SHOPNMUSIC
     * f_company = F_OSP
     * f_site = F_ADMIN
     */
    public static function getClientStoreList(array $request) {
        $oracleResults = self::getStoreListByOracle($request);
        $mysqleResults = self::getStoreListByMysql($request);
        $result = array_merge($oracleResults, $mysqleResults);
        return $result;
    }

    /**
     * oracle (샵캐스트) 리스트 가져오기
     */
    private static function getStoreListByOracle(array $request) {
        $results = array();
        $search_conditions = self::makeOracleSearchConditions($request);
        $oracle_items = SCShop::list($search_conditions['wheres'], $search_conditions['binds']);
        foreach ($oracle_items as $idx => $item) {
            $results[] = array(
                "f_loginid"=>$item->f_loginid,  //로그인id
                "f_company"=>Common::getSite(), // F_OSP
                "f_site"=>"SC",                 // F_ADMIN
                "f_bizid"=>$item->f_bizid,      //브랜드 id
                "f_bizname"=>$item->f_bizname,  //브랜드 이름
                "f_shopid"=>$item->f_shopid,
                "f_shopname"=>$item->f_shopname //매장명
            );
        }
        return $results;
    }

    /**
     * mysql (브랜드라디오) 리스트 가져오기
     */
    private static function getStoreListByMysql(array $request) {
        $results = array();
        $search_conditions = self::makeMysqlSearchConditions($request);
        $mysql_items = BRClient::list($search_conditions['wheres'], $search_conditions['binds']);

        foreach ($mysql_items as $idx => $item) {
            $results[] = array(
                "f_loginid"=>$item->client_id,
                "f_company"=>Common::getSite(),
                "f_site"=>"BR",
                "f_bizid"=>$item->companys,
                "f_bizname"=>$item->company_name,
                "f_shopid"=>$item->clients,
                "f_shopname"=>$item->client_name
            );
        }
        return $results;
    }

    /**
     * oracle 검색조건 만들기(where절, bind값 return)
     */
    private static function makeOracleSearchConditions(array $request) {
        $wheres = "";
        $binds = array();

        if ($request['sch_key'] != "tonghap") {
            $wheres .= " and (";
            $wheres .= $request['sch_key'] . " like :sch_val";
            $wheres .= ")";
            $binds += array("sch_val" => "%" . $request['sch_val'] . "%");
        }

        if ($request['sch_key'] == "tonghap") {
            $wheres .= " and (";
            foreach(self::$select_search_key_oracle as $search_key) {
                $wheres .= "{$search_key} like :sch_val or ";
            }
            $wheres = substr($wheres, 0, -3);
            $wheres .= ")";
            $binds += array("sch_val" => "%" . $request['sch_val'] . "%");
        }
        $wheres .= " and f_company=:f_company and f_status=:f_status";
        $binds['F_COMPANY'] = Common::getSite();
        $binds['F_STATUS'] = "OK";

        return [
            "wheres" => $wheres,
            "binds" => $binds
        ];
    }

    /**
     * mysql 검색조건 만들기(where절, bind값 return)
     * mysql에서 binding처리는 같은 name 값이 있으면 안됨
     */
    private static function makeMysqlSearchConditions(array $request) {
        $wheres = "";
        $binds = array();
        $wheres .= " and group_site=:group_site and status in (578, 105)";
        $binds['group_site'] = Common::getGroupSite();
        $count = 0;

        if ($request['sch_key'] != "tonghap") {
            $sch_key = self::$convert_oracle_names_to_mysql[$request['sch_key']];
            $wheres .= " and (";
            $wheres .= $sch_key . " like :sch_val";
            $wheres .= ")";
            $binds += array("sch_val" => "%" . $request['sch_val'] . "%");
        }

        if ($request['sch_key'] == "tonghap") {
            $wheres .= " and (";
            foreach(self::$select_search_key_mysql as $search_key) {
                $count += 1;
                $countToString = (string)$count;
                $wheres .= "{$search_key} like :sch_val{$countToString} or ";
                $binds += array("sch_val".$countToString => "%" . $request['sch_val'] . "%");
            }
            $wheres = substr($wheres, 0, -3);
            $wheres .= ")";
        }

        return [
            "wheres" => $wheres,
            "binds" => $binds
        ];
    }

}
