$("#createtask").on("click", function(e){
    let task = $("#taskname").val();
    let list = $("#taskname").data("index");
    let time = $("#time").val();
    let date = $("#enddate").val();
    console.log(task);
    console.log(time);
    console.log(date);
    if (task.length >= 1) {
        let error = $("#taskerror");
        error.css("display", "none");
    $.ajax({
        method: "POST",
        url: "ajax/createtask.php",
        data: { task: task, list: list, time: time, date: date},
        dataType:'json'
    })
        .done(function( res ) {
            if(res.status =="success"){
                console.log('task created');
                location.reload();
                
            } else {
                console.log('task created failed');
                
                
            }
        });
    } else{
        let error = $("#taskerror");
        error.css("display", "block");
    }
    
});