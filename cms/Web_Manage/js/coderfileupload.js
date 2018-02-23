(function($) {
$.fn.coderfileupload = function(settings) {
    var _defaultSettings = {
		id:'file',
		size_id:'file_size',
		origname_id:'file_origname',
		callback:null,
		org_filename:'',
		org_filepath:'',
		org_filesize:"",
		filename_orig:'',
		extname:'pdf,doc,docx,txt,jpg,jpeg',
		filepath:'../../upload/temp/',
		ajaxsrc:"../comm/uploadfile.php",
		debug:true,
		required:false
    };
    var _settings = $.extend(_defaultSettings, settings);	
	return this.each(function() {
		var parent=$(this);
		var $content=null;
		var $file=null;
		var $del=null;
		var $process=null;
		var $hidden=null;
		var $hidden_size=null;
		var $hidden_origname=null;
		function init(){

			//檔案區

			$content=$('<div class="fileinfo" style="margin-bottom:5px"> <i class="icon-file-alt"> '+langary_jsall['fileupload']+' </i></div>');
			parent.append($content);

			//進度條
			$process=$('<div class="progress progress-striped active"><div style="width: 0%;" class="progress-bar"></div> </div>');
			parent.append($process);
			$process.hide();


			//按鈕區
			var $buttoncontent=$('<div style="width:300px;"></div>');

			$file=$('<input type="file" class="show-tooltip"  data-placement="top" data-original-title="'+langary_jsall['fileupload2']+'" style="float:left;line-height:30px;width:200px">');
			$del=$('<button type="button" class="btn btn-danger show-tooltip"  data-placement="top" data-original-title="'+langary_jsall['fileupload3']+'" style="float:left"><i class="icon-remove"></i></button>');

			$del.click(function(){
				clearFile();
			});

			$buttoncontent.append($file);
			$buttoncontent.append($del);
			$buttoncontent.append('<div style="clear:both"></div>');

			$hidden=$('<input type="hidden" name="'+_settings.id+'" id="'+_settings.id+'" class="hasvalidate" value="" '+(_settings.required==true ? ' required="yes" ' : ' ')+'>');
			$hidden_origname=$('<input type="hidden" name="'+_settings.origname_id+'" id="'+_settings.origname_id+'" value="" '+(_settings.required==true ? ' required="yes" ' : ' ')+'>');
			$hidden_size=$('<input type="hidden" name="'+_settings.size_id+'" id="'+_settings.size_id+'" class="hasvalidate" value="" >');
			$buttoncontent.append($hidden);
			$buttoncontent.append($hidden_origname);
			$buttoncontent.append($hidden_size);
			parent.append($buttoncontent);

			initButton();

			if(_settings.org_filename!=''){
				var ary=new Array();
				ary['filename']=_settings.org_filename;
				ary['filepath']=_settings.org_filepath;
				ary['filename_orig']=_settings.filename_orig;
				ary['size']=_settings.org_filesize;
				showFile(ary);
			}

		}
		
		function initButton(){
			$file.change(function() {
				var file=this.files[0];
				if(file ){
					if(!checkFileEx()){
						alert(langary_jsall['fileupload4']+'('+_settings.extname+')');
						return ;
					}
					var $processbar=$process.find('.progress-bar');
					$process.show();
					$processbar.css('width','0px');
					var fd = new FormData();
					var xhr = new XMLHttpRequest();
					xhr.open('POST', _settings.ajaxsrc);
					xhr.onload = function() {
						var r=$.parseJSON(this.responseText);
						$processbar.css('width','100%');
						$process.fadeOut(1500);
						if(r['result']==true){
							showFile(r);
							showNotice('ok',langary_jsall['fileupload5'],langary_jsall['fileupload6']);
						}
						else{
							oops(langary_jsall['fileupload7']+r['msg'],r);
						}
					};
					xhr.upload.onprogress = function (evt) {
					//上傳進度
						if (evt.lengthComputable) {
							var complete = (evt.loaded / evt.total * 100 | 0);
							if(100==complete){
								complete=99.9;
							}
							$processbar.css('width',complete+'%');
						}
					}
					fd.append('file',file);
					xhr.send(fd);//開始上傳
				}
            });
		}
		function checkFileEx(){
			var _file=pathToFile($file.val());
			return _settings.extname.indexOf(_file['extension'])>-1 ;

		}
		function showFile(file){
			$hidden.val(file['filename']);
			$hidden_origname.val(file['filename_orig']);
			$hidden_size.val(file['size']);
			$content.html('<i class="icon-file"> '+file['filename']+'</i> <a class="show-tooltip" href="'+file['filepath']+file['filename']+'" data-placement="top" data-original-title="'+langary_jsall['fileupload8']+'" style="margin-left:10px" target="_blank"><i class="icon-search"></i></a>');
		}

		function clearFile(){   
			$hidden.val('');
			$hidden_size.val('');
			$hidden_origname.val('');
			$content.html(' <i class="icon-file-alt"> '+langary_jsall['fileupload']+'</i>');
		}		
		function oops(msg,data){
			showNotice('alert',langary_jsall['oops_error2'],msg);
			if(_settings.debug==true){				
				console.log(data);
			}
		}	
		init();
	});
}
})(jQuery);
