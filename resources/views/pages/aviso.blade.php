@extends('layouts.app')

@section('content')

<div class="header bg-gradient-primary pt-5 pt-md-6">
    <div class="container-fluid">

        <!--Header-->
        <div class="heder pb-6">
        <div class="container-fluid">
            <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Alimentos</h6>
                <nav arial-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a>Inicio</a></li>
                    <li class="breadcrumb-item activate" aria-current="page">Alimentos</li>
                    </ol>
                </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                <button type="button" class="btn btn-sm btn-neutral" id="NuevoAlimento" @click="nuevoAlimento()">Nuevo Alimento</button>

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="card-footer py-4">
<center><h2>Aviso de Privacidad</h2></center>
<br>
<p>El presente documento constituye el Aviso de Privacidad para efectos de lo dispuesto en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (la ¨LFPDP¨) y las disposiciones que emanan de ella o se relacionan con la misma. Este Aviso de Privacidad (en lo sucesivo referido como ¨Aviso¨) aplica a la información personal recopilada sobre el Titular por ABC Digital, en su carácter de Responsable.</p>

<h3>¿Qué información recopilamos?</h3>

<p>El Responsable recolecta informaciÓn que puede identificarle de manera razonable, por ejemplo, a título enunciativo mas no limitativo: su nombre y apellidos; fecha de nacimiento; domicilio; dirección de correo electrónico; número de teléfono fijo y/o celular; Registro Federal de Contribuyentes (RFC); número de tarjetas y/o cuentas</p>

<h3>¿Cómo recopilamos la información?</h3>

<p>La recolección de datos personales podrá efectuarse por ejemplo:</p>

<ol>

 <li>mediante el uso de correos electrónicos y reuniones que sostengamos con usted de forma personal.</li>

<li>cuando se comunica vía telefónica con nosotros.</li>

<li>mediante la utilización de los sitios Web del Responsable</li>

<li> mediante el uso de herramientas de captura automática de datos</li>

<li>mediante la recopilación directa</ul>

<li>mediante fuentes de acceso público y de otras fuentes disponibles en el mercado</li>

</ol>

<p>Toda la información que recolectamos sobre usted puede combinarse para ayudarnos a adaptar nuestras comunicaciones a usted y determinar servicios nuevos o mejoras a los que ya prestamos, en atención a sus necesidades y preferencias.</p>

<h3>¿Cómo usamos o compartimos la información que recopilamos?</h3>

<p>Algunos ejemplos de las finalidades de la información que recopilamos son:</p>
<ul>
<li>Utilizamos la información que recopilamos para brindarle y ofertarle los servicios que solicita, para informarle acerca de otros servicios ofrecidos por el Responsable y para administrar nuestros sitios y servicios.</li>

<li>También para realizar estudios sobre datos demográficos, intereses y comportamiento; estudios de mercado y de consumo a efecto de adquirir y ofrecer productos y servicios personalizados, así como publicidad y contenidos más adecuados a sus necesidades.</li>

<li> Para formalizar el proceso contractual con clientes, consumidores, proveedores y otros terceros así como gestionar los servicios y relaciones comerciales con proveedores y otros terceros con los que tratamos.</li>
</ul>
</div>

@endsection