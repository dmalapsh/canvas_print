<template>
    <div>
        <button @click="sipReload" class="btn btn-sm btn-success">Перезагрузить</button>
    </div>
</template>

<script>
    export default {
        name: "MonitorPage",
        methods: {
            sipReload(){
                axios.post(route("monitor.sipReload"))
            }
        }
    }
</script>

<style scoped>

</style>