$(document).ready(function () {

    $('#sub_sub_report').css('display', 'none');
    //$('#sub_report > tbody:last-child').append('<tr>...</tr><tr>...</tr>');

    $("#courseName").change(function() {
                    clearlist();
                    //$('#sub_city').css('display', 'none');		
                    var course_value = $("#courseName option:selected").val();
                    //if (countryvalue === '') {clearlist(); }
                    if (course_value === '') {clearlist(); $('#sub_sub_report').css('display', 'none');  }
                    getTask();
            })
            //getarea();
            //getcity();

    function getTask() {
            var course_value = $("#courseName option:selected").val();
            var p_id = $("#page_id").val();
            var task = $("#sub_sub_report");
            var getTask_value = task.val();
            if (course_value === "") {
                    task.attr("disabled",true);
            } else {
                    task.attr("disabled",false);
                    //task.load('report/',{intCourseID : course_value, page_id : p_id}); // /template/php/showTable.php
                    $.post("/report/showTable/"+course_value, {}, function(data) {
                        if(data == null) { alert("No reports"); }
                        else { alert(data) ; task.html(data); }
                    })
                    $('#sub_sub_report').css('display', 'block');
            }
    }

            function clearlist() {
                    $("#sub_sub_report").empty();
            }	


            });