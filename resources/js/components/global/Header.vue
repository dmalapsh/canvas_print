<template>
    <header class="header">
      <div class="header-images" @click="goMainPage">
<!--             <img  class="header-images-logo" src="/images/logo.png" alt="">-->
<!--             <img class="header-images-beta" src="/images/beta.jpg" alt="">-->
      </div>
<!--      <div class="header-notifications"><i class="header-notifications-icon fas fa-bell"> </i>-->
<!--        <span class="header-notifications-number">11</span>-->
<!--      </div>-->
      <div class="header-card" :class="{active: accTools}">
        <div class="header-card-client">
          <div class="header-card-client-line">
<!--            <img class="header-card-client-line-img" v-if="user.img_url" :src="user.img_url" alt="">-->
<!--              <img class="header-card-client-line-img" v-else src="/images/Layer 30.png" alt="">-->
            <div>
            <div class="header-card-client-line-name"> {{user_fio}}
            </div>
            <div class="header-card-client-line-role">
                <span>
                    {{role}}
                </span>
            </div>
          </div>
          </div>
        </div>
        <div class="header-card-box" v-bind:class="{active: accTools}">

          <button @click.prevent="$store.commit('SetUserModalStatus', user.id)"class="header-card-box-button">
              <span class="header-client-card-container-bottom-title">Редактировать профиль</span>
          </button>
          <button  @click="logout" class="header-card-box-button" type="">
             <i class="header-card-box-button-icon fas fa-sign-out-alt"></i>выйти
          </button>
        </div>
        <i @click="accTools = !accTools"
        v-bind:class="{'header-card-arrow--active': accTools}"
        class="header-card-arrow fas fa-angle-down">
        </i>
      </div>
    </header>
    
</template>

<script>
    export default {

      data () {
        return {
          accTools: false
        }
      },
      
        methods: {
            logout() {
                this.$store.commit("setLoggedIn", false);
                localStorage.removeItem('token');
                this.$root.isLogged = false;
                this.$router.push({ name: 'login' });
            },
            goMainPage(){
                this.$router.push({ name: 'widgets' });
            },
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            },
            user_fio() {
                return this.$store.getters.getUserFIO;
            },
            role() {
                return this.$store.getters.getRole;
            }
        },
    };
</script>

<style lang="scss">

.header-client-card-container-bottom-title{
  padding-left: 5px;
  transition: .3s all;
  color: #989593;
  font-size: 13px;

  &:hover{
    color: #7f2e53;
  }
}

.header-balance{
  flex-grow: 1;
  display: flex;
}

.header-balance-text{
  display: flex;
}

.header__balance_count{
  padding: 0 5px;
}

.header-card-arrow{
  transition: .3s all;
  cursor: pointer;
}

.header-card-arrow--active{
  transform: rotate(180deg);
}

.container-header{
  position: relative;
  z-index: 999;
}

</style>

