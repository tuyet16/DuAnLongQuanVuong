$().ready(function(){
    $("#addForm").validate({
        errorPlacement: function(error, element){
            $(element)
            .closest("form")
            .find("label[for='"+element.attr("id")+"']")
            .append(error);
        },
        errorElement:"span",
        messages:{
            firstname: "required",
            minlength: "must be at least 3 character",
        }
        
        
        /*rules:{
            firstname: "required",
            lastname: "required",
            email:{
                required:true,
                email: true
            },
            username:{
                required:true,
                minlength: 2
            },
            password:{
                required: true;
                minlength: 5
            },
            messages:{
                firstname: "Please enter your firstname",
                lastname: "Pleaseenter your lastname",
                username:{
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required:"Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                }, 
            }            
        }*/
    });
    /*$("username").focus(function(){
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        if(firstname && lastname && !this.value)
        {
            this.value = firstname+"-"+lastname;
        }*/
    });
