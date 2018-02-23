<?php
class coderPointHelp
{

    private $table_member = 'member';
    private $table_anchor = 'anchor';
    private $table_contribution = 'contribution';



    public function __construct()
    {

    }

    //取得單一會員點數總數
    static function getPoint($mem_id){
        $db = Database::DB();
        $query_member = "SELECT point FROM member WHERE member_id=:member_id";
        $row = $db->query_first($query_member,[':member_id' => $mem_id]);
        return $row['point'];
    }

    //取得單一主播點數總數
    private static function getPoint_anc($id){
        $db = Database::DB();
        $query= "SELECT point FROM anchor WHERE id=:id";
        $row = $db->query_first($query,[':id' => $id]);
        return $row['point'];
    }

    //錢轉點
    public function MoneyToPoint($mem_id,$point){

        $orig_point = $this->getPoint($mem_id);
        $totalpoint = $orig_point+$point;
        $db = Database::DB();
        $db->query_update($this->table_member,['point' => $totalpoint]," member_id='$mem_id'");
    }


    //打賞轉點
    public function Contribution($ary){
        extract($ary);
        $member_point = $this->getPoint($mem_id);
        $anchor_point = $this->getPoint_anc($anc_id);
        if($member_point>=$point){
            $member_point -= $point;
            $anchor_point += $point;
            $db = Database::DB();
            $db->query_update($this->table_member,['point' => $member_point]," member_id='$mem_id'");
            $db->query_update($this->table_anchor,['point' => $anchor_point]," id='$anc_id'");
            $contribution = array(
                'anchor_id' => $anc_id,
                'member_id' => $mem_id,
                'point' => $point,
                'contents' => $content
            );
            $db->query_insert($this->table_contribution,$contribution);
            $anc_name = $db->query_prepare_first("SELECT name FROM anchor WHERE id=:id",[':id' => $anc_id]);
            $db->close();
            $ary["member_point"] = $member_point;
            $ary["anc_name"] = $anc_name['name'];

            return array(
                'success' => true,
                'result' => $ary,
                'code' => 1,
                'message' => "Contributed successfully"
            );

        }else if($member_point<$point)
            $ary["member_point"] = $member_point;
            return array(
                'success' => false,
                'result' => $ary,
                'code' => 2,
                'message' => "點數餘額不足"
            );
    }

}