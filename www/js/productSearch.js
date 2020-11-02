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
                console.log(beerArray[i]["name"]);

                var newWindowLocation = "/products/view.php?id=" + beerArray[i]["id"] ;

                foundItemsClass.innerHTML += '<div class="product"><div class="productImage"><a href="/product.php?id="'+beerArray[i]["id"]+'><img "src=/images/"'+beerArray[i]["imageURL"]+'"alt="'+beerArray[i]["name"]+' /> </a> </div> <div class="productDescription"> <a href="/product.php?id="'+beerArray[i]["id"]+'> <h1>'+beerArray[i]["name"]+' ('+beerArray[i]["abv"]+')</h1> </a><br> <p>'+beerArray[i]["category"]+' by '+beerArray[i]["brewery"]+'</p> </div> <div class="button"> <button onclick="window.location.href='+newWindowLocation+'">Learn more</button> </div> </div>'
            }
        }
    });
}
