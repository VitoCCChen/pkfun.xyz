//20151230 Jane 新增 拖曳排序
(function($) {
$.fn.coderlisthelp = function(settings) {

    var _defaultSettings = {
		callback:null,
		listComplete:null,
		ajaxsrc:"",
		delsrc:"",
		editlink:"",
		ordersrc:"",
		ordersortable:"",
		excelLink:"",
		csvImportLink:"",
		page:1,
		debug:false
    };
    var _settings = $.extend(_defaultSettings, settings);
	return this.each(function() {

		var parent=$(this);
		var content=parent.find('tbody:first');
		var pagecontent=parent.find('#listtable_page');
		var filterform=parent.find("form#filterform");
		var message="";
		var mutileselect=false;
		var manage=false;
		function init(){

			linkInit();

			parent.find('th').each(function(){
				var th=$(this);
				//如果有mutileselect功能
				if($(this).attr('attr')=='mutileselect'){
					mutileselect=true;
					var checked=$(this).prop('checked');
					$(this).find('input[type="checkbox"]').click(function(){
						parent.find('tbody tr td:eq(0)').prop('checked',checked);
					});
				}
				//操作功能
				else if($(this).attr('attr')=='manage'){
					manage=true;
				}
				//排序功能
				else if($(this).attr('attr')=='order'){
					var sorttype="";
					if($(this).attr('desc')=='desc'){
						sorttype="sort-desc";
					}
					else{
						sorttype="sort-asc";
					}
					var obj=$(this).find('a');
					obj.attr('class',sorttype+' sort-active');
					obj.click(function(event){
						parent.find('th a.sort-active').prop('class','sort-asc sort-desc');
						obj.attr('class',sorttype+' sort-active');
						showList();
					})
				}
				else{
					//一般排序樣式處理
					var obj=$(this).find('a');
					var css=obj.attr('class');
					if(css && css.indexOf('sort-')>-1){
						obj.click(function(event){
							var css=obj.attr('class');
							 if(css.indexOf('sort-active')<0){ //非作用中
								parent.find('th a.sort-active').prop('class','sort-asc sort-desc');
								obj.attr('class','sort-asc sort-active');
							 }
							 else{ //作用中
								obj.prop('class',(css.indexOf('sort-asc')<0) ? 'sort-asc sort-active' : 'sort-desc sort-active');
							 }
							 showList();
						});
					}
				}
			})

			//搜尋鈕處理
			parent.find('#submit,#refreshBtn').click(function(){
				showList();
			});
			//複數刪除鈕處理
			parent.find('#mutileDelBtn').click(function(){
				deleteChooseItem();
			});
			parent.find('#excelBtn').click(function(){
				savetoexcel();
			});
			//匯入csv
			parent.find('#csvImportBtn').click(function(){
				var _this = this;
				Importfromcsv(_this);
			});
			/*parent.find('#csvImportfile').change(function(){
				var _this = this;
				Importfromcsv(_this);
			});*/

			//拖曳排序
			if(_settings.ordersortable!=''){
				$('#table1 table.table-advance tbody').sortable({
				    opacity: 0.8, //设置拖动时候的透明度 
				    helper: "clone",
				    cancel: "a",
				    cursor: 'move', //拖动的时候鼠标样式 
				    update: function(event, ui){ 
				        ordersortableList(ui.item.attr('orderlink'),ui.item.prev().attr('orderlink'),'移動'+ui.item.attr('title'));
				    },
				}).disableSelection();
			}
		}

		function linkInit(){
			if(parent.attr('ajaxsrc')){
				_settings.ajaxsrc=parent.attr('ajaxsrc');
				parent.removeAttr('ajaxsrc');
			}
			if(parent.attr('delsrc')){
				_settings.delsrc=parent.attr('delsrc');
				parent.removeAttr('delsrc');
			}
			if(parent.attr('editlink')){
				_settings.editlink=parent.attr('editlink');
				parent.removeAttr('editlink');
			}
			if(parent.attr('ordersrc')){
				_settings.ordersrc=parent.attr('ordersrc');
				parent.removeAttr('ordersrc');
			}
			if(parent.attr('ordersortable')){
				_settings.ordersortable=parent.attr('ordersortable');
				parent.removeAttr('ordersortable');
			}
			if(parent.attr('excelLink')){
				_settings.excelLink=parent.attr('excelLink');
				parent.removeAttr('excelLink');
			}
			if(parent.attr('csvImportLink')){
				_settings.csvImportLink=parent.attr('csvImportLink');
				parent.removeAttr('csvImportLink');
			}

			parent.find('#addBtn').colorbox({iframe:true,innerWidth: '90%', innerHeight: '90%',scrolling: !isnicescroll,transition:'none',initialWidth:'90%',initialHeight:'90%',speed:100,fixed:true,onClosed:function(){parent.find('#refreshBtn').click()}});

			parent.find('#addexcelBtn').colorbox({iframe:true,innerWidth: '90%',innerHeight: '90%',scrolling: false,transition:'none',initialWidth:'90%',initialHeight:'90%',speed:100,fixed:true,onClosed:function(){parent.find('#refreshBtn').click()}});
		}

		function deleteChooseItem(){
			var list=new Array();
			var listname="";
			var delstr="";
			if(typeof(parent.attr("delstr"))!="undefined"){
				var delstr=parent.attr("delstr");
			}
			parent.find('tbody tr').each(function(){
				var tr=$(this);
				if(tr.find('td:eq(0) input[type="checkbox"]').prop("checked")){
					list[list.length]=tr.attr('delkey');
					listname+='\r\n'+tr.attr('title');
				}
			})
			if(list.length>0){
                $.confirm({
                    title: langary_jsall['confirm'],
                    content: listname+delstr,
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        tryAgain: {
                            text: langary_jsall['confirm_ok'],
                            btnClass: 'btn-red',
                            action: function(){
                                deleteList(list);
                            }
                        },
                        alphabet: {
                            text: langary_jsall['confirm_cancel'],
                            action: function(){
                            }
                        }
                    }
                });

			}
			else{
				//alert('請先選擇要被刪除的項目');
                $.alert({
                    type: 'red',
                    buttons:{
                        alphabet: {
                            text: langary_jsall['confirm_ok']
                        }
					},
                    title: langary_jsall['msg'],
                    content: ''
                });
			}
		}

		function deleteItem(id,title){
			var delstr="";
			if(typeof(parent.attr("delstr"))!="undefined"){
				var delstr=parent.attr("delstr");
			}
			/*if(confirm('您確定要刪除'+title+'?'+delstr)){
				var list=new Array();
				list[0]=id;
				deleteList(list);
			}*/
            $.confirm({
                title: langary_jsall['confirm2']+title+'?'+delstr,
                content: '',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: langary_jsall['confirm_ok'],
                        btnClass: 'btn-red',
                        action: function(){
                            var list=new Array();
                            list[0]=id;
                            deleteList(list);
                        }
                    },
                    alphabet: {
                        text: langary_jsall['confirm_cancel'],
                        action: function(){
                        }
                    }
                }
            });

		}


		function orderList(para,title){
			startload();
			hideorder();
			var parent=this;
			$.ajax({
				//url:_settings.ordersrc,
				url:_settings.ordersrc+( formattoget(getSearchPara())!=''?(_settings.ordersrc.match(/[?]/)?'&':'?'):'')+formattoget(getSearchPara()),
				cache: false,
				type:"POST",
				data:para ,
				dataType:"json",
				success:function(data){
					if(data.result==true){
						showList();
						showNotice('ok',langary_jsall['orderList_ok'],langary_jsall['orderList_ok2']+title);
					}
					else{
						showNotice('alert',langary_jsall['orderList_error'],data.msg);
					}
					stopload();
				}
				,error:function(xhr, ajaxOptions, thrownError){

					oops(langary_jsall['oops_error']+thrownError,xhr);
					stopload();
				}
			});
		}

		function ordersortableList(_thisdata,_prevdata,title){
			startload();
			hideorder();
			var parent=this;
			$.ajax({
				url:_settings.ordersortable,
				cache: false,
				type:"POST",
				data:{
					'order_data':_thisdata,
					'prev_data':_prevdata,
					'method':'sortable',
				},
				dataType:"json",
				success:function(data){
					if(data.result==true){
						showList();
						showNotice('ok',langary_jsall['orderList_ok'],langary_jsall['orderList_ok2']+title);
					}
					else{
						showNotice('alert',langary_jsall['orderList_error'],data.msg);
					}
					stopload();
				}
				,error:function(xhr, ajaxOptions, thrownError){

					oops(langary_jsall['oops_error']+thrownError,xhr);
					stopload();
				}
			});
		}

		function deleteList(list){
			startload();
			var parent=this;
			$.ajax({
			url:_settings.delsrc,
			cache: false,
			type:"POST",
			data:{ id : list } ,
			dataType:"json",
			success:function(data){
				if(data.result==true){
					showList();
					showNotice('ok',langary_jsall['deleteList_ok'],langary_jsall['deleteList_ok2']+data.count+langary_jsall['deleteList_ok3']);
				}
				else{
					showNotice('alert',langary_jsall['deleteList_error'],data.msg);
				}
				stopload();
			}
			,error:function(xhr, ajaxOptions, thrownError){
				oops(langary_jsall['oops_error']+thrownError,xhr);
				stopload();
			}
			});
		}

		function showList(){

			startload();
			var parent=this;
			var callback=_settings.callback;
			var listComplete=_settings.listComplete;
			$.ajax({
			url:_settings.ajaxsrc,
			cache: false,
			type:"GET",
			data: getPara(),
			dataType:"json",
			success:function(data){
				if(data){
					if(data['result']==true){
						if (callback && typeof(callback)=='function'){
							callback(content,data["data"]);
						}
						showModifyContent();
						showPage(data["page"]);
						chkCkeditorScrollEvent();
						if(listComplete && typeof(listComplete)=='function'){
							listComplete();
						}
					}
					else{
						oops(data['data']);
					}
				}
				else{
					oops(langary_jsall['showList']);
				}
				stopload();
			}
			,error:function(xhr, ajaxOptions, thrownError){
				oops(langary_jsall['oops_error']+thrownError,xhr);
				stopload();
			}
			});
		}
		function savetoexcel(){
			var list=new Array(),
			    list_id ='';
			parent.find('tbody tr').each(function(){
				var tr=$(this);
				if(tr.find('td:eq(0) input[type="checkbox"]').prop("checked")){
					list[list.length]=tr.attr('delkey');
				}
			});
			if(list.length>0){
				list_id=list.join(',');
			}
			location.href = _settings.excelLink+'?'+'list_id'+'='+list_id+'&'+formattoget(getPara());
		}

		function Importfromcsv(_this){
			$.colorbox({href:_settings.csvImportLink,iframe:true, innerWidth: '90%', innerHeight: '90%', scrolling: !isnicescroll,transition:'none',initialWidth:'90%',initialHeight:'90%',speed:100,fixed:true,onClosed:function(){parent.find('#refreshBtn').click()}});
			/*
			startload();
			var file=_this.files[0];
			if(file){
				var ugid  = $('#usergroup').val();
				var fd = new FormData();
				fd.append('file',file);
				fd.append('ugid',ugid);
				$.ajax({
					url:_settings.csvImportLink,
					cache: false,
					type:"POST",
					data:fd,
					dataType:"json",
					processData: false,
                	contentType: false,
                	enctype: 'multipart/form-data',
					success:function(data){
						if(data.result==true){
							showList();
							showNotice('ok','匯入完成','您己成功匯入'+data.num+'筆資料'+data.sucmsg);
						}
						else{
							showNotice('alert','匯入作業失敗',data.msg);
						}
					},
					error:function(xhr, ajaxOptions, thrownError){
						oops("讀取資料時發生錯誤,請梢候再試"+thrownError,xhr);
					},
					complete:function(){
						$(_this).val(null);
						stopload();
					}
				});
			}*/
		}

		function showModifyContent(){
			if(mutileselect){
				parent.find('tbody tr').each(function(){
					$(this).prepend('<td><input type="checkbox"></td>');
				})
			}
			if(manage){
				//是否排序作用中欄位判斷
				var orderclass='disabled';
				var ordertitle=langary_jsall['showModifyContent_ordertitle'];
				var orderth=parent.find('th[attr="order"] a.sort-active');
				if(orderth.index()>-1){
					orderclass=' btn-info ';
					ordertitle='';
					if(_settings.ordersortable!=''){$('#table1 table.table-advance tbody').sortable( "enable" )};//拖曳排序啟用
				}else{
					if(_settings.ordersortable!=''){$('#table1 table.table-advance tbody').sortable( "disable" )};//拖曳排序禁止
				}
				//畫各個按鈕
				parent.find('tbody tr').each(function(){

					var tr=$(this);
					var title=tr.attr('title');
					//排序按鈕
					if(_settings.ordersrc!="" && tr.attr('orderlink')!=''){
						var td=$('<td class=" text-center"></td>');
						var up=$('<a class="btn btn-sm show-tooltip '+orderclass+'" title="'+langary_jsall['showModifyContent_up']+ordertitle+'" href="#"><i class="icon-angle-up"></i></a>');
						up.click(function(){
							orderList(tr.attr('orderlink')+'&method=up',langary_jsall['showModifyContent_up']+title);
						});
						td.append(up);
						var down=$('<a class="btn btn-sm show-tooltip '+orderclass+'" title="'+langary_jsall['showModifyContent_down']+ordertitle+'" href="#"><i class="icon-angle-down"></i></a>');
						down.click(function(){
							orderList(tr.attr('orderlink')+'&method=down',langary_jsall['showModifyContent_down']+title);
						});
						td.append(down);
						$(this).append(td);
					}

					//管理按鈕
					var td=$('<td class="text-center"></td>');
					if(_settings.editlink!=""){
						var edit=$('<a class="btn btn-sm show-tooltip btn-success" title="'+langary_jsall['showModifyContent_edit']+title+'" href="javascript:void(0)"><i class="icon-edit"></i></a>');
						edit.click(function(){
							$.colorbox({href:_settings.editlink+'?'+tr.attr('editlink'),iframe:true, innerWidth: '90%', innerHeight: '90%', scrolling: !isnicescroll,transition:'none',initialWidth:'90%',initialHeight:'90%',speed:100,fixed:true,onClosed:function(){parent.find('#refreshBtn').click()}});
						});
						td.append(edit);
					}
					if(_settings.delsrc!=""){
						var del=$('<a id="delbtn" class="btn btn-sm btn-danger show-tooltip" title="'+langary_jsall['showModifyContent_del']+title+'" href="javascript:void(0)"><i class="icon-trash"></i></a>');
						del.click(function(){
							deleteItem(tr.attr('delkey'),title);
						});
						td.append(del);
					}

					$(this).append(td);
				})
			}
		}
		function showPage(page){
			pagecontent.html('');
			if(page['count']>0){
				var $left=$('<div style="float:left"></div>');
				$left.append((page["begin"]+1)+'-'+Math.min(page["show_num"],page["count"])+' of '+page["count"]+' &nbsp; Page: '+page["page"]+"/"+page["pagecount"]+' ');
				$left.append("每頁");
				$select=$("<select id=\"PageNum\" name=\"PageNum\" />");
				//$select.append('<option value="1" >1</option>');
				for(var i=5;i<31;i+=5){
					$select.append('<option value="'+i+'" '+((page["show_num"]==i+'') ? 'selected' : '')+'>'+i+'</option>');
				}
				$select.change(function(event){
				   showList();
			    });
				$left.append($select);
				$left.append('筆');
				pagecontent.append($left);

				var $right=$('<div style="float:right"></div>');
				$right_content=$('<ul class="pagination"></ul>');

				var _page=parseInt(page["page"]);
				var page_start=parseInt(page["s_start"]);
				var page_end=parseInt(page["s_end"]);


				if(_page>page_start){
					$btn=$('<li><a href="javascript:void(0)">← Prev</a></li>');
					bindPageClick($btn,_page-1);
					$right_content.append($btn);

				}
				for(var i=page_start;i<=page_end;i++){
					var $li=$('<li '+(_page==i ? 'class="active"' : '')+'><a href="javascript:void(0)">'+i+'</a></li>');
					bindPageClick($li,i);
					$right_content.append($li);
				}
				if(_page<page_end){
					$btn=$('<li><a href="javascript:void(0)">Next → </a></li>');
					bindPageClick($btn,_page+1);
					$right_content.append($btn);
				}
				$right.append($right_content);
				pagecontent.append($right);
			}
		}

		function bindPageClick($obj,ind){
			$obj.click({ind:ind}, function(event){
			  _settings.page=event.data.ind;
			  showList();
		    });
		}

		function getPara(){
			var orderobj=parent.find('th').find('a.sort-active');
			if(orderobj.index()<0){
				orderobj=parent.find('th').find('a.sort-desc:eq(0)');
			}
			var orderkey=orderobj.attr("sortkey");
			var orderdesc=(orderobj.prop("class").indexOf('sort-asc')<0) ? 'desc' : 'asc';

			var para = { page:_settings.page,pagenum: parent.find('#PageNum').val(),orderkey:orderkey,orderdesc:orderdesc}
			 $.extend(para, getSearchPara());
			// console.log(para);
			return para;

		}
		function getSearchPara(){
			message="";
			var para = {};
			if(filterform!=null && filterform!='undefined'){

				filterform.find(':input').each(function(){
					var obj=$(this);
					var otype = obj.getType();
					switch (otype){
						case 'text':
							para[obj.attr('id')] = checkFormat(obj) ? obj.val() : '';
						break;
						case 'hidden':
							para[obj.attr('id')] =  obj.val() ;
						break;
						case 'select':
							para[obj.attr('id')] =  obj.val() ;
						break;
						case 'checkbox':
							if(obj.prop('checked')){
								if(!para[obj.attr('id')]) {
									para[obj.attr('id')] = new Array();
								}
								para[obj.attr('id')][para[obj.attr('id')].length]=  obj.val() ;
							}
						break;
					}
				})
				if(message!=""){
					showNotice('alert',langary_jsall['getSearchPara_alert'],langary_jsall['getSearchPara_alert2']+message);
				}

			}
			return para;

		}
		function checkFormat(obj){
			var val=obj.val()
			//日期格式確認
			if(obj.hasClass("date-picker") && val !=''){
				if(!dateValidationCheck(val)){
					obj.addClass('myform-error');
					message+=val+langary_jsall['checkFormat_alert'];
				}
				else{
					obj.removeClass('myform-error');
					return true;
				}
			}
			else if(obj.attr("format")=="numeric"){
				if(!isNumber(val) && val!=''){
					obj.addClass('myform-error');
					message+=val+langary_jsall['checkFormat_alert2'];
				}
				else{
					obj.removeClass('myform-error');
					return true;
				}
			}
			else{
				return true;
			}
		}
		function oops(msg,data){
			showNotice('alert',langary_jsall['oops_error2'],msg);
			if(_settings.debug==true){
				console.log(data);
			}
			stopload();
		}
		function startload(){
			parent.find('#filterloading').show();
		}
		function stopload(){
			parent.find('#filterloading').hide();
		}
		function hideorder(){
			parent.find('td a.btn-info').addClass('disabled').removeClass('btn-info');
		}
		function formattoget(obj){
			var str ='';
			for(var key in obj){
				str += ('&'+key+'='+obj[key]);
			}
			return str.slice(1);
		}
		_settings.page=1;
		init();
		showList();

	});
};
})(jQuery);