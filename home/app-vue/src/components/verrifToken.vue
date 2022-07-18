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