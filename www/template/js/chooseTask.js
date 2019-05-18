var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'jquery.js';
document.head.appendChild(script);

$(document).ready(function() {
    $('#sub_task').css('display', 'none');
    
    $("#get_course").change(function() {
		clearlist();
		var coursevalue = $("#get_course option:selected").val();
		//if (countryvalue === '') {clearlist(); }
		if (coursevalue === '') {clearlist(); $('#get_task').css('display', 'none');  }
		//chooseTask();
                if (course_value === "") {
		task.attr("disabled",true);
	} else {
		task.attr("disabled",false);}
	})
    
    function chooseTask(){
        var course_value = $("#get_course option:selected").val();
	var p_id = $("#page_id").val();
	var task = $("#get_task");
	var gettask_value = task.val();
	if (course_value === "") {
		task.attr("disabled",true);
	} else {
		task.attr("disabled",false);
                task.load('./get_task.php',{course : course_value, page_id : p_id});      //, page_id : p_id
		$('#sub_task').css('display', 'block');
	}

    }
       
    function clearlist() {
	$("#get_task").empty();

    }
});


