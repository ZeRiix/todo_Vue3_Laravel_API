<template>
    <div class="container" style="margin-top: -5em;">
    <h1 class="display-3" style="margin-bottom: 0.5em;">TODO List</h1>
    <TodoList v-for="todo in ListTodo" :key="todo.id" :title="todo.name" :content="todo.content"></TodoList>
  </div>
</template>

<script>
import {ref} from 'vue'
import TodoList from '../components/TodoList.vue'
import axios from 'axios'

export default {
  name: 'ListPage',
  components: {
    TodoList,
  },
  setup() {
    const ListTodo = ref([]);
    axios({
      method: 'get',
      url: 'http://localhost:8000/api/todo/list'
    }).then(res => {
      ListTodo.value = res.data
    })
    return {
      ListTodo,
    }
  }
}

</script>