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
    }else if(!validateEmail(email)){
        alert("Please enter a valid email addres");
        return false;
    }
}

function validateAddEditBeer(){
    var name = document.forms["editForm"]["name"].value;
    var brewery = document.forms["editForm"]["brewery"].value;
    var category = document.forms["editForm"]["category"].value;
    var price = document.forms["editForm"]["price"].value;
    var abv = document.forms["editForm"]["abv"].value;
    var description = document.forms["editForm"]["description"].value;
    var country = document.forms["editForm"]["country"].value;
    var size = document.forms["editForm"]["size"].value;

    if(name == ""){
        alert("Please enter a name");
        return false;
    }else if(brewery == ""){
        alert("Please enter a brewery");
        return false;
    }else if(category == ""){
        alert("Please enter a category");
        return false;
    }else if(price == ""){
        alert("Please enter a price");
        return false;
    }else if(abv == ""){
        alert("Please enter an abv");
        return false;
    }else if(description == ""){
        alert("Please enter a description");
        return false;
    }else if(country == ""){
        alert("Please enter a country");
        return false;
    }else if(size == ""){
        alert("Please enter a size");
        return false;
    }else if(isNaN(price)){
        alert("Please use only numbers in the price field");
        return false;
    }else if(isNaN(abv)){
        alert("Please use only numbers in the abv field");
        return false;
    }else if(isNaN(size)){
        alert("Please use only numbers in the size field");
        return false;
    }
}

function validateEditUserData(){
    var username = document.forms["editInformation"]["username"].value;
    var email = document.forms["editInformation"]["email"].value;
    var password = document.forms["editInformation"]["passwordNew"].value;
    var passwordConfirm = document.forms["editInformation"]["passwordConfirm"].value;

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
    }else if(!validateEmail(email)){
        alert("Please enter a valid email addres");
        return false;
    }
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
