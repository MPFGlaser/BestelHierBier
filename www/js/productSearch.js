function dynamicSearch(searchString){
    var foundItemsClass = document.getElementsByClassName('foundItems')[0];
    foundItemsClass.innerHTML = "";

    var dataString = "&functionId=1&searchString="+searchString;

    $.ajax({
        url: "../php/ajaxCallRegulator.php",
        type: 'POST',
        data: dataString,
        success: function(data){
            var beerArray = JSON.parse(data);
            for(var i = 0; i < beerArray.length; i++){
                var foundName = beerArray[i]["name"];
                var foundBrewery = beerArray[i]["brewery"];
                var foundCategory = beerArray[i]["category"];
                var foundImgURL = beerArray[i]["imageURL"];
                var foundId = beerArray[i]["id"];
                var foundAbv = beerArray[i]["abv"];

                var newWindowLocation = "/products/view.php?id="+foundId;

                foundItemsClass.innerHTML += '<div class="product"><div class="productImage"><a href="../product.php?id='+foundId+'"><img src"=../images/'+foundImgURL+'"alt="'+foundName+'"/> </a> </div> <div class="productDescription"> <a href="../product.php?id='+foundId+'"> <h1>'+foundName+' ('+foundAbv+')</h1> </a><br> <p>'+foundCategory+' by '+foundBrewery+'</p> </div> <div class="button"> <button onclick="window.location.href='+newWindowLocation+'">Learn more</button> </div> </div>'
            }
        }
    });
}
