<template>
    <div>
        <div class="page-container">
            <div class="container">
                <table class="table">
                    <tbody>
                    <tr v-for="item in items">
                        <td>{{item.Host}}</td>
                        <td>{{item.Username}}</td>
                        <td>{{item.State}}</td>
                        <td>{{item["Reg.Time"]}}</td>
                    </tr>
                    </tbody>
                </table>
                <button @click="sipReload" class="btn btn-sm btn-success">Перезагрузить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MonitorPage",
        data(){
            return {
                items: []
            }
        },
        methods: {
            sipReload() {
                axios.post(route("monitor.sipReload"))
            }
        },
        mounted() {
            axios.post(route("monitor.showRegistry")).then(e => {
                this.items = e.data;
            })
        }
    }
</script>

<style scoped>

</style>