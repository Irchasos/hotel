/*
|--------------------------------------------------------------------------
| resources/js/app.js *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

$(
    function () {
        $(".datepicker").datepicker();
    }
);


$(
    function () {
        $(".autocomplete").autocomplete(
            {
                source: base_url + "/searchCities", /* Lecture 17 */
                minLength: 2,
                select: function (event, ui) {

                    //            console.log(ui.item.value);
                }


            }
        );
    }
);



