<?php

namespace App\Helpers;

class Common
{
    public static function common() {
        return "common";
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
