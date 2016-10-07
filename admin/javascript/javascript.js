/**
 * @author CODEBAR
 */
$(window).load(function(){
	$('#myModal').modal('show');
	
});
$(document).ready(function(){
var editor = ace.edit("editor");
    editor.setTheme("ace/theme/chrome");
    editor.getSession().setMode("ace/mode/c_cpp");
    //editor.getSession().setMode("ace/mode/"+language.val());
    $("#mode").on('change',function(){
    	var newmode = $("#mode option:selected").attr('id');
    	
    	if(newmode == "c" || newmode == "cpp")
    	{
    	editor.getSession().setMode("ace/mode/c_cpp");
    	}
    	else
    	{
    	 editor.getSession().setMode("ace/mode/java");	
    	}
   });
   
   
   $("#submitcode").click(function(){
   	   $("#code").val(editor.getSession().getValue());
   	   alert($("#code").val());  	
   });
});
	


    
    
    
/*$("#addingproblems").submit(function () {
    $.ajax({
      url: "admin.php",
      type: "POST",
      data: $("#addingproblems").serialize(),
      success: function(data) {
        $('#problemtablink').tab('show');
      }
    });
    return false;
});*/
/*$(document).ready(function(){
	$("#save").click(function(){
		$("#problemtablink").attr("data-toggle","tab");
		
		$("#addproblemstab").removeClass("disabled");
		//$("#contesttab").removeClass("active");
	});
	/*$("#contesttab").click(function(){
		$("#contesttab").addClass("active");
		$("#submissiontab").removeClass("active");
	});*/

/*$(function(){
	$('#getstartedbtn').click(function(){
		$.load('pages/home.html');
	});
});*/
