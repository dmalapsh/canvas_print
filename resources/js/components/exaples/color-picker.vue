<template>
    <div>
        <input @input="submit" v-model="color" type="color">
    </div>
</template>

<script>
    export default {
        name: "color-picker",
        data(){
            return {
                color: null,
                colorGRB: null,
            }
        },
        methods:{
            submit(){
                if (this.colorGRB){
                    axios.get("/color/" + this.colorGRB)
                }
            }
        },
        watch: {
            color() {
                if (!this.color) return;
                var hex = this.color;
                var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                this.colorGRB =  result ? `${parseInt(result[1], 16)},${parseInt(result[2], 16)},${parseInt(result[3], 16)};` : null;
            }
        },
    }
</script>

<style scoped>

</style>