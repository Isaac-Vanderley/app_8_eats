<template>

<div>


<div class="header bg-gradient-primary pt-5 pt-md-6">
    <div class="container-fluid">

        <!--Header-->
        <div class="heder pb-6">
        <div class="container-fluid">
            <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Clientes</h6>
                <nav arial-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a >Inicio</a></li>
                    <li class="breadcrumb-item activate" aria-current="page">Clientes</li>
                    </ol>
                </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                <button type="button" class="btn btn-sm btn-neutral" id="NuevoNegocio" @click="nuevoCliente()">Nuevo Cliente</button>

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="table align-items-center">
  <paginate name="vpclientes" :per="2" :list="lista_clientes">
<table class="default">

   <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Nombre</th>
                <th scope="col" class="sort" data-sort="budget">apellido_paterno</th>
                <th scope="col" class="sort" data-sort="status">apellido_materno</th>
                <th scope="col">Correo Electronico</th>
                <th scope="col" class="sort" data-sort="completion">no_int</th>
                <th scope="col">no_ext</th>
                <th scope="col">Codigo Postal</th>
                <th scope="col">Telefono</th>
            </tr>
        </thead>

  <tr v-for="v_cliente in paginated('vpclientes')">

   <td> {{ v_cliente.nombre }}</td>
      <td> {{ v_cliente.apellido_paterno }}</td>
         <td> {{ v_cliente.apellido_materno }}</td>
            <td> {{ v_cliente.correo }}</td>
               <td> {{ v_cliente.no_int }}</td>
                  <td> {{ v_cliente.no_ext }}</td>
                     <td> {{ v_cliente.cp }}</td>
                        <td> {{ v_cliente.teléfono }}</td>
                        <td><button type="button" class="btn btn-success" @click="editar_cliente(v_cliente)">Editar</button></td>
                        <td><button type="button" class="btn btn-danger" @click="eliminar_cliente(v_cliente)">Eliminar</button></td>

  </tr>

</table>
  </paginate>
</div>

<!--Paginación-->
<div class="card-footer py-4">
  <nav aria-label="..." >
    <paginate-links for="vpclientes" :classes="{'ul':['pagination','justify-content-end', 'mb-0'], 'li': 'page-item','a': 'page-link'}"></paginate-links>
  </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="alert alert-default" role="alert">
          <strong>Valor Variable</strong> {{ v_error }}
        </div>
      

          <form>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="cliente.nombre" id="nombre" placeholder="Nombre del Cliente">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="cliente.apellido_paterno" id="apellido_paterno" placeholder="Apellio Paterno">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="cliente.apellido_materno" id="apellido_materno" placeholder="Apellido Materno">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="cliente.correo" id="correo" placeholder="Correo Electronico">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="cliente.no_ext" id="no_ext" placeholder="No. Exteior del Negocio">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="cliente.no_int" id="no_int" placeholder="No. Interior del Negocio">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="cliente.cp" id="cp" placeholder="Codigo Postal">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="cliente.teléfono" id="teléfono" placeholder="Numero Telefonico">
      </div>
    </div>
  </div>

  

</form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarCliente">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

</div>
</template>

<script>
import VuePaginate from 'vue-paginate';
   export default {
        mounted() {
            console.log('Component mounted.')
            this.obtener_clientes()
        },
        data(){
            return {
                cliente: {},
                v_error: '',
                lista_clientes: {},
                editando_clientes: false,
                paginate: ['vpclientes'],
            }
        },
        methods: {
            guardarCliente(){

              if(this.editando_cliente){

                axios.post('/editar_cliente', this.cliente)
                    .then((response) => {
                        console.log("OK")
                        this.cliente= {}
                        this.v_error = ''
                        this.obtener_clientes()
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.errors

                        console.log(error.response)
                    })

                    this.editando_cliente = false

              }else{

                axios.post('/guardar_cliente', this.cliente)
                    .then((response) => {
                        console.log("OK")
                        this.cliente = {}
                        this.v_error = ''
                        this.obtener_clientes()
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.errors

                        console.log(error.response)
                    })
                
              }
                
            },
            obtener_clientes(){
                axios.get('/lista_clientes')
                    .then((response) => {
                        this.lista_clientes = response.data
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.message

                        console.log(error.response)
                    })
            },
            editar_cliente(param_cliente){
              this.editando_cliente = true
              this.cliente = param_cliente

              $('#exampleModal').modal('toggle');


            },
            eliminar_cliente(param_cliente){
              axios.get('/eliminar_cliente/' + param_cliente.id)
                    .then((response) => {
                        this.lista_clientes = response.data
                        this.obtener_clientes()
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.message

                        console.log(error.response)
                        
                    })

            },
            nuevoCliente(){
              this.editando_cliente = false
              this.cliente={}
              $('#exampleModal').modal('toggle');
            }

        }
    }
</script>
