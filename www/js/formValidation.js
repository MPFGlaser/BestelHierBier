function validateLogin(){
    var username = document.forms["loginForm"]["userName"].value;
    var password = document.forms["loginForm"]["passWord"].value;

    if(username == ""){
        alert("Please enter a username");
        return false;
    }else if(password == ""){
        alert("Please enter a password");
        return false;
    }
}

function validateRegister(){
    var username = document.forms["registerForm"]["userName"].value;
    var email = document.forms["registerForm"]["email"].value;
    var password = document.forms["registerForm"]["passWord"].value;
    var passwordConfirm = document.forms["registerForm"]["passWordConfirm"].value;

    if(username == ""){
        alert("Please enter a username");
        return false;
    }else if(email == ""){
        alert("Please enter an email addres");
        return false;
    }else if(password == ""){
        alert("Please enter a password");
        return false;
    }else if(passwordConfirm == ""){
        alert("Please enter a second password");
        return false;
    }
}

function validateAddEditBeer(){

}

function validateEditUserData(){

}
