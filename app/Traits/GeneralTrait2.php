<?php

namespace App\Traits;

trait GeneralTrait2{
    public function SuccessMessage($msg){
        return response()->json([
            'Status' => true,
            'ErrNum' => '0007',
            'Msg' => $msg
        ]);
    }

    public function SuccessData($msg,$data){
        return response()->json([
            'Status' => true,
            'ErrNum' => '0008',
            'Msg' => $msg,
            'Data' => $data
        ]);
    }

    public function ErrorMessage($err_num , $msg){
        return response()->json([
            'Status' => false,
            'ErrNum' => $err_num,
            'Msg' => $msg
        ]);
    }
}
