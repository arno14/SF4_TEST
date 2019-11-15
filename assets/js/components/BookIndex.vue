<template>
  <div id="book-index" class="row">
    <div class="col-12">
      <span style="font-weight:bold;font-size:1.5em;">Book list</span>
      <span v-if="isLoading">Loading...</span>
      <span v-if="!isLoading">{{ totalCount }} results</span>
    </div>
    <div class="col-6">
      <b-form inline class="form-search" @submit.prevent="applySearch()">
        <b-input-group class="b-flex title-search">
          <b-form-input v-model="criterias.title" placeholder="Search term" />
          <b-input-group-append>
            <!-- <b-button submit >G</b-button> -->
          </b-input-group-append>
        </b-input-group>
      </b-form>
      <div>
        <b-list-group>
          <b-list-group-item v-for="(item,itemkey) in list" :key="itemkey">
            <router-link :to="{name:'book_detail', params:{book_id:item.id}}" replace>
              <span v-text="item.title" />
            </router-link>
          </b-list-group-item>
        </b-list-group>
      </div>
    </div>
    <div v-if="focusedBook" class="col-6">
      <BookDetail :book="focusedBook" />
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import BookDetail from './BookDetail.vue';

export default {
  name: 'BookIndex',
  components: { BookDetail },
  data() {
    return {
      isLoading: false,
      criterias: {
        title: null,
      },
      totalCount: null,
      list: [],
      focusedBook: null,
    };
  },
  watch: {
    $route(to, from) {
      if (JSON.stringify(to.query) !== JSON.stringify(from.query)) {
        this.loadItems();
      }
      if (to.params.book_id && to.params.book_id !== from.params.book_id) {
        this.showBook(to.params.book_id);
      }
    },
  },
  mounted() {
    this.criterias = Object.assign({}, this.$route.query)  || { title: null };
    this.loadItems();
    if (this.$route.params.book_id) {
      this.showBook(this.$route.params.book_id);
    }
  },
  methods: {
    applySearch() {
      //NB ne jamais utilisé l'objet query directement, tjrs faire une copie 
      // sinon erreur "NavigationDuplicated Navigating to current location (“/search”) is not allowed [vuejs]
      let query = Object.assign({}, this.criterias);
      this.$router.replace({ query });
    },
    loadItems() {
      this.isLoading = true;
      this.totalCount = 0;
      this.list = [];
      axios
        .get('/api/books', { params: this.criterias })
        .then((response) => {
          this.totalCount = response.data['hydra:totalItems'];
          this.list = response.data['hydra:member'];
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    showBook(bookId) {
      this.isLoading = true;
      let book = null;
      axios
        .get(`/api/books/${bookId}`)
        .then((response) => {
          book = response.data;
          return axios.get(book.author);
        })
        .then((response) => {
          book.authorDetail = response.data;
          this.focusedBook = book;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>

<style >
#app {
  /* background#2b81af; */
  background: gainsboro;
}
.form-search,
.title-search {
  width: 100% !important;
}
</style>
