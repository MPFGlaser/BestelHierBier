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
            console.log(allCheckboxes[i].value);
            checkedCheckboxes.push(allCheckboxes[i].value); //van gaat mis
        }
    }

    if (checkedCheckboxes.length > 0) {
        var dataString = "&functionId=2&checkedArray=" + JSON.stringify(checkedCheckboxes);

        console.log(dataString);

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