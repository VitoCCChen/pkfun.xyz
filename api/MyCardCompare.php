<?php

include_once "_database.class.php";
include_once "_func.php";
$return_fal = "Request failed";
$db = Database::DB();
if(isset($_POST["StartDateTime"]) && !empty($_POST["StartDateTime"]) && isset($_POST["EndDateTime"]) && !empty($_POST["EndDateTime"])){
    $qry = "SELECT PaymentType,TradeSeq,MyCardTradeNo,FacTradeSeq,member_id,Amount,Currency,Pay_time FROM mycard WHERE Pay_time > :StartDateTime AND Pay_time < :EndDateTime";
    $result = $db->preparefetch_all_array($qry,[":StartDateTime" => post('StartDateTime',1) , ":EndDateTime" => post('EndDateTime',1)]);
    foreach ($result as $item){
        $date = new DateTime($item["Pay_time"]);
        $date_str = $date->format('Y-m-d')."T".$date->format('H:i:s');
        echo $item["PaymentType"].",".$item["TradeSeq"].",".$item["MyCardTradeNo"].",".$item["FacTradeSeq"].",".$item["member_id"].",".$item["Amount"].",".$item["Currency"].",".$date_str."<BR>";
    }

}else if(isset($_POST["MyCardTradeNo"]) && !empty($_POST["MyCardTradeNo"])){
    $qry = "SELECT PaymentType,TradeSeq,MyCardTradeNo,FacTradeSeq,member_id,Amount,Currency,Pay_time FROM mycard WHERE MyCardTradeNo = :MyCardTradeNo";
    $result = $db->query_prepare_first($qry,[":MyCardTradeNo" => post('MyCardTradeNo',1)]);
    if($result==false){
        echo "No Data";
    }else{
        extract($result);
        $date = new DateTime($Pay_time);
        $date_str = $date->format('Y-m-d')."T".$date->format('H:i:s');
        $result_String = $PaymentType.",".$TradeSeq.",".$MyCardTradeNo.",".$FacTradeSeq.",".$member_id.",".$Amount.",".$Currency.",".$date_str."<BR>";
        echo $result_String;
    }
}else{
    echo $return_fal;
}

?>
