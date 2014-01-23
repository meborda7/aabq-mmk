$(function(){
	$('input:text').keyup(function(){
        var flag = true;
        $('div').find("input[type=text]").each(function(){
            if($(this).val() === '') flag = false
        });		
        $('#frm_submit').attr("disabled", !flag);
    });
});
