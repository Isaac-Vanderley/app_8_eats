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
                <h6 class="h2 text-white d-inline-block mb-0">Alimentos</h6>
                <nav arial-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="/#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item">Inicio</li>
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


<div class="table align-items-center">
  <paginate name="vpalimentos" :per="2" :list="lista_alimentos">
<table class="default">

   <thead class="thead-light">
            <tr>
                <th scope="col" class="sort" data-sort="name">Nombre del Alimento</th>
                <th scope="col" class="sort" data-sort="budget">descripcion</th>
                <th scope="col" class="sort" data-sort="status">precio</th>
                <th scope="col"> tipo</th>
                <th scope="col" class="sort" data-sort="completion">cantidad</th>
                <th scope="col" class="sort" data-sort="completion">Imagen</th>
            </tr>
        </thead>

  <tr v-for="v_alimento in paginated('vpalimentos')">

   <td> {{ v_alimento.nombre_a }}</td>
      <td> {{ v_alimento.descripcion }}</td>
         <td> {{ v_alimento.precio }}</td>
            <td> {{ v_alimento.tipo }}</td>
               <td> {{ v_alimento.cantidad }}</td>
               <td> <img :src="'/storage/'+ v_alimento.ruta_archivo" width="100px"></td>
                        <td><button type="button" class="btn btn-success" @click="editar_alimento(v_alimento)">Editar</button></td>
                        <td><button type="button" class="btn btn-danger" @click="eliminar_alimento(v_alimento)">Eliminar</button></td>

  </tr>

</table>
  </paginate>
</div>

<!--Paginación-->
<div class="card-footer py-4">
  <nav aria-label="..." >
    <paginate-links for="vpalimentos" :classes="{'ul':['pagination','justify-content-end', 'mb-0'], 'li': 'page-item','a': 'page-link'}"></paginate-links>
  </nav>
</div>




<!-- Modal Editar -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Editar Alimentos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!--1er-->
      <div class="modal-body">

        <div class="alert alert-default" role="alert">
          <strong>Valor Variable</strong> {{ v_error }}
        </div>
        
          <div class="form-group">
            <img :src="'/storage/'+ alimento.ruta_archivo" height="500px">
          </div>
        <!--Formulario-->
       <form>
          <div class="form-group">
            <input type="file" class="form-control" @change="geteArchivo">
          </div>

          <div class="form-group">
            <a :href="'descargar_archivo/' + alimento.id" id="verarchivo" target="verarchivo">Ver Archivo</a>
          </div>

  <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.id" id="nombre_a" placeholder="Nombre del Alimento">
      </div>
    </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.nombre_a" id="enombre_a" placeholder="Nombre del Alimento">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.descripcion" id="edescripcion" placeholder="Descripción del Alimento">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.precio" id="eprecio" placeholder="Precio">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.tipo" id="etipo" placeholder="Tipo">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.cantidad" id="ecantidad" placeholder="Cantidad">
      </div>
    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarAlimento">Guardar Cambios</button>
      </div>
    </div>
  </div>
<!--Fin-->

</div>

<!-- Modal2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabe2">Nuevo Alimento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!--1er-->
      <div class="modal-body">

        <div class="alert alert-default" role="alert">
          <strong>Valor Variable</strong> {{ v_error }}
        </div>
        <!--Tabla Alimentos-->
       <form>
          <div class="form-group">
            <input type="file" class="form-control" @change="getArchivo">
          </div>



  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.nombre_a" id="nombre_a" placeholder="Nombre del Alimento">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.descripcion" id="descripcion" placeholder="Descripción del Alimento">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.precio" id="precio" placeholder="Precio">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.tipo" id="tipo" placeholder="Tipo">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" class="form-control" v-model="alimento.cantidad" id="cantidad" placeholder="Cantidad">
      </div>
    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarAlimento">Guardar Cambios</button>
      </div>
    </div>
  </div>
<!--Fin-->
</div>



</div>
</template>

<script>
import VuePaginate from 'vue-paginate';

   export default {
        mounted() {
            console.log('Component mounted.')
            this.obtener_alimentos()
        },
        data(){
            return {
                alimento: {},
                ealimento:{},
                datosAlimentos: {},
                v_error: '',
                lista_alimentos: {},
                archivo:'',
                earchiv:'',
                editando_alimento: false,
                paginate: ['vpalimentos'],
                
            }
        },
        methods: {
          getArchivo(e){
            this.archivo = e.target.files[0]

          },
          geteArchivo(e){
            this.archivo = e.target.files[0]

          },

            guardarAlimento(){

              if(this.editando_alimento){

                const edatosAlimentos = new FormData

                edatosAlimentos.set('id',this.alimento.id)
                edatosAlimentos.set('nombre_a',this.alimento.nombre_a)
                edatosAlimentos.set('descripcion',this.alimento.descripcion)
                edatosAlimentos.set('precio',this.alimento.precio)
                edatosAlimentos.set('tipo',this.alimento.tipo)
                edatosAlimentos.set('cantidad',this.alimento.cantidad)
                edatosAlimentos.set('archivo',this.archivo)

                axios.get('/editar_alimento'+ this.alimento.id, edatosAlimentos)
                    .then((response) => {
                        console.log("OK")
                        this.alimento = {}
                        this.v_error = ''
                        this.obtener_alimentos()
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.errors

                        console.log(error.response)
                    })

                    this.editando_alimento = false

              }else{

                const datosAlimentos = new FormData

                datosAlimentos.set('nombre_a',this.alimento.nombre_a)
                datosAlimentos.set('descripcion',this.alimento.descripcion)
                datosAlimentos.set('precio',this.alimento.precio)
                datosAlimentos.set('tipo',this.alimento.tipo)
                datosAlimentos.set('cantidad',this.alimento.cantidad)
                datosAlimentos.set('archivo',this.archivo)

                axios.post('/guardar_alimento',datosAlimentos)
                    .then((response) => {
                        console.log("OK")
                        this.alimento = {}
                        this.v_error = ''
                        this.obtener_alimentos()
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.errors

                        console.log(error.response)
                    })
                
              }
                
            },
            obtener_alimentos(){
                axios.get('/lista_alimentos')
                    .then((response) => {
                        this.lista_alimentos = response.data
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.message

                        console.log(error.response)
                    })
            },
            editar_alimento(param_alimento){
              this.editando_alimento = true
              this.alimento = param_alimento

              $('#exampleModal').modal('toggle');


            },
            eliminar_alimento(param_alimento){
              axios.get('/eliminar_alimento/' + param_alimento.id)
                    .then((response) => {
                        this.lista_alimentos = response.data
                        this.obtener_alimentos()
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.message

                        console.log(error.response)
                        
                    })

            },
            
            nuevoAlimento(){
              this.editando_alimento = false
              this.alimento={}
              $('#exampleModal2').modal('toggle');
            }

        }
    }
</script>
