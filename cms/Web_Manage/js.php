<!--basic scripts-->

<script type="text/javascript" src="../assets/jquery/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="../assets/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="../assets/nicescroll/jquery.nicescroll.js"></script>
<script type="text/javascript" src="../assets/jquery-cookie/jquery.cookie.js"></script>
<script type="text/javascript" src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../assets/gritter/js/jquery.gritter.js"></script>
<!--page specific plugin scripts-->

<!--flaty scripts-->
<script type="text/javascript" src="../js/flaty.js"></script>
<script type="text/javascript" src="../assets/colorbox/jquery.colorbox.js"></script>

<script type="text/javascript" src="../js/public.js"></script>
<script type="text/javascript" src="../assets/jcrop/jquery.Jcrop.min.js"></script>

<link rel="stylesheet" type="text/css" href="../css/jquery-confirm.css"/>
<script type="text/javascript" src="../js/jquery-confirm.js"></script>
<script type="text/javascript" src="../js/cookie.js"></script>
<script type="text/javascript" src="../js/lang.js"></script>
<script type="text/javascript">
    $("#sidebar").load("../do/leftuldo.php?path=<?php echo $manage_path?>&ck=<?php echo (isset($fun_auth_key))?$fun_auth_key:''?>&allgames_id=<?php echo (isset($allgames_id))?$allgames_id:''?>");
    langary_jsall = <?php echo $langary_jsall?>;
</script>