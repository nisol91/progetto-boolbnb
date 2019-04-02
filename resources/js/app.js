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

        //nascondo anche le card di un eventuale ricerca precedente
        $('.appa_filtered').find('.card').remove();



        //prendo le variabili dal form

        var address = $('#srcAddress').val();
        var lat = $('#latitude_search').val();
        var lng = $('#longitude_search').val();
        var insert_lat = $('#insert_lat').val();
        var insert_lng = $('#insert_lng').val();

        var rooms_number = $('#numStanze').val();
        var beds_number = $('#numPostiLetto').val();
        var raggio = $('#raggio').val();
        var price = $('#prezzo').val();

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
                insert_lat: insert_lat,
                insert_lng: insert_lng,
                price: price,
            },
            success: function (data) {
                console.log(data);
                var collection = data.success;
                console.log(collection);




                for (const key in collection) {

                    var elem = `${key}`
                    // console.log(elem);
                    // console.log(collection[key].description);
                    // console.log(collection[key].visibility);


                    //calcolo distanze raggio

                    function measure(lat1, lon1, lat2, lon2) { //haversine formula
                        var R = 6378.137; // Radius of earth in KM
                        var dLat = lat2 * Math.PI / 180 - lat1 * Math.PI / 180;
                        var dLon = lon2 * Math.PI / 180 - lon1 * Math.PI / 180;
                        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                            Math.sin(dLon / 2) * Math.sin(dLon / 2);
                        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                        var d = R * c;
                        return d; // distanza in km
                    }
                    console.log([
                        collection[key].lat,
                        collection[key].lng,
                        insert_lat,
                        insert_lng
                    ]);

                    var distanza_decimal = measure(collection[key].lat, collection[key].lng, insert_lat, insert_lng);
                    var distanza = Math.round(distanza_decimal);
                    console.log(distanza);
                    //aggiungo a ogni appartamento la sua distanza dal punto di coordinate note
                    collection[key].distance = distanza
                    var dist = collection[key].distance
                    console.log(collection);


                    //ora c e un if in cui se ho definito il raggio stampo solo gli appartamenti a distanza inferiore al raggio,
                    //se invece l ho definito, allora stampo normalmente.
                    if (raggio > 0) {
                        console.log(raggio);

                        if (distanza <= raggio) {
                            handlebars_print_collection(collection[key])
                        }
                    } else {
                        handlebars_print_collection(collection[key])
                    }

                }
                //Riordino by distanza--

                $('.appa_filtered .contenitore_appa').sort(sort_li) // sort elements
                    .appendTo('.appa_filtered'); // append again to the list
                // sort function callback
                function sort_li(a, b) {
                    // return ($(a).attr("dist")) < ($(b).attr("dist")) ? 1 : -1;
                    return ($(a).attr("dist")) - ($(b).attr("dist"))
                }


                //-------


            },
            error: function () {
                console.log('KOKOKOKOKO');
            }
        });




    });


    //stampa dati con handlebars

    function handlebars_print_collection(indice) {

        var source = $('#handlebars-template').html();
        var template = Handlebars.compile(source);
        //link vs storage immagini
        var immagine = indice.image
        console.log(immagine);

        if (immagine.includes('http')) {
            var src = immagine
        } else {
            src = 'http://127.0.0.1:8000/storage/' + immagine

            console.log(src);

        }
        var my_template = {
            desc: indice.description,
            prezzo: indice.price,
            address: indice.address,
            id_: indice.id,
            dist: indice.distance,
            source: src,

        };
        var html = template(my_template);

        $('.appa_filtered').append(html);
        // console.log(html);

        //hidden apartments
        if (indice.visibility == 1) {
            $('#container-card').addClass('hidden')

        }
    }

    //braintree




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

    });




    //autocomplete


    $("#autocomplete_email").one('keyup', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/ajaxRequestAuto',
            type: 'GET',
            success: function (data) {
                var locationsArray = data;
                // console.log(locationsArray);
                for (let index = 0; index < locationsArray.length; index++) {
                    const singleEmail = locationsArray[index];
                    // console.log(singleEmail);
                    $('#email_list').append("<option name='email'>" + singleEmail + "</option>")
                }
            },
            error: function () {
                console.log('errore');

            }
        });
    });



    //######filtro selezionando i checkbox


  $('.chkServices').on('click', function () {


      //inizio nascondendo tutte le card
      $('.appa_all').hide();

      //nascondo anche le card di un eventuale ricerca precedente
      $('.appa_filtered').find('.card').remove();



      //prendo le variabili dal form

      var address = $('#srcAddress').val();
      var lat = $('#latitude_search').val();
      var lng = $('#longitude_search').val();
      var insert_lat = $('#insert_lat').val();
      var insert_lng = $('#insert_lng').val();

      var rooms_number = $('#numStanze').val();
      var beds_number = $('#numPostiLetto').val();
      var raggio = $('#raggio').val();
      var price = $('#prezzo').val();

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
              insert_lat: insert_lat,
              insert_lng: insert_lng,
              price: price,
          },
          success: function (data) {
              console.log(data);
              var collection = data.success;
              console.log(collection);




              for (const key in collection) {

                  var elem = `${key}`
                  // console.log(elem);
                  // console.log(collection[key].description);
                  // console.log(collection[key].visibility);


                  //calcolo distanze raggio

                  function measure(lat1, lon1, lat2, lon2) { //haversine formula
                      var R = 6378.137; // Radius of earth in KM
                      var dLat = lat2 * Math.PI / 180 - lat1 * Math.PI / 180;
                      var dLon = lon2 * Math.PI / 180 - lon1 * Math.PI / 180;
                      var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                          Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                          Math.sin(dLon / 2) * Math.sin(dLon / 2);
                      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                      var d = R * c;
                      return d; // distanza in km
                  }
                  console.log([
                      collection[key].lat,
                      collection[key].lng,
                      insert_lat,
                      insert_lng
                  ]);

                  var distanza_decimal = measure(collection[key].lat, collection[key].lng, insert_lat, insert_lng);
                  var distanza = Math.round(distanza_decimal);
                  console.log(distanza);
                  //aggiungo a ogni appartamento la sua distanza dal punto di coordinate note
                  collection[key].distance = distanza
                  var dist = collection[key].distance
                  console.log(collection);


                  //ora c e un if in cui se ho definito il raggio stampo solo gli appartamenti a distanza inferiore al raggio,
                  //se invece l ho definito, allora stampo normalmente.
                  if (raggio > 0) {
                      console.log(raggio);

                      if (distanza <= raggio) {
                          handlebars_print_collection(collection[key])
                      }
                  } else {
                      handlebars_print_collection(collection[key])
                  }

              }
              //Riordino by distanza--

              $('.appa_filtered .contenitore_appa').sort(sort_li) // sort elements
                  .appendTo('.appa_filtered'); // append again to the list
              // sort function callback
              function sort_li(a, b) {
                  return ($(a).attr("dist")) > ($(b).attr("dist")) ? 1 : -1;
              }


              //-------


          },
          error: function () {
              console.log('KOKOKOKOKO');
          }
      });




  });






});
