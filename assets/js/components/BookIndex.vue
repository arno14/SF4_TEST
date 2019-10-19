<template>
  <div
    id="book-index"
    class="row"
  >
    <div class="col-12">
      <span style="font-weight:bold;font-size:1.5em;">Book list</span>
      <span v-if="isLoading">Loading...</span>
      <span v-if="!isLoading">{{ totalCount }} results</span>
    </div>
    <div class="col-6">
      <b-form
        inline
        class="form-search"
        @submit.prevent="loadItems()"
      >
        <b-input-group class="b-flex title-search">
          <b-form-input
            v-model="criterias.title"
            placeholder="Search term"
          />
          <b-input-group-append>
            <!-- <b-button submit >G</b-button> -->
          </b-input-group-append>
        </b-input-group>
      </b-form>
      <div>
        <b-list-group>
          <b-list-group-item
            v-for="(item,itemkey) in list"
            :key="itemkey"
            @click="focusBook(item)"
          >
            <span v-text="item.title" />
          </b-list-group-item>
        </b-list-group>
      </div>
    </div>
    <div
      v-if="focusedBook"
      class="col-6"
    >
      <BookDetail :book="focusedBook" />
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import BookDetail from './BookDetail'

export default {
  name: 'BookIndex',
  components: { BookDetail },
  data () {
    return {
      isLoading: false,
      criterias: {
        title: null
      },
      totalCount: null,
      list: [],
      focusedBook: null
    }
  },
  mounted () {
    this.loadItems()
  },
  methods: {
    loadItems () {
      this.isLoading = true
      this.totalCount = 0
      this.list = []
      axios.get('/api/books', { params: this.criterias }).then(response => {
        this.totalCount = response.data['hydra:totalItems']
        this.list = response.data['hydra:member']
        this.isLoading = false
      })
    },
    focusBook (book) {
      this.isLoading = true
      axios.get(book.author).then(response => {
        book.authorDetail = response.data
        this.focusedBook = book
        this.isLoading = false
      })
    }
  }
}
</script>

<style >
#app {
  /* background#2b81af; */
  background: gainsboro;
}
.form-search,
.title-search{
  width: 100%!important;
}
</style>
