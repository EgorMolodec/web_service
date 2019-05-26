        $(document).ready(function () {

            $('#sub_task').css('display', 'none');
            //$('#sub_city').css('display', 'none');

            $("#get_course").change(function() {
                            clearlist();
                            //$('#sub_city').css('display', 'none');		
                            var course_value = $("#get_course option:selected").val();
                            //if (countryvalue === '') {clearlist(); }
                            if (course_value === '') {clearlist(); $('#sub_task').css('display', 'none');  }
                            getTask();
                    })
            //getarea();
            //getcity();

            function getTask() {
                    var course_value = $("#get_course option:selected").val();
                    var p_id = $("#page_id").val();
                    var task = $("#get_task");
                    var getTask_value = task.val();
                    if (course_value === "") {
                            task.attr("disabled",true);
                    } else {
                            task.attr("disabled",false);
                            task.load('/template/php/get_task.php',{intCourseID : course_value, page_id : p_id});
                            $('#sub_task').css('display', 'block');
                    }
            }

            function clearlist() {
                    $("#get_task").empty();

            }	


            });