<template>
  <div id="author-index">
    <div class="row">
      <div class="col-6">
        <form
          class="form form-inline"
          @submit.prevent="loadItems()"
        >
          <div class="input-group">
            <input
              v-model="criterias.term"
              type="text"
              class="form-control"
            >
            <div class="input-group-append">
              <button
                class="btn btn-outline-secondary"
                type="submit"
              >
                Search
              </button>
            </div>
          </div>
        </form>
        <div>
          <div v-if="isLoading">
            Loading...
          </div>
          <div v-if="!isLoading">
            {{ totalCount }} results
          </div>
          <ul>
            <li
              v-for="(item,itemkey) in list"
              :key="itemkey"
              @click="focusAuthor(item)"
            >
              <span v-text="item.firstName" />
              <span v-text="item.lastName" />
            </li>
          </ul>
        </div>
      </div>
      <div class="col-6">
        <div v-if="focusedAuthor">
          <AuthorDetail :author="focusedAuthor" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import AuthorDetail from './AuthorDetail'

export default {
  name: 'AuthorIndex',
  components: { AuthorDetail },
  data () {
    return {
      isLoading: false,
      criterias: {
        term: null
      },
      totalCount: null,
      list: [],
      focusedAuthor: null
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
      axios.get('/api/authors', { params: this.criterias }).then(response => {
        this.totalCount = response.data['hydra:totalItems']
        this.list = response.data['hydra:member']
        this.isLoading = false
      })
    },
    focusAuthor (author) {
      this.focusedAuthor = author
    }
  }
}
</script>

<style>
</style>
