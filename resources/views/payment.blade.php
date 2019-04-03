@extends('layouts.app')
@section('content')


  <div class="container " >
    <h5 class="identificativo_app_pagamento hidden">{{$id}}</h5>
    <form id="payForm">

        <div class="col-md-4">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pay" id="exampleRadios1" value="2.99" >
                <label class="form-check-label" for="exampleRadios1">
                    2,99 per 24 ore
                </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="pay" id="exampleRadios2" value="5.99">
      <label class="form-check-label" for="exampleRadios2">
        5,99 per 72 ore
      </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="pay" id="exampleRadios3" value="9.99">
        <label class="form-check-label" for="exampleRadios3">
            9,99 per 144 ore
        </label>
    </div>
    </div>
</form>


     <div class="row">
       <div class="col-md-8 col-md-offset-2">
         <div id="dropin-container"></div>
         <button id="submit-button">Request payment method</button>
       </div>
     </div>
  </div>

  <script>

        $('input').on('change', function() {
            pay = $('input[name=pay]:checked', '#payForm').val();
            console.log(pay);
        });

  </script>



  <script>
   var button = document.querySelector('#submit-button');


braintree.dropin.create({
    authorization: "{{ Braintree_ClientToken::generate() }}",
    container: '#dropin-container'
}, function (createErr, instance) {
    button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
            $.get('{{ route('payment.process') }}', {payload, pay: pay}, function (response) {
            if (response.success) {
              alert('Payment successfull!');
              console.log(response);

                        if (response['transaction']['amount'] == '2.99') {
                            console.log(response['transaction']['amount']);

                            var appartamento_id = $('.identificativo_app_pagamento').text();
                            console.log(appartamento_id);

                              $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });

                              $.ajax({
                                    type: 'POST',
                                    url: '/passToWelcome',
                                    data: {
                                        appartamento_id: appartamento_id,
                                        tempo: 24,
                                    },
                                    success: function (data) {
                                            console.log(data);
                                    },
                                })

                        } else if (response['transaction']['amount'] == '5.99') {
                            console.log(response['transaction']['amount']);

                            var appartamento_id = $('.identificativo_app_pagamento').text();
                            console.log(appartamento_id);

                              $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });

                              $.ajax({
                                    type: 'POST',
                                    url: '/passToWelcome',
                                    data: {
                                        appartamento_id: appartamento_id,
                                        tempo: 72,
                                    },
                                    success: function (data) {
                                            console.log(data);
                                    },
                                })

                        } else if (response['transaction']['amount'] == '9.99') {
                            console.log(response['transaction']['amount']);

                            var appartamento_id = $('.identificativo_app_pagamento').text();
                            console.log(appartamento_id);

                              $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });

                              $.ajax({
                                    type: 'POST',
                                    url: '/passToWelcome',
                                    data: {
                                        appartamento_id: appartamento_id,
                                        tempo: 144,
                                    },
                                    success: function (data) {
                                            console.log(data);
                                    },
                                })
                        }

                    } else {
                        alert('Payment failed');
                    }
                }, 'json');
        });
    });
});
  </script>
@endsection

