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
    document.getElementById('editor').style.fontSize='16px';
    
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
   	     	
   });
   
   $("#compilecode").click(function(){
   	   $("#code").val(editor.getSession().getValue());
   	   	
   });
});
