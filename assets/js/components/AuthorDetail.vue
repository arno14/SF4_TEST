<template>
  <div class="col-6">
    @todo
    {{ JSON.stringify(author) }}
  </div>
</template>

<script>
export default {
  name: 'AuthorDetail',
  props: {
    author: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {};
  },
  mounted() {},
  methods: {},
};
</script>

<style>
</style>
