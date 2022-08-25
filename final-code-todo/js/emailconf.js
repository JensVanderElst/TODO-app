$("#email").on("keyup", function(e){
    let email = $("#email").val();
    //console.log(email);
    $.ajax({
        method: "POST",
        url: "ajax/emailconf.php",
        data: { email: email},
        dataType:'json'
    })
        .done(function( res ) {
            if(res.status =="success"){
                let check = $("#mailcheck");
                check.css("display", "block");
                let checkalert = $("#mailcheck2");
                checkalert.css("display", "none");
            } else {
                let check = $("#mailcheck2");
                check.css("display", "block");
            }
        });
    e.preventDefault();
});