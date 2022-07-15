<template>
  <div class="spacer-100"></div>
  <h1>My todo List</h1>
</template>

<script>

import {useStore} from "vuex";

export default {
  name: 'HomePage',

  setup() {

    const store = useStore()

    const test = store.getters('user/getTokenUser')

    console.log(test)

    return {
      store
    }

  }

}
</script>

<style>
    .spacer-100 {
        height: 100px;
    }
</style>