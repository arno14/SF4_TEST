<template>

    <div id="app" >
        <div class="row">
             <div class="col-6">
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
                    <div v-if="isLoading">Loading...</div>
                    <div v-if="!isLoading">{{totalCount}} results</div>
                    <ul>
                        <li v-for="item in list">
                            <span v-text="item.title" v-on:click="focusBook(item)"></span>
                            <!--by <span v-text="item.author.firstName"></span><span v-text="item.author.lastName"></span>-->
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-6">            
                <div v-if="focusedBook">
                    <h4 v-text="focusedBook.title"></h4>
                    <div>
                        #{{focusedBook.id}}
                    </div>
                    <div>
                        Author: <span v-text="focusedBook.authorDetail.firstName"></span> 
                        <strong v-text="focusedBook.authorDetail.lastName"></strong>
                        #{{focusedBook.authorDetail.id}}
                    </div>
                    <div>
                        published at <span v-text="focusedBook.publicationDate"></span>
                    </div>
                    <div>
                        ISBN: <span v-text="focusedBook.ISBN"></span>
                    </div>
                    <div>
                        Categories: 
                        <span v-for="cat in focusedBook.categories" v-text="cat.name" v-bind:title="cat.id" class="badge">                            
                        </span>
                    </div>
                </div>                
                <pre v-text="JSON.stringify(focusedBook, null, '\t')"></pre>
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
                isLoading:false,
                criterias: {
                    title: null
                },
                totalCount: null,
                list: [],
                focusedBook: null
            }
        },
        mounted() {
            this.loadItems();
        },
        methods: {
            loadItems() {
                this.isLoading=true;
                this.totalCount = 0;
                this.list = [];
                let params = this.criterias;
                axios.get('/api/books', {params: params})
                     .then(response => {
                            this.totalCount = response.data["hydra:totalItems"];
                            this.list = response.data["hydra:member"];
                            this.isLoading=false;
                     });
            },
            focusBook(book) {
                this.isLoading=true;
                axios.get(book.author)
                     .then(response=>{
                            book.authorDetail=response.data;
                            this.focusedBook = book;
                            this.isLoading=false;
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