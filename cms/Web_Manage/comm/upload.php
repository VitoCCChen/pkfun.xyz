<?php
/*圖*/
include('_config.php');
include($inc_path.'_imgupload.php');

$arys=request_ary('arys');
$file =new imgUploder($_FILES['pic']);
$filename_orig = '';
$success=false;
$width=0;
$height=0;
$id = get('id', 1);
$old_img = get('old_img', 1);

if ($file->file_name != "")
{   
	$filename_orig = $file->file_name;
    $filename = explode('.',$file->file_name);
	//$file->set("file_name",md5(uniqid(rand())).'.'.end($filename));
    $file->set("file_name",$id.'.'.end($filename));
    $file->set("oldimg",$old_img);
    $file->set("smallimg",1);
	$file->set("file_max",1024*1024*3);
	$file->set("file_dir",$filepath);
	$file->set("overwrite","3");
	$file->set("fstyle","image");
	if ($file->upload() && $file->file_name!=""){	

		for($i=0;$i<count($arys);$i++){
			$obj=explode(',',$arys[$i]);
			
			if(count($obj)==4 || count($obj)==5){
				$obj[4] = isset($obj[4]) && $obj[4] && $obj[4]!=='false'?$obj[4]:false;
				$file->file_sname=$obj[0];
				$file->createSmailImg($obj[2],$obj[3],$obj[1],$obj[4]);
			}
		}
		$size=$file->getSize();
		$success=true;
		$width=$size[0];
		$height=$size[1];

		$db = Database::DB();
        $db->query_update('program',array('pgram_thumbnail'=>($file->file_name))," pgram_id='{$id}'");
        $db->close();
	}
$result['result']=$success;
$result['msg']=$file->user_msg;
$result['filename']=$file->file_name;
$result['filepath']=$filepath;
$result['filename_orig']=$filename_orig;
$result['width']=$width;
$result['height']=$height;
echo json_encode($result);
}
?>