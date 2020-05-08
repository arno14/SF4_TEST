<template>
  <div id="book-index" class="row">
    <div class="col-12">
      <span style="font-weight: bold; font-size: 1.5em;">Book list</span>
      <span>{{ totalCount }} results</span>
      <span v-if="countLoading" class="float-right"
        ><b-icon icon="arrow-clockwise" animation="spin" font-scale="1" />
        {{ countLoading }} loading...
      </span>
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
          <b-list-group-item v-for="(item, itemkey) in list" :key="itemkey">
            <router-link
              :to="{ name: 'book_detail', params: { book_id: item.id } }"
              replace
            >
              <span v-text="item.title" />
            </router-link>
          </b-list-group-item>
        </b-list-group>
      </div>
    </div>
    <div v-if="focusedBook" class="col-6">
      <BookDetail :book="focusedBook" @saveBook="saveBook" />
    </div>
  </div>
</template>

<script>
import http from '../http';
import BookDetail from './BookDetail.vue';

export default {
  name: 'BookIndex',
  components: { BookDetail },
  data() {
    return {
      countLoading: 0,
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
        this.loadBooks();
      }
      if (to.params.book_id && to.params.book_id !== from.params.book_id) {
        this.showBook(to.params.book_id);
      }
    },
  },
  mounted() {
    http.onCountLoadingChange((countLoading) => {
      this.countLoading = countLoading;
    });
    this.criterias = { ...this.$route.query } || { title: null };
    this.loadBooks();
    if (this.$route.params.book_id) {
      this.showBook(this.$route.params.book_id);
    }
  },
  methods: {
    applySearch() {
      // NB ne jamais utiliser l'objet query directement,
      // tjrs faire une copie  sinon erreur
      // "NavigationDuplicated Navigating to current location (“/search”) is not allowed [vuejs]
      const query = { ...this.criterias };
      this.$router.replace({ query });
    },
    loadBooks() {
      this.totalCount = 0;
      this.list = [];

      const queryParameters = this.criterias;
      queryParameters.includes = 'book_author,author';
      http.getList('/api/books', queryParameters).then((resp) => {
        this.totalCount = resp.totalItems;
        this.list = resp.member;
      });
    },
    showBook(bookId) {
      let uri = null;
      if (!bookId) {
        throw new Error('no book id');
      }
      if (bookId['@id']) {
        uri = bookId['@id'];
      } else {
        uri = `/api/books/${bookId}`;
      }
      return http.get(uri).then((book) => {
        this.focusedBook = book;
        return book;
      });
    },
    saveBook(book) {
      http.save(book).then((savedBook) => {
        const index = this.list.findIndex((o) => o['@id'] === savedBook['@id']);
        this.list[index] = savedBook;
        this.showBook(savedBook.id);
      });
    },
  },
};
</script>

<style lang="scss">
#book-index {
  .form-search .title-search {
    width: 100% !important;
  }
}
</style>
