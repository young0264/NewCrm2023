<?php

namespace App\Helpers;

class Common
{
    private static $nucatsSite = array("SC"=>"SHOPCAST", "BR"=>"NUCATS", "SM"=>"SHOPNMUSIC");

    public static array $convert_oracle_osp_to_mysql = array(
        'SC' => 'SHOPCAST',
        'BR' => 'NUCATS',
        'SM' => 'SHOPNMUSIC'
    );

    public static function common() {
        return "common";
    }

    //TODO: getSite, getCompany, getGroupSite 정리
    public static function getSite() {
        return strtoupper(explode("-", explode(".", request()->server("HTTP_HOST"))[0])[1]);
    }

    /**
     * @return string
     * ORACLE DB의 각 사이트 별 파라미터 ( SC, BR, SM )
     */
    public static function getCompany() {
        return strtoupper(explode("-", explode(".", request()->server("HTTP_HOST"))[0])[1]);
    }

    /**
     * @return string
     * Mysql DB의 각 사이트 별 파라미터 ( SHOPCAST, NUCATS, SHOPNMUSIC )
     */
    public static function getGroupSite() {
        return self::$nucatsSite[strtoupper(explode("-", explode(".", request()->server("HTTP_HOST"))[0])[1])];
    }

    public static function assoArr() {
        return array(
            "KOMCA"=>array(
                "name"=>"음저협",
                "product"=>"공연사용료"
            ),
            "KOSCAP"=>array(
                "name"=>"함저협",
                "product"=>"공연사용료"
            ),
            "FKMP"=>array(
                "name"=>"음실련",
                "product"=>"공연보상금"
            ),
            "KAPP"=>array(
                "name"=>"연제협",
                "product"=>"공연보상금"
            )
        );
    }
}
