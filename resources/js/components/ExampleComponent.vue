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
                <h6 class="h2 text-white d-inline-block mb-0">Negocios</h6>
                <nav arial-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a>Inicio</a></li>
                    <li class="breadcrumb-item activate" aria-current="page">Negocios</li>
                    </ol>
                </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                <button type="button" class="btn btn-sm btn-neutral" id="NuevoNegocio" @click="nuevoNegocio()">Nuevo Negocio</button>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<!--Tabla Negocios--->
<div class="table align-items-center">
  <paginate name="vpnegocios" :per="2" :list="lista_negocios">
<table class="default">

   <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Nombre</th>
                <th scope="col" class="sort" data-sort="budget">descripcion</th>
                <th scope="col" class="sort" data-sort="status">avenida</th>
                <th scope="col">no_ext</th>
                <th scope="col" class="sort" data-sort="completion">no_int</th>
                <th scope="col">Codigo Postal</th>
                <th scope="col">Telefono</th>
                <th scope="col">Producto</th>
            </tr>
        </thead>


  <tr v-for="v_negocio in paginated('vpnegocios')">

   <td> {{ v_negocio.nombre }}</td>
      <td> {{ v_negocio.descripcion }}</td>
         <td> {{ v_negocio.avenida }}</td>
            <td> {{ v_negocio.no_ext }}</td>
                  <td> {{ v_negocio.no_int }}</td>
                     <td> {{ v_negocio.cp }}</td>
                        <td> {{ v_negocio.telefono }}</td>
                         <td> {{ v_negocio.nombre_a }}</td>
                        <td><button type="button" class="btn btn-success" @click="editar_negocio(v_negocio)">Editar</button></td>
                        <td><button type="button" class="btn btn-danger" @click="eliminar_negocio(v_negocio)">Eliminar</button></td>

      </tr>
    </table>
  </paginate>
</div>

<!--Paginación-->
<div class="card-footer py-4">
  <nav aria-label="..." >
    <paginate-links for="vpnegocios" :classes="{'ul':['pagination','justify-content-end', 'mb-0'], 'li': 'page-item','a': 'page-link'}"></paginate-links>
  </nav>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Negocios</h5>
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
        <input type="text" class="form-control" v-model="negocio.nombre" id="nombre" placeholder="Nombre del Negocio">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="negocio.descripcion" id="descripcion" placeholder="Descripción del Negocio">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="negocio.avenida" id="avenida" placeholder="Avenida del Negocio">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="negocio.no_ext" id="no_ext" placeholder="No. Exterior del Negocio">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="negocio.no_int" id="no_int" placeholder="No. Interior del Negocio">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="negocio.cp" id="cp" placeholder="Código Postal del Negocio">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="negocio.telefono" id="telefono" placeholder="Teléfono Postal del Negocio">
      </div>
    </div>
  </div>

  

</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarNegocio">Guardar Cambios</button>
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
            this.obtener_negocios()
        },
        data(){
            return {
                negocio: {},
                v_error: '',
                lista_negocios: {},
                editando_negocio: false,
                paginate: ['vpnegocios']
            }
        },
        methods: {
            guardarNegocio(){

              if(this.editando_negocio){

                axios.post('/editar_negocio', this.negocio)
                    .then((response) => {
                        console.log("OK")
                        this.negocio = {}
                        this.v_error = ''
                        this.obtener_negocios()
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.errors

                        console.log(error.response)
                    })

                    this.editando_negocio = false

              }else{

                axios.post('/guardar_negocio', this.negocio)
                    .then((response) => {
                        console.log("OK")
                        this.negocio = {}
                        this.v_error = ''
                        this.obtener_negocios()
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.errors

                        console.log(error.response)
                    })
                
              }
                
            },
            obtener_negocios(){
                axios.get('/lista_negocios')
                    .then((response) => {
                        this.lista_negocios = response.data
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.message

                        console.log(error.response)
                    })
            },
            editar_negocio(param_negocio){
              this.editando_negocio = true
              this.negocio = param_negocio

              $('#exampleModal').modal('toggle');


            },
            eliminar_negocio(param_negocio){
              axios.get('/eliminar_negocio/' + param_negocio.id)
                    .then((response) => {
                        this.lista_negocios = response.data
                        this.obtener_negocios()
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.message

                        console.log(error.response)
                        
                    })

            },
            nuevoNegocio(){
              this.editando_negocio = false
              this.negocio={}
              $('#exampleModal').modal('toggle');
            }

        }
    }
</script>
