<template>
<div class="card-body">

<form id="payment-form" action="/procesarpagotarjeta" method="POST">

    <input type="hidden" name="token_id" id="token_id">
    <input type="hidden" name="_token" :value="csrf">

            <div class="form-group">
                <label for="owner" class="form-control-label">Numero de Tarjeta</label>
                <input type="text" class="form-control" id="n_tarjeta" data-openpay-card="card_number">
            </div>
            <div class="form-group">
                <label for="cvv" class="form-control-label">Nombre</label>
                <input type="text" class="form-control" id="cvv" data-openpay-card="holder_name">
            </div>
            <div class="form-group row" >
                <label for="cardNumber" class="col-sm-1 col-form-label">Mes</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="mes" data-openpay-card="expiration_month">
                </div>

                <label class="col-sm-1 col-form-label">Año</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="anio" data-openpay-card="expiration_year">
                </div>

                <label class="col-sm-1 col-form-label">CVV</label>
                <div class="col-sm-3">
                    <input type="password" class="form-control" id="cvv" data-openpay-card="cvv2">
                </div>
            </div>
            <div class="form-group" id="pay-now">
                <button type="submit" class="form-control btn btn-primary" id="pay-button">Confirmar</button>
            </div>
        </form>
</div>
</template>

<script>
export default({
    mounted() {
        console.log('Component mounted.')
    },
    data(){
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
})
</script>
