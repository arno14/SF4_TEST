<template>
    
    <div id="app">
        <div class="col6">
            <!--<div>Hello world</div>-->
            <form v-on:submit.prevent="loadItems()" class="form form-inline" >
                <div class="input-group">
                    <input v-model="criterias.title" type="text" class="form-control"/>
                    <div class="input-group-append">
                       <button class="btn btn-outline-secondary" type="submit" >Search</button>
                     </div>
                </div>
            </form>
            <div>
                <div>{{totalCount}} results</div>
                <ul>
                    <li v-for="item in list">
                        <span v-text="item.title"></span>
                        <!--by <span v-text="item.author.firstName"></span><span v-text="item.author.lastName"></span>-->
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
</template>

<script>

    import axios from 'axios';

    export default {
        name: 'app',
        data() {
            return {
                criterias: {
                    title: null
                },
                totalCount: null,
                list: []
            }
        },
        mounted() {
            this.loadItems();
        },
        methods: {
            loadItems() {
                this.totalCount=0;
                this.list = [];
                let params = this.criterias;
                axios.get('/api/books', { params: params})
                        .then(response => {
                            this.totalCount = response.data["hydra:totalItems"],
                            this.list = response.data["hydra:member"]
                });
            }
        }
    }
    
</script>

<style>
    
    #app {
        background:#2b81af;
        /*background: red;*/
    }
    
</style>