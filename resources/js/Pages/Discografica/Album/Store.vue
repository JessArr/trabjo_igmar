<template>
    <div class="card">
        <h1>Create Album</h1>
        <form @submit.prevent="submitForm" class="form">
            <div class="form-group">
                <label for="title">Title:</label>
                <input v-model="form.title" type="text" id="title" />
                <div v-if="errors.title" class="error">{{ errors.title }}</div>
            </div>

            <div class="form-group">
                <label for="release_date">Release Date:</label>
                <input v-model="form.release_date" type="date" id="release_date" />
                <div v-if="errors.release_date" class="error">{{ errors.release_date }}</div>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea v-model="form.description" id="description"></textarea>
                <div v-if="errors.description" class="error">{{ errors.description }}</div>
            </div>

            <div class="form-group">
                <label for="artist_id">Artist:</label>
                <select v-model="form.artist_id" id="artist_id">
                    <option v-for="artist in form.artists" :key="artist.id" :value="artist.id">{{ artist.name }}</option>
                </select>
                <div v-if="errors.artist_id" class="error">{{ errors.artist_id }}</div>
            </div>

            <button class="subm" type="submit">Create Album</button>
        </form>
    </div>
</template>

<script>


export default {
    props: {
        errors: Object,
        rout: String,
        routArtistas: String,
    },
    data() {
        return {
            form: {
                title: '',
                release_date: '',
                description: '',
                artist_id: null,
                artists: [],
            },
        };
    },
    async mounted() {

        await window.axios.get(this.routArtistas).then((response) => {
            this.form.artists = response.data;
        });

    },
    methods: {
        async submitForm() {
            console.log(this.form);
            await this.$inertia.post(this.rout, this.form);
        },
    },
};
</script>




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

input,
textarea {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.error {
    color: red;
    margin-top: 5px;
}
</style>
