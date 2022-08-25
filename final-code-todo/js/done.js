$(".taskbtn").on("click", function(e){
    var button_id = $(this).attr('taskid');
    console.log(button_id);
        var taskname = $("#done"+button_id).data("index");
        var listid = $("#done"+button_id).data("listid");
        console.log(taskname);
        console.log(listid);
        
        if ($("#done"+button_id).html() == "Niet voltooid") {
            $("#done"+button_id).html("Voltooid");
            $("#done"+button_id).addClass("btn-success");
            $("#done"+button_id).removeClass("btn-danger");
            $.ajax({
                method: "POST",
                url: "ajax/done.php",
                data: {taskname: taskname, listid: listid},
                dataType:'json'
            })
            .done(function (res) {
                console.log("task done");
                
                
            });
            e.preventDefault();
        }
        else{
            $("#done"+button_id).html("Niet voltooid");
            $("#done"+button_id).addClass("btn-danger");
            $("#done"+button_id).removeClass("btn-success");
            $.ajax({
                method: "POST",
                url: "ajax/undone.php",
                data: {taskname: taskname, listid: listid},
                dataType:'json'
            })
            .done(function (res) {
                console.log("Task undone");
                
            });
            e.preventDefault();
        }
    
    e.preventDefault();
});