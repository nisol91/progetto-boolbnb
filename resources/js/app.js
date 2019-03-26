/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('geocomplete');


$(document).ready(function () {


    //primo geocomplete per create/edit

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


    //secondo geocomplete per il form di ricerca
    $("#srcAddress").geocomplete({
        map: "#my_map_search",
        details: ".details_search",
        detailsAttribute: "data-geo"
    }).bind("geocode:result", function (event, result) {

        var latitude_search = result['geometry']['location'].lat();
        var longitude_search = result['geometry']['location'].lng();
        // console.log(latitude);
        // console.log(longitude);

        $("#latitude_search").val(latitude_search);
        $("#longitude_search").val(longitude_search);

    });

    $('#cercaBtn').on('click', function () {
        var indirizzo = $('#srcAddress').val();
        var lat = $('#latitude_search').val();
        var lng = $('#longitude_search').val();

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


        // var postData = {

        //     indirizzo: indirizzo,
        //     rooms_number: numStanze,
        //     beds_number: numPostiLetto,
        //     range: raggio,
        //     services: services

        // };

        // // console.log(postData);

        // var dataString = JSON.stringify(postData);

        // console.log(dataString);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: 'POST',
            url: '/ajaxRequest',
            data: {
                indirizzo: indirizzo,
                lat: lat,
                lng: lng,
                rooms_number: numStanze,
                beds_number: numPostiLetto,
                range: raggio,
                services: services
            },
            success: function (data) {
                console.log(data.success);
            },
            error: function () {
                console.log('KOKOKOKOKO');
            }
        });
    });
});
