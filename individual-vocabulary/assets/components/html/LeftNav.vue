<template>

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <router-link to="/vocabulary/list" class="nav-link"><i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/quiz/quiz" class="nav-link"><i class="fas fa-fw fa-fighter-jet"></i>
                <span>Quiz</span></router-link>

        </li>
        <li class="nav-item">
            <router-link to="/vocabulary/add" class="nav-link"><i class="fas fa-fw fa-plus-circle"></i>
                <span>Add</span></router-link>

        </li>
        <li class="nav-item">
            <router-link to="/vocabulary/list" class="nav-link"><i class="fas fa-fw fa-list-ol"></i>
                <span>List</span></router-link>

        </li>
        <li class="nav-item">
            <router-link to="/user/setting" class="nav-link"><i class="fas fa-fw fa-cog"></i>
                <span>Settings</span></router-link>

        </li>
    </ul>
       
</template>

<script>

    export default {
        name: "left-nav",
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