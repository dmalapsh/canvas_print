<template>
    <div class="container-no-padding">

<!--        <div class="row">-->
<!--            <div class="col-md-5">-->
<!--                <reactive-multiselect v-model="value" :options="options"></reactive-multiselect>-->
<!--            </div>-->
<!--        </div>-->

        <div class="container mb-4 mt-4">
            <div class="card">
                <div class="card-header">
                   <h5>Отчет по звонкам</h5>
                    <div class="card-options">
                        <button class="btn btn-sm btn-success" @click="refresh">
                             Обновить данные
                        </button>
                        <button class="btn btn-sm btn-success" @click="sink">
                             Синхр
                        </button>
                        <button class="btn btn-sm btn-success" @click="addFilter">
                            <i class="fas fa-plus"></i> Добавить фильтр
                        </button>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="(filter, key) in filters">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-1"><span class="badge badge-md badge-pill badge-primary"> {{key+1}} </span></div>
                            <div class="col-3">
                                <select class="custom-select" v-model="filter.column">
                                    <option :disabled="used.includes('date')" value="date">Дата</option>
                                    <option :disabled="used.includes('is_out')" value="is_out">Исходящий ли</option>
                                    <option :disabled="used.includes('called_phone')" value="called_phone">Номер вызываемого</option>
                                    <option :disabled="used.includes('caller_phone')" value="caller_phone">Номер вызывающего</option>
                                    <option :disabled="used.includes('status')" value="status">Статус звонка</option>
                                    <option :disabled="used.includes('duration')" value="duration">Длительность звонка</option>
                                    <option :disabled="used.includes('expectation')" value="expectation">Длительность ожидания</option>
                                </select>
                            </div>
                            <div class="col-1">
                                <select class="custom-select" v-model="filter.operator">
                                    <option v-for="(operator, value) in getOperators(filter)" :value="value" > {{operator}} </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input v-model="filter.value" class="form-control" type="text" placeholder="Значение">
                            </div>
                            <div class="col-1">

                                <button class="btn btn-sm btn-danger" @click="filters.splice(key, 1)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="card-footer text-muted">
                    <input @change="refresh" v-model="query" class="form-control" type="text" placeholder="Маска запроса">
                </div>
            </div>
            <table class="table mt-4 table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Вызывающий</th>
                    <th scope="col">Вызываемый</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Длительность</th>
                    <th scope="col">Ожидание</th>
                    <th scope="col">Дата</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <template v-for="(item, key) in items">
                    <tr :class="{'table-info': item.call_steps.length}">
                        <th scope="row">{{item.raw_call_id}}</th>
                        <td>{{item.caller_phone}}</td>
                        <td>{{item.called_phone}}</td>
                        <td>
                            <span v-if="item.status == 1">Успешно</span>
                            <span v-else>Пропущен</span>
                        </td>
                        <td>{{item.duration}}</td>
                        <td>{{item.expectation}}</td>
                        <td>{{item.date}}</td>
                        <td>
                            <span v-if="item.is_out">Исходящий</span>
                            <span v-else>Входящий</span>
                        </td>
                    </tr>
                    <tr v-if="item.call_steps_show.length">
                        <td colspan="8" class="text-center">
                            <span title="Кто позвонил" class="badge mr-2 badge-secondary">{{item.caller_phone}}</span>
                            <i class="fas fa-arrow-circle-right text-secondary"></i>
                            <span title="Куда позвонил" class="badge mr-2 badge-secondary">{{item.dialed_phone}}</span>
                            <span :class="step.is_show == 2 ? 'border border-primary': ''" v-for="step in item.call_steps_show" @click="openModal(item.call_steps, step.step)">
                                <i class="fas fa-arrow-circle-right hoverable" :class="step.status == 'ANSWERED' ? 'text-success' : 'text-danger'"></i>
                                <span title="Кто позвонил" class="badge mr-2 badge-secondary">
                                    {{step.number}} ({{step.duration}} сек.)
                                </span>
                            </span>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>

        <b-modal v-model="modal" title="Очередь звонка" size="lg">
            <div v-for="item in tempModal"  class="badge mr-2" :class="item.status == 'ANSWERED' ? 'badge-success' : 'badge-secondary'">
                {{item.number}} ({{item.status}})
            </div>
        </b-modal>
    </div>
</template>

<script>
    import ReactiveMultiselect from "./includes/reactive-multiselect";
    export default {
        name: "Report",
        components: {ReactiveMultiselect},
        head: {
            title: {
                inner: 'Отчет',
            },
        },
        data() {
            return {
                modal: false,
                tempModal: [],
                filters: [{operator: "="}],
                items: [],
                query: "",
                value: [1],
                options: [
                    {id: 1, value: 'list'},
                    {id: 2, value: 'of'},
                    {id: 3, value: 'options'}
                ]
            }
        },
        methods: {
            groupBy(xs, key) {
                return xs.reduce(function(rv, x) {
                    (rv[x[key]] = rv[x[key]] || []).push(x);
                    return rv;
                }, {});
            },
            openModal(items, step){
                if (!items.length){
                    return;
                }

                this.modal = true;
                // this.tempModal = this.groupBy(items, "step");
                this.tempModal = items.filter((el) => el.step == step);
            },
            refresh() {
                var url = route('call.index', {items: this.filters, str: this.query});
                this.axios.get(url).then(response => {
                    this.items = response.data
                });

            },
            sink() {
                var url = route('call.sink');
                this.axios.get(url).then(response => {
                    this.refresh();
                });

            },
            addFilter(){
                this.filters.push({operator: "="});
            },
            getOperators(filter){
                let operators = {
                    all: {
                        ">":">",
                        "<":"<",
                        "=":"=",
                        "!=": "≠",
                        // "between": "между"
                    },
                    equality: {
                        "like": "=",
                        "!=": "≠",
                    },
                };
                if (filter.column){
                    switch (filter.column) {
                        case "date":
                            return operators.all;
                        case "is_out":
                            return operators.equality;
                        case "called_phone":
                            return operators.equality;
                        case "caller_phone":
                            return operators.equality;
                        case "status":
                            return operators.equality;
                        case "duration":
                            return operators.all;
                        case "expectation":
                            return operators.all;

                    }
                } else {
                    return [];
                }
            }
        },
        computed: {
            used(){
                return this.filters.map(el => el.column);
            }
        },
        mounted() {
            this.refresh();
        }
    }
</script>

<style scoped>

</style>
