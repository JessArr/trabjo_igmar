<template>
    <nav class="navigation">
        <Link :href="route('artistas.show')" class="nav-link">Artistas</Link>
        <Link :href="route('albums.show')" class="nav-link">Albums</Link>
        <Link :href="route('canciones.show')" class="nav-link">Canciones</Link>
        <Link :href="route('generos.show')" class="nav-link">Generos</Link>
    </nav>
</template>

<style scoped>
.navigation {
    background-color: #333; /* Cambia el color de fondo según tus preferencias */
    padding: 10px;
    text-align: center;
}

.nav-link {
    color: #fff; /* Cambia el color del texto según tus preferencias */
    text-decoration: none;
    margin: 0 10px;
    font-weight: bold;
}

.nav-link:hover {
    text-decoration: underline; /* Cambia el estilo al pasar el ratón sobre el enlace */
}
</style>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
