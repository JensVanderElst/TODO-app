$("#username").on("keyup", function(e){
    let username = $("#username").val();
    //console.log(username);
    $.ajax({
        method: "POST",
        url: "ajax/userconf.php",
        data: { username: username},
        dataType:'json'
    })
        .done(function( res ) {
            if(res.status =="success"){
                let check = $("#usercheck");
                check.css("display", "block");
                let checkalert = $("#usercheck2");
                checkalert.css("display", "none");
                //console.log("succes");
                
            } else {
                let check2 = $("#usercheck2");
                check2.css("display", "block");
                //console.log("failed");
            }
        });
    e.preventDefault();
});