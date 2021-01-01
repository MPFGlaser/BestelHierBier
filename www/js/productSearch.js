function dynamicSearch(searchString, isAdmin){
    var foundResults = document.getElementsByClassName('foundItems')[0];
    foundResults.innerHTML = "";

    var dataString = "&functionId=1&searchString="+searchString;
    $.ajax({
        url: "../php/Core/ajaxCallRegulator.php",
        type: 'POST',
        data: dataString,
        success: function(data){
            var beerArray = JSON.parse(data);

            if(isAdmin){
                foundResults.innerHTML += "<button onclick=\"window.location.href='/products/edit.php?id=0'\">ADD PRODUCT</button>";
            }

            for(var i = 0; i < beerArray.length; i++){
                var foundName = beerArray[i]["name"];
                var foundBrewery = beerArray[i]["brewery"];
                var foundCategory = beerArray[i]["category"];
                var foundImgURL = "../images/"+beerArray[i]["imageURL"];
                var foundId = beerArray[i]["id"];
                var foundAbv = beerArray[i]["abv"];
                var newWindowLocation = "'/products/view.php?id="+foundId+"'";
                var editString = "'/products/edit.php?id="+foundId+"'";

                if(!isAdmin){
                    foundResults.innerHTML += '\
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
                }else{
                    foundResults.innerHTML += '\
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
                                    <button onclick="window.location.href='+editString+'">EDIT</button>\
                                </div>\
                            </div>';
                }
            }
        }
    });
}

function filterByCheckbox(isAdmin){
    var foundResults = document.getElementsByClassName('foundItems')[0];
    foundResults.innerHTML = "";

    var allCheckboxes = document.getElementsByName('filterCheckbox');
    var checkedCheckboxes = [];

    for(var i = 0; i < allCheckboxes.length; i++){
        if(allCheckboxes[i].checked){
            checkedCheckboxes.push(allCheckboxes[i].value); //van gaat mis
        }
    }

    if(checkedCheckboxes.length > 0){
        var dataString = "&functionId=2&checkedArray="+JSON.stringify(checkedCheckboxes);

        console.log(dataString);

        $.ajax({
            url: "../php/Core/ajaxCallRegulator.php",
            type: 'POST',
            data: dataString,
            success: function(data){

                var beerArray = JSON.parse(data);

                console.log(beerArray);

                if(isAdmin){
                    foundResults.innerHTML += "<button onclick=\"window.location.href='/products/edit.php?id=0'\">ADD PRODUCT</button>";
                }

                for(var i = 0; i < beerArray.length; i++){
                    var foundName = beerArray[i]["name"];
                    var foundBrewery = beerArray[i]["brewery"];
                    var foundCategory = beerArray[i]["category"];
                    var foundImgURL = "../images/"+beerArray[i]["imageURL"];
                    var foundId = beerArray[i]["id"];
                    var foundAbv = beerArray[i]["abv"];
                    var newWindowLocation = "'/products/view.php?id="+foundId+"'";
                    var editString = "'/products/edit.php?id="+foundId+"'";

                    if(!isAdmin){
                        foundResults.innerHTML += '\
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
                    }else{
                        foundResults.innerHTML += '\
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
                                        <button onclick="window.location.href='+editString+'">EDIT</button>\
                                    </div>\
                                </div>';
                    }
                }
            }
        });
    }else{
        dynamicSearch("", isAdmin);
    }
}
