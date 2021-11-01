<template>
    <multiselect v-model="products" :options="options" label="value" track-by="id" :multiple="multiple">
        <slot></slot>
        <template slot="noOptions" slot-scope="props">Список пуст</template>
    </multiselect>
</template>

<script>
import Multiselect from "vue-multiselect";
export default {
	props: {
	    "value": [Array, Number],
        "options": [Array],
        "multiple": {
	        type: Boolean,
            default: true,
	    }
    },
	data() {
		return {
            products: [],
		};
	},
	methods: {
		submit() {
            if (this.multiple){
                let ids = this.products.map(value => value.id);
                if (!this.value || ids.join( ',' ) != this.value.join( ',' )){
                    this.$emit("input", ids);
                }
            } else {
                if (this.value != this.products[0].id){
                    this.$emit("input", this.products[0].id);
                }
            }
		},
        valueToArray(){
		    // debugger;
            if (this.multiple){
                if (typeof this.value != "object"){
                    console.error("An array was expected");
                }
            }

            if (this.multiple){
                this.products = this.options.filter((el) =>{
                    return this.value.indexOf(el.id) > -1;
                });
            } else {
                this.products = this.options.find((el) =>{
                    return this.value == el.id;
                });
            }
        }
	},
    computed: {
    },
	components: {
		Multiselect,
	},
	watch: {
        products() {
            this.submit();
		},
        value() {
            this.valueToArray();
		},
	},
    mounted() {
        this.valueToArray();
    }
};
</script>