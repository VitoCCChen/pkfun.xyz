<?php
include "_database.class.php";
header('Content-type:application/json; charset=utf-8');

$result =array(
    'success' => "true",
    'result' => '',
    'message' => "request successful"
);
try{
    $db = Database::DB();

    isset($_GET["id"])?$id=$_GET["id"]:null;
    isset($_GET["page_num"])?$lim=$_GET["page_num"]:$lim=5;
    isset($_GET["page"])?$page=$_GET["page"]:$page=1;

    isset($id)?
        $row_count = count( $db->fetch_all_array("SELECT p.ep_id FROM program_episode p where p.ep_pgram_id=".$id) ):
        $row_count = count( $db->fetch_all_array("SELECT p.ep_id FROM program_episode p") );

    $row['data_count'] =  strval($row_count);
    $row['page_num'] = $lim;
    ($row_count%$lim > 0)?$row['total_page']=strval(ceil($row_count/$lim)):$row['total_page']=strval($row_count/$lim);
    $row['page'] = $page;
    $begin=$lim*($page-1);

    $sql = "SELECT e.ep_id, p.pgram_name, e.ep_anchors, e.ep_start_time, e.ep_end_time ,
                        SEC_TO_TIME( TIMESTAMPDIFF(SECOND, e.ep_start_time, e.ep_end_time) ) as episode_length,
                        (SELECT COUNT(*) FROM program_chatroom a WHERE a.cl_record_id=e.ep_id) as chat_count,
                        e.ep_updatetime, e.ep_lastmanage
                        FROM program_episode e 
                        LEFT join program p
                        on e.ep_pgram_id=p.pgram_id";


    $Limit = " LIMIT ".$begin.",".$lim;
    $order = " ORDER BY e.ep_createtime";
    if(isset($id))
    {
        $where = " WHERE e.ep_pgram_id=:id";

        $row['data'] = $db->preparefetch_all_array($sql.$where.$order.$Limit, array(":id"=>$_GET["id"]) );
    }
    else
    {
        //$where = " WHERE ep_id >= (SELECT ep_id FROM program_episode ORDER BY ep_createtime LIMIT ".$begin." , 1)";
        $row['data'] = $db->fetch_all_array( $sql.$order.$Limit );
    }

    $anchors_array = $db->fetch_all_array("select name, id as value from anchor");

    for($i=0;$i<count($row['data']);$i++){
        if($row['data'][$i]['ep_anchors'] !="") {
            $ary_numbers = explode(",", $row['data'][$i]['ep_anchors']);
            $newary = array();
            foreach ($ary_numbers as $val) {
                $tmpary = array();
                $key = array_search( $val, array_column($anchors_array, 'value') );
                $tmpary['id'] = $val;
                $tmpary['name'] = $anchors_array[$key]['name'];
                array_push($newary, $tmpary);
            }
            $row['data'][$i]['ep_anchors'] = $newary;//implode(" ", $newary);
        }
    }

    $db->close();
    $result["result"]=$row;
    echo json_encode($result);
}
catch(Exception $e) {
    $db->close();
    $result['success'] = "false";
    $result['message'] = $e->getMessage();
    echo json_encode($result);
}

