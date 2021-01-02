function dynamicSearch(searchString, isAdmin) {
    let foundResults = $('.foundItems');
    var dataString = "&functionId=1&searchString=" + searchString;
    $.ajax({
        url: "../php/Core/ajaxCallRegulator.php",
        type: 'POST',
        data: dataString,
        success: function (data) {
            foundResults.html(data);
        }
    });
}

const debounce = (func, delay) => {
    let inDebounce
    return function () {
        const context = this
        const args = arguments
        clearTimeout(inDebounce)
        inDebounce = setTimeout(() => func.apply(context, args), delay)
    }
}


function filterByCheckbox(isAdmin) {
    let foundResults = $('.foundItems');
    var allCheckboxes = document.getElementsByName('filterCheckbox');
    var checkedCheckboxes = [];

    for (var i = 0; i < allCheckboxes.length; i++) {
        if (allCheckboxes[i].checked) {
            checkedCheckboxes.push(allCheckboxes[i].value);
        }
    }

    if (checkedCheckboxes.length > 0) {
        var dataString = "&functionId=2&checkedArray=" + JSON.stringify(checkedCheckboxes);
        $.ajax({
            url: "../php/Core/ajaxCallRegulator.php",
            type: 'POST',
            data: dataString,
            success: function (data) {
                foundResults.html(data);
            }
        });
    } else {
        debounce(dynamicSearch("", isAdmin), 500);
    }
}

function filterByPrice(isAdmin){
    var slider = document.getElementById("priceSlider");
    document.getElementById('priceLabel').innerHTML = '&#8364;'+ slider.value;

    let foundResults = $('.foundItems');
    var dataString = "&functionId=3&searchPrice=" + slider.value;
    $.ajax({
        url: "../php/Core/ajaxCallRegulator.php",
        type: 'POST',
        data: dataString,
        success: function (data) {
            console.log(data);
            foundResults.html(data);
        }
    });
}
