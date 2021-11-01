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

        <router-link class="" to="/widgets"
                     v-slot="{ href, route, navigate, isActive, isExactActive }">
          <a :href="href" @click="navigate" :class="{'active': isExactActive}" class="items-item top">
            <i class="items-item-icon fas fa-compass"></i>Главная
          </a>
        </router-link>

        <router-link to="/report" v-slot="{ href, route, navigate, isActive, isExactActive }">
          <a :href="href" @click="navigate" :class="{'active': isExactActive}" class="items-item">
            <i class="items-item-icon fas fa-folder-open"></i>Отчет
          </a>
        </router-link>

        <router-link v-if="role == 'admin'" to="/users"
        v-slot="{ href, route, navigate, isActive, isExactActive }"
        >
          <a :href="href" @click="navigate" :class="{'active': isExactActive}" class="items-item">
            <i class="items-item-icon fas fa-users"></i>Пользователи
          </a>
        </router-link>
         
<!--         <a href="" class="items-item">-->
<!--            <i class="items-item-icon fas fa-credit-card"></i>Финансы-->
<!--         </a>-->
<!--      -->
<!--         <a href="" class="items-item">-->
<!--            <i class="items-item-icon clipboard fas fa-clipboard-list"></i>Отчеты-->
<!--         </a>-->
      </div>
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
