function dynamicSearch(searchString){
    var beerResults = document.getElementsByClassName('beerResults')[0];
    $(".beerResults").empty();

    var dataString = "&functionId=1&searchString="+searchString;
    console.log("DS: " + dataString);

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
                var foundImgURL = "../images/"+beerArray[i]["imageURL"];
                var foundId = beerArray[i]["id"];
                var foundAbv = beerArray[i]["abv"];
                var newWindowLocation = "'/products/view.php?id="+foundId+"'";

                beerResults.innerHTML += '\
                        <div class="product">\
                            <div class="product-image">\
                                <a href="/products/view.php?id='+foundId+'"><img src="/images/'+foundImgURL+'" alt="'+foundName+'" /> </a>\
                            </div>\
                            <div class="product-description">\
                                <a href="/products/view.php?id='+foundId+'">\
                                    <div style="clear: both">\
                                        <h1>'+foundName+'</h1>\
                                        <h2>('+foundAbv+')</h2>\
                                    </div>\
                                </a><br>\
                                <p>'+foundCategory+' by '+foundBrewery+'</p>\
                            </div>\
                            <div class="product-buttons">\
                                <button onclick="window.location.href='+newWindowLocation+'">LEARN MORE</button>\
                            </div>\
                        </div>';
            }
        }
    });
}
