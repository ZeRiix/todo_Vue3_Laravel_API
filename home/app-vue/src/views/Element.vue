<template>
  <div class="container">
    <h1>Element</h1>
    <div class="list">
      <div class="list-item">
        <div class="list-item-title">
          <h2>{{ final.name }}</h2>
        </div>
        <div class="list-item-content">
          <p>{{ final.content }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {ref} from 'vue'
import axios from 'axios'
import {useStore} from 'vuex'

export default {
  name: 'ElementPage',
  components: {},
  setup() {
    const store = useStore()
    const id = ref('')
    const nameE = ref('')

    if (store.getters["todo/getNameElement"] !== '') {
      nameE.value = store.getters["todo/getNameElement"]
      if (nameE.value) {
        axios({
          method: 'get',
          url: 'http://localhost:8000/api/todo/elementName/' + nameE.value
        }).then(res => {
          console.log(res)
          final.value = res.data
        })
      } else {
        console.log('error')
      }
    }
    if (store.getters["todo/getIdElement"] !== null) {
      id.value = store.getters["todo/getIdElement"]
      if (id.value) {
        axios({
          method: 'get',
          url: 'http://localhost:8000/api/todo/element/' + id.value
        }).then(res => {
          console.log(res)
          final.value = res.data
        })
      } else {
        console.log('error')
      }
    }

    const final = ref({})
    const search = () => {
      axios({
        method: 'get',
        url: 'http://localhost:8000/api/todo/element/' + id.value
      }).then(res => {
        console.log(res)
        final.value = res.data
      })
    }
    return {
      id,
      search,
      final,
    }
  }
}
</script>
<style scoped>
h3 {
  color: green;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.espace {
  margin-bottom: 10px;
}

h1 {
  margin: 40px 0 0;
  color: green;
}

p {
  display: inline-block;
  margin: 0 10px;
}
</style>