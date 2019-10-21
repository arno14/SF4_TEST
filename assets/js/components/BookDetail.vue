<template>
  <b-card
    id="book-detail"
    :title="book.title"
  >
    <div>#{{ book.id }}</div>
    <div>
      Author:
      <strong v-text="book.authorDetail.firstName" />
      <strong v-text="book.authorDetail.lastName" />
      #{{ book.authorDetail.id }}
    </div>
    <div>
      published at
      <strong>{{ book.publicationDate | formatDate('DD/MM/Y') }}</strong>
    </div>
    <div>
      ISBN:
      <strong v-text="book.ISBN" />
    </div>
    <div>
      Categories:
      <b-badge
        v-for="(cat,catKey) in book.categories"
        :key="catKey"
        pill
        variant="info"
        :title="cat.id"
        v-text="cat.name"
      />
    </div>
    <!-- <pre v-text="JSON.stringify(book, null, '\t')" /> -->
  </b-card>
</template>

<script>

export default {
  name: 'BookDetail',
  props: {
    book: {
      type: Object,
      default: null
    }
  },
  data () {
    return {}
  },
  mounted () {},
  methods: {}
}
</script>

<style>
#app {
  /* background#2b81af; */
  background: red;
}
</style>
