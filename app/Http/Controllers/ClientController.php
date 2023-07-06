<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Service\ClientService;

class ClientController extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected ClientService $clientService;

    public function __construct(ClientService $clientService){
        $this->clientService = $clientService;
    }

    public function getStoreInfo(Request $request) {
        /**
         * 검색어가 없을 경우 start
         */
        if (!$request->filled("sch_val")) {
            print_r("empty");
            return response()->json(
                array(
                    "status"=>"empty"
                )
            );
        }

        $items = $this->clientService->getClientStoreList($request->input());

        return response()->json(
            array(
                "status"=>"ok",
                "result"=>json_encode($items)
            )
        );
    }


    public static function chargeNonMemberRegist(){
        return view('charge.nonMemberRegistView');
    }

    public static function chargeMember(Request $request){
        return view('charge.chargeRegistView');
    }

    public static function chargeNonMember(Request $request){

    }


}
