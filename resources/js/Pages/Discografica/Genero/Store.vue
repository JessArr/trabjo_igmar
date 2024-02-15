<template>
    <div class="card">
        <h1>Create Genero</h1>
        <form @submit.prevent="submitForm" class="form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input v-model="form.name" type="text" id="name" />
                <div v-if="errors.name" class="error">{{ errors.name }}</div>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input v-model="form.description" id="description" type="text" />
                <div v-if="errors.description" class="error">{{ errors.description }}</div>
            </div>

            <button  class="subm" type="submit">Create Genero</button>
        </form>
    </div>
</template>

<style scoped>
.subm {
    background-color: #4CAF50; /* Green */
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
    flex-direction: column; /* Align label and input vertically */
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



<script>


import {router} from "@inertiajs/vue3";

export default {
    props: {
        errors: Object,
        rout: String,
    },
    data() {
        return {
            form: {
                name: '',
                description: '',
            },
        };
    },
    methods: {
        async submitForm() {
            console.log(this.form);
            await this.$inertia.post(this.rout, this.form);
        },
    },
};
</script>
