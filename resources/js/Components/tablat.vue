<template>
    <div class="container">
        <div class="table-section">
            <table class="custom-table">
                <thead>
                <tr>
                    <th v-for="(value, key) in object[0]" :key="key">{{ key }}</th>
                    <th v-if="object[0]" class="edit-header">Editar</th>
                    <th v-if="object[0]" class="delete-header">Eliminar</th>
                </tr>
                </thead>
                <tbody>
                <tr  v-for="(item) in object" :key="item.id">
                    <td v-for="(value, key) in item" :key="key">{{ value }}</td>
                    <td>
                        <button @click="editar(item.id)" class="edit-button">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminart(item.id)" class="delete-button">Eliminar</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div  class="button-section" >
            <button @click="crear()" class="create-button">+</button>
        </div>




        <div v-if="delet" class="overlay">
            <div class="confirmation-box">
                <p>¿Estás seguro de eliminar este elemento?</p>
                <div class="modal-buttons">
                    <button class="btndeletconf" @click="deleteConfirmed()">Sí</button>
                    <button  class="btndeltcancel" @click="cancelDelete()">No</button>
                </div>
            </div>
        </div>

        <div v-if="flash" class="overlay">
            <div  class="confirmation-box">
                {{flash.message }}
            </div>
        </div>






    </div>
</template>

<script>
import { router, Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        object: Array,
        editarRoute: String,
        eliminarRoute: String,
        crearRoute: String,


    },
    data() {
        return {
            delet: false,
            id: null,
            flash: null,
        };
    },
    methods: {

        editar(id) {
            router.get(this.editarRoute, { id: id });
        },
        eliminart(id) {
            console.log('eliminar');
            this.delet = true;
            this.id = id;
        },
        crear() {
            router.get(this.crearRoute);
        },
        deleteConfirmed() {
            router.delete(this.eliminarRoute   +'/'+  this.id );
            this.delet = false;
            this.flash = { message: 'Elemento eliminado' };
            setTimeout(() => {
                this.flash = null;
            }, 500);
        },
        cancelDelete() {
            this.delet = false;
        }
    },
};
</script>

<style scoped>
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}
.btndeletconf, .btndeltcancel {

    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    margin:  10px;
}

.btndeletconf {
    background-color: #ff6666; /* Red */
    color: white;
}

.btndeltcancel {
    background-color: #4caf50; /* Green */
    color: white;
}
.confirmation-box {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 40px;
}

.table-section {
    width: 100%;
    overflow-x: auto;
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px; /* Increased padding for better readability */
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.edit-button, .delete-button, .create-button {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
}

.edit-button {
    background-color: #ffcc00; /* Yellow */
    color: #000;
}

.delete-button {
    background-color: #ff6666; /* Red */
    color: white;
}

.button-section {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.create-button {
    background-color: #4caf50; /* Green */
    color: white;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    font-size: 30px;
    position: fixed;
}
</style>
