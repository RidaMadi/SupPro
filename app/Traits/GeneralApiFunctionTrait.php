<?php

namespace App\Traits;

trait GeneralApiFunctionTrait{
    public function ReturnSuccessMessage($msg){
        return response()->json([
            'Status' => true,
            'ErrNum' => '0007',
            'Msg' => $msg
        ]);
    }

    public function ReturnSuccessData($msg,$data){
        return response()->json([
            'Status' => true,
            'ErrNum' => '0008',
            'Msg' => $msg,
            'Data' => $data
        ]);
    }

    public function ReturnErrorMessage($err_num , $msg){
        return response()->json([
            'Status' => false,
            'ErrNum' => $err_num,
            'Msg' => $msg
        ]);
    }
}