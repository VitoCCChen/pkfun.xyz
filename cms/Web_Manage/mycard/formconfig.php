<?php
$fhelp=new coderFormHelp();
$fobj=array();
$fobj[$colname["id"]]=array("type"=>"hidden","name"=>"ID","column"=>$colname["id"],"sql"=>false);
    $fobj[$colname['FacTradeSeq']]=array('type'=>'text','name'=>'第三方交易序號','column'=>$colname['FacTradeSeq']);
    $fobj[$colname['TradeSeq']]=array('type'=>'text','name'=>'MyCard交易序號','column'=>$colname['TradeSeq']);
    $fobj[$colname['agent_id']]=array('type'=>'text','name'=>'代理ID','column'=>$colname['agent_id']);
    $fobj[$colname['member_id']]=array('type'=>'text','name'=>'會員帳號','column'=>$colname['member_id']);
    $fobj[$colname['PaymentType']]=array('type'=>'text','name'=>'付款方式','column'=>$colname['PaymentType']);
    $fobj[$colname['MyCardTradeNo']]=array('type'=>'text','name'=>'MyCard卡號','column'=>$colname['MyCardTradeNo']);
    $fobj[$colname['MyCardType']]=array('type'=>'text','name'=>'通路代碼','column'=>$colname['MyCardType']);
    $fobj[$colname['PromoCode']]=array('type'=>'text','name'=>'活動代碼','column'=>$colname['PromoCode']);
    $fobj[$colname['product_id']]=array('type'=>'text','name'=>'產品ID','column'=>$colname['product_id']);
    $fobj[$colname['Amount']]=array('type'=>'text','name'=>'金額','column'=>$colname['Amount']);
    $fobj[$colname['Currency']]=array('type'=>'text','name'=>'幣別','column'=>$colname['Currency']);
$fhelp->Bind($fobj);
