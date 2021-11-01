<template>
    <aside class="aside">
        <div class="aside-menu">
            <div class="aside-menu-circle">
                <span class="aside-menu-circle-icon" @click="$store.commit('SetProjectModalStatus', true)">
                    <i class="aside-menu-circle-icon-symbol far fa-folder-open"></i>
                </span>
                <span class="aside-menu-circle-icon" @click="$store.commit('SetUserModalStatus', true)">
                    <i class="fas fa-user"></i>
                </span>
                <span class="aside-menu-circle-icon">
                    <i class="fas fa-clipboard-list"></i>
                </span>
                <span class="aside-menu-circle-icon">
                    <i class="fas fa-question-circle"></i>
                </span>
                <span class="aside-menu-circle-icon">
                    <i class="fas fa-angle-double-right"></i>
                </span>
            </div>
            <div class="aside-menu-center">
                <i class="fas aside-menu-center-icon fa-plus"></i>
            </div>
        </div>


        <ul class="aside-list">
            <li class="aside-blind">
                <router-link class="aside-blind-link" to="/widgets"
                             v-slot="{ href, route, navigate, isActive, isExactActive }">
                    <a :class="{'active': isExactActive}" :href="href" @click="navigate">
                        <i class="aside-blind-icon fas fa-home"></i>
                        <span class="aside-blind-title">Главная</span>
                    </a>
                </router-link>
            </li>
            <li class="aside-blind">
                <router-link class="aside-blind-link" to="/projects"
                             v-slot="{ href, route, navigate, isActive, isExactActive }">
                    <a :class="{'active': isActive}" :href="href" @click="navigate">
                        <i class="aside-blind-icon far fa-folder-open"></i>
                        <span class="aside-blind-title">Проекты</span>
                    </a>
                </router-link>
            </li>
            <li class="aside-blind">
                <router-link class="aside-blind-link" to="/users"
                             v-slot="{ href, route, navigate, isActive, isExactActive }">
                    <a :class="{'active': isActive}" :href="href" @click="navigate">
                        <i class="aside-blind-icon fas fa-users"></i>
                        <span class="aside-blind-title">Пользователи</span>
                    </a>
                </router-link>
            </li>
            <li class="aside-blind">
                <a class="aside-blind-link" href="" title="">
                    <i class="aside-blind-icon fas fa-credit-card"></i>
                    <span class="aside-blind-title">Финансы</span>
                </a>
            </li>
            <li class="aside-blind">
                <a class="aside-blind-link" href="" title="">
                    <i class="aside-blind-icon far fa-clipboard"></i>
                    <span class="aside-blind-title">Отчеты</span>
                </a>
            </li>
        </ul>





    </aside>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {

        name: "Aside",
        data() {
            return {}

        },

    }
</script>

<style scoped>

</style>
