@extends('layouts.app', ['title'=>__('Pago Tarjeta')])

@push('jsH')

    <script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay.v1.js"></script>
    <!-- Add openpay-data.v1.js after opnepay.v1.js -->
    <script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


    <script type="text/javascript">
            OpenPay.setId('mzdtln0bmtms6o3kck8f');
            OpenPay.setApiKey('pk_f0660ad5a39f4912872e24a7a660370c');
            OpenPay.setSandboxMode(true);

            OpenPay.token = Openpay.deviceData.setup('payment-form', success_callbak, error_callbak);  

    $('#pay-button').on('click', function(event) {
       event.preventDefault();
       $("#pay-button").prop( "disabled", true);
       OpenPay.token.extractFormAndCreate('payment-form', success_callbak, error_callbak);              
    });
    
        var success_callbak = function(response) {
                var token_id = response.data.id;
                $('#token_id').val(token_id);
                $('#payment-form').submit();
        };

        var error_callbak = function(response) {
            var desc = response.data.description != undefined ?
            response.data.description : response.message;
            alert("ERROR [" + response.status + "] " + desc);
        $("#pay-button").prop("disabled", false);
        };
</script>


@endpush

@section('content')

    @include('users.partials.header', [
        'title' => __('Pago del Cliente: ') . ' '. auth()->user()->name,
        'description' => __('Pago con Tarjeta'),
        'class' => 'col-lg-7'
    ])   



    <pagotarjeta-component/>

    @include('layouts.footers.auth')

@endsection


