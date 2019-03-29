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
    var latitudines = $('#det_lat').text();
    var longitudines = $('#det_lng').text();
    // console.log(latitudines);
    // console.log(longitudines);


    //terzo geocomplete per la detail page pubblica
    $("#detailsAddress").geocomplete({
        map: "#my_map_details",
        location: [latitudines, longitudines],
        details: ".details_details",
        detailsAttribute: "data-geo"
    }).bind("geocode:result", function (event, result) {

        var latitude_details = result['geometry']['location'].lat();
        var longitude_details = result['geometry']['location'].lng();
        // console.log(latitude);
        // console.log(longitude);

        $("#latitude_details").val(latitude_details);
        $("#longitude_details").val(longitude_details);

    });

    $('#cercaBtn').on('click', function () {
        var address = $('#srcAddress').val();
        var lat = $('#latitude_search').val();
        var lng = $('#longitude_search').val();

        var rooms_number = $('#numStanze').val();
        var beds_number = $('#numPostiLetto').val();
        var raggio = $('#raggio').val();
        var services = $('.servizi').val();;

        $(".chkServices").each(function () {
            var ischecked = $(this).is(":checked");
            if (ischecked) {
                services += $(this).val() + " ";
            }
        });

        // CHIAMATA AJAX PER FILTRARE DATI FORM DELL'HOMEPAGE 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: 'POST',
            url: '/ajaxRequest',
            data: {
                address: address,
                lat: lat,
                lng: lng,
                rooms_number: rooms_number,
                beds_number: beds_number,
                raggio: raggio,
                services: services
            },
            success: function (data) {
                console.log(data);
            },
            error: function () {
                console.log('KOKOKOKOKO');
            }
        });
    });

    // CHIAMATA AJAX PER AUTOCOMPLETAMENTO EMAIL UTENTI REGISTRATI

    $("#autocomplete_email").one('keyup', function () {


        $.ajax({
            url: '/ajaxRequest',
            type: 'GET',
            success: function (data) {
                var locationsArray = data;
                // console.log(locationsArray);
                for (let index = 0; index < locationsArray.length; index++) {
                    const singleEmail = locationsArray[index];
                    // console.log(singleEmail);
                    $('#email_list').append("<option>" + singleEmail + "</option>")
                }
            },
            error: function () {

            }

        });

    });


});
