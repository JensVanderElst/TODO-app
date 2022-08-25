$("#password_confirmation").on("keyup", function(e){
    let passwordConfirmation = $("#password_confirmation").val();
    let password = $("#password").val();
    $.ajax({
        method: "POST",
        url: "ajax/passwordconf.php",
        data: { passwordConfirmation: passwordConfirmation,
                password: password},
        dataType:'json'
    })
        .done(function( res ) {
            if(res.status =="success"){
                let check = $("#passwordcheck");
                check.css("display", "block");
                let checkalert = $("#passwordcheck2");
                checkalert.css("display", "none");
                //console.log("succes");
                
            } else {
                let check2 = $("#passwordcheck2");
                check2.css("display", "block");
                //console.log("failed");
            }
        });
    e.preventDefault();
});