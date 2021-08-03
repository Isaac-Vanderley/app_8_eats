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
                    <h6 class="h2 text-white d-inline-block mb-0">Repartidor</h6>
                    <nav arial-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Inicio</li>
                        <li class="breadcrumb-item activate" aria-current="page">Repartidor</li>
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



                
    <form>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" v-model="empleado.user" id="nombre_a" placeholder="Usuario">
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" v-model="empleado.correo" id="correo" placeholder="correo">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" v-model="empleado.a_paterno" id="a_paterno" placeholder="apellido pat">
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" v-model="empleado.a_materno" id="a_materno" placeholder="apellido mat">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control"  v-model="empleado.telefono" id="cantidad" placeholder="telefono">
            </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" @click="verEmpleado(empleado)">Guardar Cambios</button>
    </form>


</div>

</template>
<script>
export default {
    mounted(){
        
    },
    data(){
        return{
            empleado:{ }
        }
    },
    methods:{
        verEmpleado(){
        axios.post('/ver_empleado', this.cliente)
                    .then((response) => {
                        
                    })
                    .catch((error) => {
                        this.v_error = error.response.data.errors

                        console.log(error.response)
                    })

        }
    }
    
}
</script>