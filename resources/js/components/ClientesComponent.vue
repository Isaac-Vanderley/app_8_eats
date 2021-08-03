<template>

  <div>


    <div class="header bg-gradient-green pt-5 pt-md-6">
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
                        <button type="button" class="btn btn-sm btn-success" id="NuevoNegocio" @click="nuevoCliente()">Nuevo Cliente</button>
                    </div>
                </div>
              </div>
          </div>
        </div>
        <!--Fin Header-->

        </div>
      </div>
    <!--Tabla-->
    <div class="table table-responsive">
      <paginate name="vpclientes" :per="2" :list="lista_clientes">
        <table class="default">

          <thead class="thead-light">
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">apellido paterno</th>
              <th scope="col">apellido materno</th>
              <th scope="col">Correo Electronico</th>
              <th scope="col">No. Interior</th>
              <th scope="col">No. Exterior</th>
              <th scope="col">Codigo Postal</th>
              <th scope="col">Telefono</th>
            </tr>
          </thead>
          <tbody>
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
              <td><button type="button" class="btn btn-danger" @click="mensajeEliminar(v_cliente)">Eliminar</button></td>

            </tr>
          </tbody>

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
          <div class="modal-header" >
            <h1 class="abs-center">Clientes</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form>
                    <div class="form-group">
                      <label >Nombre del Cliente</label>
                      <input type="text" class="form-control" v-model="cliente.nombre" id="nombre" placeholder="Nombre del Cliente" >
                    </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Apellido Paterno</label>
                      <input type="text" class="form-control" v-model="cliente.apellido_paterno" id="apellido_paterno" placeholder="Apellio Paterno">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Apellido Materno</label>
                      <input type="text" class="form-control" v-model="cliente.apellido_materno" id="apellido_materno" placeholder="Apellido Materno">
                    </div>
                  </div>
                </div>

                  
                    <div class="form-group">
                      <label for="">Correo Electronico</label>
                      <input type="text" class="form-control" v-model="cliente.correo" id="correo" placeholder="Correo Electronico">
                    </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">No. Exterior</label>
                      <input type="text" class="form-control" v-model="cliente.no_ext" id="no_ext" placeholder="No. Exterior del Cliente">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">No. Interior</label>
                      <input type="text" class="form-control" v-model="cliente.no_int" id="no_int" placeholder="No. Interior del Cliente">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Codigo Postal</label>
                      <input type="text" class="form-control" v-model="cliente.cp" id="cp" placeholder="Codigo Postal">
                    </div>
                  </div>
                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Numero de Telefono</label>
                      <input type="text" class="form-control" v-model="cliente.teléfono" id="teléfono" placeholder="Numero Telefonico">
                    </div>
                  </div>
                </div>
            </form>

            <div class="alert alert-danger" role="alert">
              <strong>Valor Variable</strong> {{ v_error }}
            </div>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" @click="guardarCliente">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>

  </div>

</template>

<script>
import VuePaginate from 'vue-paginate';
import Swal from 'sweetalert2'
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
                        
                        this.mensajeAceptado();
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
                        
                        this.mensajeAceptado();
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
            mensajeEliminar(param_cliente){

                 Swal.fire({
                title: 'Estas seguro?',
                text: "No lo podras revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminalo!'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                    'Cliente eliminado!',
                    'Tu registro ha sido eliminado',
                    'success'
                  )

                  this.eliminar_cliente(param_cliente);
                }
              })
            },
            mensajeAceptado(){
              Swal.fire({
                          icon: 'success',
                          title: 'Cliente Guardado',
                          showConfirmButton: false,
                          timer: 1500
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
