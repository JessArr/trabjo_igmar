<template>
    <div class="card">
        <h1>Update Cancion</h1>
        <form @submit.prevent="submitForm" class="form">
            <div class="form-group">
                <label for="title">Title:</label>
                <input v-model="form.title" type="text" id="title" />
                <div v-if="errors.title" class="error">{{ errors.title }}</div>
            </div>

            <div class="form-group">
                <label for="lyrics">Lyrics:</label>
                <!-- Change type to "text" for lyrics -->
                <input v-model="form.lyrics" type="text" id="lyrics" />
                <div v-if="errors.lyrics" class="error">{{ errors.lyrics }}</div>
            </div>

            <div class="form-group">
                <label for="duration_seconds">Duration seconds:</label>
                <input v-model="form.duration_seconds" type="number" id="duration_seconds" />
                <div v-if="errors.duration_seconds" class="error">{{ errors.duration_seconds }}</div>
            </div>

            <div class="form-group">
                <label for="artist_id">Artist:</label>
                <select v-model="form.artist_id" @change="fetchAlbums" id="artist_id">
                    <option v-for="artist in form.artists" :key="artist.id" :value="artist.id">{{ artist.name }}</option>
                </select>
                <div v-if="errors.artist_id" class="error">{{ errors.artist_id }}</div> <!-- Update error field name -->
            </div>

            <div class="form-group">
                <label for="album_id">Album:</label>
                <select v-model="form.album_id" id="album_id">
                    <option v-for="album in form.albums" :key="album.id" :value="album.id">{{ album.title }}</option>
                </select>
                <div v-if="errors.album_id" class="error">{{ errors.album_id }}</div>
            </div>

            <div class="form-group">
                <label for="genero_id">Genre:</label>
                <select v-model="form.genero_id" id="genero_id">
                    <option v-for="genero in form.generos" :key="genero.id" :value="genero.id">{{ genero.name }}</option>
                </select>
                <div v-if="errors.genero_id" class="error">{{ errors.genero_id }}</div>
            </div>

            <button class="subm" type="submit">Update Album</button> <!-- Change button text to "Update Album" -->
        </form>
    </div>
</template>

<script>
export default {
    props: {
        errors: Object,
        rout: String,
        routArtistas: String,
        routAlmbunes: String,
        routGeneros: String,
        object: Object, // Pass the existing song data as a prop
    },
    data() {
        return {
            form: {
                id: this.object.id,
                title: this.object.title,
                lyrics: this.object.lyrics,
                duration_seconds: this.object.duration_seconds,
                artist_id: this.object.artist_id,
                album_id: this.object.album_id,
                genero_id: this.object.genero_id,
                artists: [],
                albums: [],
                generos: [],
            },
        };
    },
    async mounted() {

        await Promise.all([
            window.axios.get(this.routArtistas).then((response) => {
                this.form.artists = response.data;
            }),
            window.axios.get(this.routGeneros).then((response) => {
                this.form.generos = response.data;
            }),
        ]);

        this.fetchAlbums();
    },
    watch: {
        'form.artist_id': 'fetchAlbums',
    },
    methods: {
        async fetchAlbums() {
            if (this.form.artist_id) {
                await window.axios.get(this.routAlmbunes + this.form.artist_id).then((response) => {
                    this.form.albums = response.data;
                });
            } else {
                this.form.albums = [];
            }
        },
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

input,
textarea,
select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.error {
    color: red;
    margin-top: 5px;
}
</style>
