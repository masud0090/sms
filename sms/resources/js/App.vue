<template>
    <div class="container">
        <nav-menu></nav-menu>
        <transition>
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    import NavMenu from "./components/NavMenu";

    export default {

        components: {
            'nav-menu' : NavMenu
        }
    }


</script>
