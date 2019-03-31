/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('geocomplete');
require('chart.js');
import Handlebars from 'handlebars/dist/cjs/handlebars.js'




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
    console.log(latitudines);
    console.log(longitudines);


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



        //ricerca welcome page
    $('#cercaBtn').on('click', function () {


        //inizio nascondendo tutte le card
        $('.appa_all').hide();


        //prendo le variabili dal form

        var address = $('#srcAddress').val();
        var lat = $('#latitude_search').val();
        var lng = $('#longitude_search').val();

        var rooms_number = $('#numStanze').val();
        var beds_number = $('#numPostiLetto').val();
        var raggio = $('#raggio').val();
        var services = [];

        $(".chkServices").each(function () {
            var ischecked = $(this).is(":checked");
            if (ischecked) {
                services.push($(this).val());

            }

        });


        // console.log(services);


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
                services: services,
            },
            success: function (data) {
                console.log(data);
                var collection = data.final;
                console.log(collection);



                //stampa dati con handlebars


                var source = $('#handlebars-template').html();
                var template = Handlebars.compile(source);
                for (const key in collection) {

                    var elem = `${key}`
                    // console.log(elem);
                    // console.log(collection[key].description);
                    // console.log(collection[key].visibility);


                    //link vs storage immagini
                    var immagine = collection[key].image
                    console.log(immagine);

                    if (immagine.includes('http')) {
                        var src = immagine
                    } else {
                        src = '/home/nicola/nicola_sites/progetto-boolbnb/storage/app/public/' + immagine
                        console.log(src);

                    }


                    var my_template = {
                        desc: collection[key].description,
                        prezzo: collection[key].price,
                        address: collection[key].address,
                        id_: collection[key].id,
                        source: src,

                    };
                    var html = template(my_template);

                    $('.appa_filtered').append(html);
                    // console.log(html);

                    //hidden apartments
                    if (collection[key].visibility == 1) {
                        $('#container-card').addClass('hidden')

                    }

                }

            },
            error: function () {
                console.log('KOKOKOKOKO');
            }
        });








    });



    //grafici visite

    var ascissa = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var visite_gen = $('#visite_gen').val();
    var visite_feb = $('#visite_feb').val();
    var visite_mar = $('#visite_mar').val();
    var visite_apr = $('#visite_apr').val();
    var visite_mag = $('#visite_mag').val();
    var visite_giu = $('#visite_giu').val();
    var visite_lug = $('#visite_lug').val();
    var visite_ago = $('#visite_ago').val();
    var visite_set = $('#visite_set').val();
    var visite_ott = $('#visite_ott').val();
    var visite_nov = $('#visite_nov').val();
    var visite_dic = $('#visite_dic').val();


    var ordinata = [visite_gen, visite_feb, visite_mar, visite_apr, visite_mag, visite_giu, visite_lug, visite_ago, visite_set, visite_ott, visite_nov, visite_dic]


    var posizione = $('#my_chart')

      var chart = new Chart(posizione, {
          // The type of chart we want to create
          type: 'bar',

          // The data for our dataset
          data: {
              labels: ascissa,
              datasets: [{
                  label: 'Monthly Visits',
                  backgroundColor: 'rgb(82, 39, 46, .3)',
                  borderColor: 'rgb(82, 39, 46)',
                  data: ordinata,
              }]
          },

          // Configuration options go here
        //   options : {
        //       scales: {
        //           yAxes: [{
        //             //   barPercentage: 1,
        //             //   barThickness: 60,
        //             //   maxBarThickness: 8,
        //             //   minBarLength: 20,
        //             //   gridLines: {
        //             //       offsetGridLines: true
        //               }
        //           }]
        //       }
        //   }
      });


});
