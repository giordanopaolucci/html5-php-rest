var app = {
    title: "La mia lista di eventi",
    pizzaList: [],
    currency: "",
    init: function() {
        console.log("INIT!");
        $("#app_title").html(app.title);
        app.load();
    },
    load: function() {
        $.ajax(
            {
                url: "./logic-tier/pizza.php",
                method: "get",
                dataType: "json"
            }
        ).done(app.onSuccess).fail(app.onError);
    },
    onSuccess: function(jsonData) {
        console.log(jsonData);
        app.pizzaList = jsonData.pizzaList;
        app.currency = jsonData.currency;
        app.writelist();
    },
    onError: function(error) {
        console.log("ERROR!! Cause is " + JSON.stringify(error));
        $("body").html(error.responseText);
    },
    writelist: function() {
        var str = "";
        var currencySymbol = "";
        if (app.currency == "USD") {
            currencySymbol = "$";
        } else if (app.currency == "EUR") {
            currencySymbol = "€";
        }
        for (i = 0; i < app.pizzaList.length; i++) {
            console.log(i);
            var pizza = app.pizzaList[i];
            str+=`<div class="tablerow">
            <div class="tablecell">

                <img src="img/`+pizza.imgUrl+`">

            </div>
            <div class="tablecell">
                <div class="name">
                `+pizza.name+`
                </div>
            </div>
            <div class="tablecell">
                <div class="name">
                `+currencySymbol+pizza.price+`
                </div>
            </div>
        </div>`;
        }

        $("#table").append(str);
    }
}

$(document).ready(app.init);
