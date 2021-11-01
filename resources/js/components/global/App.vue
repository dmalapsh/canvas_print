<template>
    <div class="app">
        <Header v-if="loggedIn"></Header>
        <Aside v-if="loggedIn"></Aside>
        <div class="page-container">
            <router-view :key="contentKey"></router-view>
        </div>

        <userModal></userModal>
        <transition  name="spinner">
            <div class="container-loader" v-if="spinner">
                <div class="loader"></div>
            </div>
        </transition>
    </div>
</template>

<script>
  /* */
    export default {
        data() {
            return {
                spinner: false,
                contentKey: 1,
                'v-b-modal': false
            }
        },
        methods: {
            login() {
                var url = route('auth.me');
                this.axios.post(url).then(response => {
                    var redirect_url = localStorage.getItem("redirect");
                    this.$store.commit("setUserId", response.data);
                    this.$store.commit("setRole", response.data.role);
                    this.$store.commit("setUserFIO", response.data.name);
                    this.$store.commit("setLoggedIn", true);
                    if (!response.data.is_verified){
                        this.$store.commit('SetUserModalStatus', response.data.id);
                        this.$noty.error('Установите свой пароль');
                    }
                    if (this.$router.currentRoute.name == "login") {
                        if (redirect_url) {
                            this.$router.push(redirect_url);
                            localStorage.setItem("redirect", "");
                        } else {
                            this.$router.push({ name: 'widgets' })
                        }
                    }
                }).catch(error => { this.logout(); this.$noty.info('Автаризуйтесь в системе'); });
            },
            logout() {
                localStorage.setItem("token", "");
                localStorage.setItem("redirect", window.location.pathname);
                this.$router.push({ name: 'login' })
            },
            checkAuth() {
                this.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
                if (!localStorage.getItem('token')) {
                    if (window.location.pathname != "/login") {
                        this.logout();
                    }
                } else {
                    this.login();
                }
                this.axios.interceptors.request.use((config) => {
                    this.spinner = true;
                    return config;
                }, (error) => {
                    this.spinner = false;
                    return console.log('error');
                });
                this.axios.interceptors.response.use((response) => {
                    this.spinner = false;
                    console.log('finish')
                    return response;
                }, (error) => {
                    this.spinner = false;
                    if (error.response.status == 402){
                        this.$noty.error(error.response.data.message);
                    } else {
                        this.$noty.error('Сервер отказал в подключении');
                    }
                    return console.log(error);
                });
            },
        },
        watch: {
            '$route'(to, from) {
                this.checkAuth();
                if (to.name == from.name) {
                    this.contentKey++;
                }
            }
        },
        created() {
            this.checkAuth();
        },
        computed: {
            isSpinner() {
                return this.$store.getters.isSpinner;
            },
            isEditorMode() {
                return this.$store.getters.isEditorMode;
            },
            loggedIn() {
                return this.$store.getters.loggedIn;
            },
            cache() {
                return this.$store.getters.getCache;
            },
            role() {
                return this.$store.getters.getRole;
            }
        },
    }
</script>

<style scoped>
    .spinner-enter-active, .spinner-leave-active {
        transition: opacity .3s;
    }
    .spinner-enter, .spinner-leave-to {
        opacity: 0;
    }
    body {
        font-family: sans-serif;
        font-size: 13px;
        background-color: #000;
        margin: 0px;
        overflow: hidden;
    }
    a.navbar-brand {
        position: fixed;
        bottom: 0;
        right: 20px;
    }
    body {
        display: grid;
        place-content: center;
        margin: 0;
        min-height: 100vh;
    }

    .loader {
        position: fixed;
        display: grid;
        grid-template: 15em/ 15em;
        animation: r 3s linear infinite;
        top: calc(50% - 100px);
        left: calc(50% - 100px);
        opacity: 1;
        transition: .3s;
        z-index: 99999999;
    }
    .loader:before, .loader:after {
        --i: 0;
        grid-column: 1;
        grid-row: 1;
        border-radius: 50%;
        transform: rotate(calc(var(--i)*180deg));
        background: radial-gradient(circle at 50% 1.5em, #9b305c calc(1.5em - 1px), rgba(0, 0, 0, 0) 1.5em), conic-gradient(#9b305c 14.47751deg, #663996 180deg);
        --mask: radial-gradient(circle at 50% 9em, rgba(0, 0, 0, 0) 6em, #ff0000 calc(6em + 1px));
        -webkit-mask: var(--mask);
        mask: var(--mask);
        content: "";
    }
    .loader:after {
        --i: 1;
    }
    #counter {
        position: fixed;
        top: 50%;
        left: 50%;
        font-size: 50px;
        transform: translate(-50%, -50%);
        margin: 0;
        color: #973161;
    }

    @keyframes r {
        0% {
            transform: rotate(4turn);
        }
    }

    .main-container{
      display: flex;
    }
</style>
