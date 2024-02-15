<template>
    <div>
        <Dashboard></Dashboard>

        <tablat :object="objeto" :editarRoute="editarRoute" :eliminarRoute="eliminarRoute" :crearRoute="crearRoute"></tablat>
    </div>
    <div>

    </div>
</template>

<script>
import Dashboard from "@/Components/Dashboard.vue";
import tablat from "@/Components/tablat.vue";


export default {
    props: {objeto:Array, editarRoute: String, eliminarRoute: String, crearRoute: String},
    components: {
        tablat,
        Dashboard
    }
}
</script>
