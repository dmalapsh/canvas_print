<template>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
                <!--                <th>Banned</th>-->
                <!--                <th>Parent Id</th>-->
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items">
                <td>{{item.name}}</td>
                <td>{{item.email}}</td>
                <td>{{item.role}}</td>
                <td>
                    <button class="btn btn-primary btn-sm">
                        <i class="far fa-edit" @click="$store.commit('SetUserModalStatus', item.id)"></i>
                    </button>
                    <button class="btn btn-danger btn-sm">
                        <i class="fas fa-ban"></i>
                    </button>
                    <button @click="modal(item.id)" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>

                </td>
            </tr>
            </tbody>
        </table>
        <b-modal v-model="modalStatus">
            <template slot="modal-title">
                Уверены что хотите удалить?
            </template>
            <template slot="modal-footer" class="row">
                <button class="btn col-6 btn-outline-danger" type="button" @click="deleteItem(temp.id)">Удалить</button>
                <button class="btn col-6 btn-outline-secondary" type="button" @click="modalStatus = false">Отмена</button>
            </template>
        </b-modal>
    </div>
</template>

<script>
    export default {
        computed: {
            modalPicStatus() {
                this.refresh();
                return this.$store.getters.UserModalStatus;
            }
        },
        data() {
            return {
                items: null,
                temp: {},
                modalStatus: false,
            };
        },
        head: {
            title: {
                inner: 'Пользователи',
            },
        },
        methods: {
            modal(id) {
                this.temp = {
                    id: id
                };

                this.modalStatus = true;
            },
            deleteItem(id) {
                var url = route('user.destroy', {user: id});
                this.axios.delete(url).then(response => {
                    this.modalStatus = false;
                    this.refresh();
                });
            },
            submitModal(id) {
                if (this.temp.id) {
                    var url = route('tag.update', {tag: this.temp.id});
                    this.axios.patch(url, this.temp).then(response => {
                        this.modalStatus = false;
                        this.refresh();
                    });
                } else {
                    var url = route('tag.store');
                    this.axios.post(url, this.temp).then(response => {
                        this.modalStatus = false;
                        this.refresh();
                    });
                }
            },
            refresh() {
                var url = route('user.index');
                this.axios.get(url).then(response => {
                    this.items = response.data
                });

            }
        },
        mounted() {
            // this.$store.commit("setBreadcrumbs", { text: "Теги" });
            this.refresh();
        }
    };
</script>

<style scoped>

</style>
