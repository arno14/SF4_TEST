<template>
  <div id="app">
      <div class="input-group">
          <input type="text" v-model="msg" class="form-control"/>
          <span class="input-group-append">
              &nbsp; &nbsp; &nbsp; 
              <span v-text="msg"></span>    
              &nbsp; &nbsp; &nbsp;   
          </span>
      </div>
    
  </div>
</template>

<script>
export default {
  name: 'app',
    data () {
    return {
      msg: 'Hello world'
    }
  }
}
</script>

<style>
#app {
  background:#2b81af;
}
</style>