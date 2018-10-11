<template>

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <router-link to="/vocabulary/list" class="navbar-brand mr-1">Individual Voc.</router-link>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>


        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
            </li>
        </ul>

    </nav>
       
</template>

<script>

    export default {
        name: "top-nav",
        data() {
            return {}
        },
        created() {
        },
        methods: {}
    }
</script>

<style scoped>

</style>