$(function(){
    function alllang(lang){
        var current_lang = get_cookie("user-lang");
        if(current_lang != lang)
        {
            set_cookie("user-lang",lang,"","/");
            location.reload();
        }
    }

	$(document).on("click","a.lang",function(){
        var lang = $(this).attr("lang");
        alllang(lang);
		
	});

    $(document).on("click","input[name='loginlang']",function(){
        var lang = $("input[name='loginlang']:checked").val();
        alllang(lang);

    });
});