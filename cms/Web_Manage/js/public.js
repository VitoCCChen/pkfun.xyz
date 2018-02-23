// JavaScript Document
var public_ckecitor_chk=true;

function openBox(links,width,height,transition,close_refresh,fixed){
    width = width || "90%";
    height = height || '90%';
    transition = transition || 'none';//fade/none
    close_refresh = close_refresh || false;//false/true(是否關掉重整頁面?)
    fixed = fixed || true;//控制光箱是否隨滑鼠滾動(true為fixed在中間)
        
    if(typeof(close_refresh)=='function'){closefun = close_refresh;}
    else{closefun =function(){};}
    $.colorbox({
        href:links,
        iframe:true,
        innerWidth: width,  
        innerHeight: height, 
        scrolling: !isnicescroll,
        transition: transition,
        initialWidth:width,
        initialHeight:height,
        speed:50,
        fixed:fixed,
        onClosed:closefun,
    });
}
function closeBox(callback){
    console.log(callback);
	$.colorbox.close();
     (callback && typeof(callback) === "function") && callback();
}

function getTimeStamp(){
   var dt=new Date();
   return dt.getTime();
}

function resizeNicescroll()  {	
   if (isnicescroll==true){
       setTimeout(function(){$("html").getNiceScroll().resize();},300);
   }
}

function ckeditorScrollFix(){
	
	CKEDITOR.on('instanceCreated', function(ev) {

    	ev.editor.on('resize',function(reEvent){
         	 resizeNicescroll();
			
     	});
 	});
	//
}
function pathToFile(str)
{
    var nOffset = Math.max(0, Math.max(str.lastIndexOf('\\'), str.lastIndexOf('/')));
    var eOffset = str.lastIndexOf('.');
    if(eOffset < 0)
    {
        eOffset = str.length;
    }
    return {isDirectory: eOffset == str.length,
            path: str.substring(0, nOffset),
            name: str.substring(nOffset > 0 ? nOffset + 1 : nOffset, eOffset),
            extension: str.substring(eOffset > 0 ? eOffset + 1 : eOffset, str.length)};
}
function chkCkeditorScrollEvent(){
	 if(public_ckecitor_chk==true){
		 resizeNicescroll();
		 public_ckecitor_chk=false;
		 setTimeout(function(){public_ckecitor_chk=true;},1000);
	 }
}

function selectAll(nametag,selected){
	$('body').find('input[name="'+nametag+'[]"]').prop('checked', selected);     
}

function dateValidationCheck(str){
    var re = new RegExp("^([0-9]{4})[.-]{1}([0-9]{1,2})[.-]{1}([0-9]{1,2})$");
    var strDataValue;
    var infoValidation = true;
     
    if ((strDataValue = re.exec(str)) != null){
        var i;
        i = parseFloat(strDataValue[1]);
        if (i <= 0 || i > 9999){ // 年
            infoValidation = false;
        }
        i = parseFloat(strDataValue[2]);
        if (i <= 0 || i > 12){ // 月
            infoValidation = false;
        }
        i = parseFloat(strDataValue[3]);
        if (i <= 0 || i > 31){ // 日
            infoValidation = false;
        }
    }else{
        infoValidation = false;
    }
    return infoValidation;
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}


function showNotice(type,title,text){
	var image="";
	switch (type){
		case "alert":
			image='../images/gitter/alert.png';
		break;
		case "ok" :
			image='../images/gitter/ok.png';
		break;
		default:
			image='../images/gitter/could.png';
		break;
	}
	$.gritter.add({
		title: title,
		text: text,
		image: image,
		sticky: false,
		time: ''
	});	
}

function getInputVal(obj){
    if(obj.attr('type')=="radio"){
        return $('input[name='+obj.attr('name')+']:checked').val();
    }else{
        return obj.val();
    }

}

var CODER = CODER || {};
CODER.namespace = function() {
    var a=arguments, o=null, i, j, d;
    for (i=0; i < a.length; i=i+1) {
        d=a[i].split(".");
        o=CODER;
        for (j=(d[0] == "CODER") ? 1 : 0; j < d.length; j=j+1) {
            o[d[j]]=o[d[j]] || {};
            o=o[d[j]];
        }
    }
    return o;
};
CODER.namespace('CODER.Util');