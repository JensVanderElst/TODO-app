$("#comment").on("click", function(e){
    let comment = $("#comval").val();
    let uri = $("#uri").val();
    let task = $("#comval").data("index");
    //console.log(list);
    $.ajax({
        method: "POST",
        url: "ajax/commentconf.php",
        data: { comment: comment, task: task},
        dataType:'json'
    })
        .done(function( res ) {
            if(res.status =="success"){
                console.log('comment created');
                $(".table").load(uri + " .table");

            } else {
                console.log('comment created failed');
            }
        });
        e.preventDefault();
});