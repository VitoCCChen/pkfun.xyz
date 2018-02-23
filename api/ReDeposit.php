<?php
include_once('codermycardhelp.php');
include_once('_func.php');
header('Content-type:application/json; charset=utf-8');


$data = post('DATA',2);
$opt = json_decode($data);


$ReturnCode = $opt->ReturnCode;
$ReturnMsg = $opt->ReturnMsg;
$FacServiceId = $opt->FacServiceId;
$TotalNum = $opt->TotalNum;
$FacTradeSeq = $opt->FacTradeSeq;



$suc_resultback = array(
    'ReturnCode' => '1',
    'ReturnMsg' => 'Access succeeded.'
);

$fal_resultback = array(
    'ReturnCode' => '2',
    'ReturnMsg' => 'Access faild, Something goes wrong.'
);

if(!empty($ReturnCode) && $FacServiceId == "luckySG" && isset($FacTradeSeq)){

    $datetime = date('Y-m-d H:i:s',time());
    $redepositcheck = true;
    $mycard = new coderMycardHelp();
    if($TotalNum == 1){

        $data = array(
            'FacTradeSeq' => $FacTradeSeq[0],
            'ReturnCode' => $ReturnCode,
            'PaymentType' => null,
            'Redeposit' => 1
        );



        $mycard->MycardProcess($data);


    }else if($TotalNum > 1){
        foreach ($FacTradeSeq as $TradeSeq) {

            $data = array(
                'FacTradeSeq' => $TradeSeq,
                'ReturnCode' => $ReturnCode,
                'PaymentType' => null,
                'Redeposit' => 1
            );


            $mycard->MycardProcess($data);

        }
        $db = Database::DB();
        $db->close();

    }
    echo json_encode($suc_resultback);
}else{
    echo json_encode($fal_resultback);
}