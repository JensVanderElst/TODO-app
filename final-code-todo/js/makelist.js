$("#createlist").on("click", function(e){
    let list = $("#listname").val();
    let user = $("#listname").data("index");
    console.log(list);
    console.log(user);
    if (list.length >= 1) {
        let error = $("#listerror");
        error.css("display", "none");
       $.ajax({
        method: "POST",
        url: "ajax/makelist.php",
        data: { list: list, user: user},
        dataType:'json'
    })
        .done(function( res ) {
            if(res.status =="success"){
                //console.log('list created');
                location.reload();

            } else {
                console.log('list created failed');
            }
        }); 
    } else{
        let error = $("#listerror");
        error.css("display", "block");
        
    }
    
});