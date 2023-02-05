<template>

    <aside class="sidebar-admin">
<!-- //////////////////////////////////////////////////////////////
////////////////////////////САЙДБАР///////////////////////////////
////////////////////////////////////////////////////////////////// -->
        <div class="buttons aside">
         <button class="buttons-action one" v-if="role == 'admin'" @click="$store.commit('SetUserModalStatus', true)">
            <i class="buttons-action-icon fas fa-user"></i>
            <span class="buttons-action-text">Добавить пользователя</span>
         </button>
       </div>

      <div class="items">

        <router-link v-for="link in links" :to="link.to"
                     v-slot="{ href, route, navigate, isActive, isExactActive }">
          <a :href="href" @click="navigate" :class="{'active': isExactActive}" class="items-item top">
            <i class="items-item-icon" :class="link.icon"></i>{{link.text}}
          </a>
        </router-link>
      </div>
   </aside>

</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {

        name: "Aside",
        data() {
            return {
                links: [
                    {
                        text: "Главная",
                        to: { name: "main-page"},
                        icon: "fas fa-compass"
                    },
                    {
                        text: "Клиенты",
                        to: { name: "clients"},
                        icon: "fas fa-folder-open"
                    },
                    {
                        text: "Пользователи",
                        to: { name: "users"},
                        icon: "fas fa-users"
                    }
                ]
            }

        },
        computed:{
            role(){
                return this.$store.getters.getRole;
            },
        }

    }
</script>

<style lang="scss" scoped>

.sidebar-admin{
  min-height: calc(100vh - 110px);
  box-sizing: border-box;
  padding-top: 20px;
  flex-shrink: 0;
}

</style>
