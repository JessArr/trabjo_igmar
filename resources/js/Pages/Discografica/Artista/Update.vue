<template>
    <div class="card">
        <h1>Update: {{ objeto.name }}</h1>
        <form @submit.prevent="submitForm" class="form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input v-model="form.name" type="text" id="name" />
                <div v-if="errors.name" class="error">{{ errors.name }}</div>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input v-model="form.last_name" id="last_name" type="text" />
                <div v-if="errors.last_name" class="error">{{ errors.last_name }}</div>
            </div>

            <div class="form-group">
                <label for="stage_name">Stage Name:</label>
                <input v-model="form.stage_name" id="stage_name" type="text" />
                <div v-if="errors.stage_name" class="error">{{ errors.stage_name }}</div>
            </div>

            <div class="form-group">
                <label for="nationality">Nationality:</label>
                <input v-model="form.nationality" id="nationality" type="text" />
                <div v-if="errors.nationality" class="error">{{ errors.nationality }}</div>
            </div>

            <div class="form-group">
                <label for="birthdate">Birthdate:</label>
                <input v-model="form.birthdate" id="birthdate" type="date" />
                <div v-if="errors.birthdate" class="error">{{ errors.birthdate }}</div>
            </div>

            <div class="form-group">
                <label for="Biography">Biography:</label>
                <textarea v-model="form.Biography" id="Biography"></textarea>
                <div v-if="errors.Biography" class="error">{{ errors.Biography }}</div>
            </div>

            <button class="subm" type="submit">Update Artista</button>
        </form>
    </div>
</template>

<style scoped>
/* ... Your existing styles ... */
</style>

<script>
import { router } from "@inertiajs/vue3";

export default {
    props: {
        errors: Object,
        rout: String,
        objeto: Object,
    },
    data() {
        return {
            form: {
                id: this.objeto.id,
                name: this.objeto.name,
                last_name: this.objeto.last_name,
                stage_name: this.objeto.stage_name,
                nationality: this.objeto.nationality,
                birthdate: this.objeto.birthdate,
                Biography: this.objeto.Biography,
            },
        };
    },
    methods: {
        async submitForm() {
            console.log(this.form);
            await this.$inertia.put(this.rout, this.form);
        },
    },
};
</script>


<style scoped>
.subm {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 12px;
}

.card {
    max-width: 400px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.error {
    color: red;
    margin-top: 5px;
}
</style>




