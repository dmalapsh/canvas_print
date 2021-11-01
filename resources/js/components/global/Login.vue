<template>
    <div class="wrapper ">
        <div class="form-container">
<!--            <img src="https://3d-mitra.ru/wp-content/uploads/2019/09/3D-Mitra-logoo.png" alt="" style="-->
<!--    width: 100px;-->
<!--">-->
<!--            <h2>Личный кабинет!</h2>-->
<!--            <h3>Клиента 3D MITRA</h3>-->

            <div id="loginform" class="form-group">

                <p class="login-username form-group">
                    <label for="user_login">Логин</label>
                    <input type="text" name="log" id="user_login" class="input form-control" v-model="email" size="20">
                </p>
                <p class="login-password form-group">
                    <label for="user_pass">Пароль</label>
                    <input type="password" name="pwd" id="user_pass" class="input form-control" v-model="password" size="20">
                </p>

                <p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme"
                                                        value="forever" checked="checked"> Запомнить меня</label></p>
                <p class="login-submit">
                    <button @click="submitLogin" id="wp-submit" class="button button-primary btn">Войти</button>
                </p>

            </div>
<!--            <img src="https://3d-mitra.ru/wp-content/uploads/2020/02/MITRA-LOGO-FULL-HORIZONTAL.png" alt="">-->
<!--            <a href="https://3d-mitra.ru" style="-->
<!--                margin: 30px;-->
<!--            ">&lt; Вернуться</a>-->
        </div>


    </div>

</template>

<script>
    export default {
        data() {
            return {
                is_personal: false,
                email: '',
                password: '',
            }
        },
        head: {
            title: {
                inner: 'Авторизация',
            },
        },
        methods: {
            submitLogin() {
                var url = route('auth.login');
                this.axios.post(url, {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.access_token;

                    localStorage.setItem('token', response.data.access_token);

                    var redirect_url = localStorage.getItem("redirect");
                    if (redirect_url) {
                        this.$router.push(redirect_url);
                        localStorage.setItem("redirect", "");
                    } else {
                        this.$router.push({name: 'widgets'})
                    }
                }).catch(error => {
                    this.$noty.info('Не верный логин и/или пароль');
                });
            }
        },

    }
</script>
<style scoped>
    #loginform {
        background: #fff;
        padding: 40px 60px;
        width: 450px;
        border-radius: 10px;
        margin: 40px;
    }
    .person-manage > h6 {
        font-weight: 500;
        font-size: 16px;
        color: #812d54;
    }

    .manage-profil > img {
        border-radius: 50%;
        position: relative;
        top: -15px;
        margin: 11px;
    }

    .manage-profil > p {
        width: 140px;
        display: inline-block;
        margin-top: 10px;
        font-size: 16px;
        font-weight: 500;
        text-align: left;
        color: #403c3c;
    }

    .person-manage > i {
        display: block;
        font-size: 18px;
        margin: 20px;
        color: #403c3c;
    }

    .person-manage > i:before {
        color: #803256;
    }

    .person-manage > a {
        font-size: 20px;
        margin: 10px;
        color: #73304f;
    }

    .login-remember {
        display: none;
    }

    .login-submit {
        margin-top: 35px;
    }

    a {
        color: #fff;
    }

    .header {
        margin: 0 !important;
    }


    .wrapper {
        background: url('https://3d-mitra.ru/wp-content/uploads/2019/11/Screenshot_2019-09-13-16-00-35-024_com.android.chrome_15-06-48-1.jpg');
        background-size: cover;
        position: absolute;
        background-position: bottom;
    }

    footer {
        display: none;
    }

    form#loginform {
        background: #fff;
        padding: 40px 60px;
        width: 450px;
        border-radius: 10px;
        margin: 40px;
    }

    .form-container {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background: rgba(49, 29, 46, 0.87);
        color: #fff;
        font-weight: bold;
    }

    #wp-submit {
        display: block;
        margin: auto;
        border-radius: 20px;
        background-color: #9b305c;
        padding: 8px 25px;
        color: #fff;
    }

    h3 {
        font-size: 22px;
        text-transform: uppercase;
        margin: 0;
    }

    label {
        color: #9b305c;
        font-weight: 100;
        text-transform: uppercase;
        margin: 0;
    }
</style>

