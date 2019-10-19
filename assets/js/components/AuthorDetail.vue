<template>
  <div class="col-6">
    @todo
    {{ JSON.stringify(author) }}
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'AuthorDetail',
  props: ['author'],
  data () {
    return {
    }
  },
  mounted () {
  },
  methods: {

  }
}
</script>

<style>
</style>
