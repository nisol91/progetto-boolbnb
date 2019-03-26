/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('geocomplete');


$(document).ready(function () {

    $("#indirizzo").geocomplete({
        map: "#my_map",
        details: ".details",
        detailsAttribute: "data-geo"
    }).bind("geocode:result", function (event, result) {

        var latitude = result['geometry']['location'].lat();
        var longitude = result['geometry']['location'].lng();
        // console.log(latitude);
        // console.log(longitude);

        $("#latitude").val(latitude);
        $("#longitude").val(longitude);

    });

    $('#cercaBtn').on('click', function () {
        var indirizzo = $('#srcAddress').val();
        var numStanze = $('#numStanze').val();
        var numPostiLetto = $('#numPostiLetto').val();
        var raggio = $('#raggio').val();
        var services = "";

        $(".chkServices").each(function () {
            var ischecked = $(this).is(":checked");
            if (ischecked) {
                services += $(this).val() + " ";
            }
        });


        var postData = {

            indirizzo: indirizzo,
            rooms_number: numStanze,
            beds_number: numPostiLetto,
            range: raggio,
            services: services

        };

        // console.log(postData);

        var dataString = JSON.stringify(postData);

        console.log(dataString);


        $.ajax({
            type: "POST",
            url: "welcome.php",
            data: {
                myData: dataString
            },
            success: function (data) {

                console.log(data);

            },
            error: function (e) {
                console.log('KOKOKOKOKO');
            }
        });


    });


});
