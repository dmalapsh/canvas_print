<template>
    <b-modal v-model="modalPicStatus" title="Пользователь" size="lg">
        <div class="tab-pane active" id="project_info" style="width: calc(100% - 20px);">

<!--            <b-button-->
<!--                    variant="primary"-->
<!--                    size="md"-->
<!--                    class="float-right"-->
<!--                    @click="toggleShow"-->
<!--            >-->
<!--                Загрузить аватар-->
<!--            </b-button>-->
            <div class="form-group">
                <label class="form-label">ФИО:</label>
                <input type="text" class="form-control" v-model="userData.name">
            </div>
            <div class="form-group">
                <label class="form-label">E-mail:</label>
                <input type="text" class="form-control"
                       v-model="userData.email">
            </div>
            <div class="form-group">
                <label class="form-label">Пароль:</label>
                <input type="text" class="form-control" value="пароль" disabled v-if="!id">
                <input v-else type="password" class="form-control" v-model="userData.password">
            </div>
            <div class="form-group" v-if="role == 'admin'">
                <label class="form-label">Роль:</label>
                <select name="image_quality" class="form-control" v-model="userData.role">
                    <option value="manager">Менеджер</option>
                    <option value="admin">Администратор</option>
                </select>
            </div>
        </div>
        <template v-slot:modal-footer>
            <b-button
                variant="primary"
                size="sm"
                class="float-right"
                @click="submitModal"
            >
                Сохранить
            </b-button>
        </template>

<!--        <cropUpload-->
<!--                @crop-upload-success="cropUploadSuccess"-->
<!--                v-model="show"-->
<!--                :width="100"-->
<!--                :height="100"-->
<!--                langType="ru"-->
<!--                field="file"-->
<!--                :noSquare="true"-->
<!--                :url="loaderSet.url"-->
<!--                :headers="loaderSet.headers"-->
<!--                :params="loaderSet.params"-->
<!--                img-format="jpg">-->
<!--        </cropUpload>-->
    </b-modal>
</template>

<script>
    import cropUpload from 'vue-image-crop-upload';
    export default {
        components: {
            cropUpload
        },
        name: "userModal",
        data() {
            return {
                users: [],
                id: null,
                userData: {},
                show: false,
                // loaderSet: {
                //     url: route('file.upload')+'',
                //     params: {
                //         fileable_type: 'user',
                //         is_json: true
                //     },
                //     headers: {Authorization: 'Bearer ' + localStorage.getItem('token')},
                // }
            }
        },
        watch: {
          id(){
              this.refresh();
          }
        },
        computed: {
            role(){
              return this.$store.getters.getRole;
            },
            modalPicStatus: {
                get() {
                    let temp = this.$store.getters.UserModalStatus;
                    if (typeof temp == "number"){
                        this.id = temp;
                        return true
                    }else{
                        this.id = null;
                        return temp;
                    }

                },
                set() {
                    this.$store.commit('SetUserModalStatus');
                }
            },

        },
        // mounted() {
        //     var url = route('user.index',{ for: 'project'});
        //     this.axios.get(url).then(response => {
        //         this.users = response.data
        //     });
        // },
        methods: {
            toggleShow() {
                this.show = !this.show;
            },
            cropUploadSuccess(url){
                this.userData.img_url = url;
                this.show = false;
                this.$noty.info("Успешно загружено");
            },
            refresh(){
                if ( this.id){
                    let url = route('user.show',{user: this.id});
                    this.axios.get(url).then(response => {

                        this.userData = response.data;

                    });
                }else {
                    this.userData = {}
                    };
                },


            submitModal() {
                if (this.id){
                    let url = route('user.update', {user: this.id});
                    this.axios.patch(url, this.userData).then(response => {
                        this.$store.commit('SetUserModalStatus', false);
                        // this.projectData = defaultData;
                    });
                }else {
                    let url = route('user.store');
                    this.axios.post(url, this.userData).then(response => {
                        this.$store.commit('SetUserModalStatus', false);
                        // this.projectData = defaultData;
                    });
                }


            },
            },
    }
</script>

<style scoped>

</style>
