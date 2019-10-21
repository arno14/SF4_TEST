<template>
  <div id="base-index">
    <div class="col-12">
      <span style="font-weight:bold;font-size:1.5em;">Book list</span>
      <span v-if="isLoading">Loading...</span>
      <span v-if="!isLoading">{{ totalCount }} results</span>
    </div>

    <div class="row">
      <div class="col-6">
        <slot name="search" />
        <div>
          <slot name="list" />
        </div>
      </div>
      <div class="col-6">
        <slot name="detail" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseIndex',
  data () {
    return {
      isLoading: false,
      criterias: {
        term: null
      },
      totalCount: null,
      list: []
    }
  },
  methods: {}
}
</script>

<style>
</style>
