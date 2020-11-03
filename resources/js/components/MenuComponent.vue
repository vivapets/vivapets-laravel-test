<template>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item" v-for="m in $root.menu" v-bind:key="m.name">
            <router-link v-bind:to='m.url' class="nav-link">{{ m.name }}</router-link>
        </li>
    </ul>
</template>

<script>
    export default {
        
    }
</script>