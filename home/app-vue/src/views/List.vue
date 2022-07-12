<template>
    <div class="container" style="margin-top: -5em;">
    <h1 class="display-3" style="margin-bottom: 0.5em;">TODO List</h1>
    <TodoList @remove="remove" @edit="edit" v-for="todo in ListTodo" :key="todo.id" :title="todo.name" :content="todo.content" :valid="todo.valid"></TodoList>
  </div>
</template>

<script>
import {ref} from 'vue'
import TodoList from '../components/TodoList.vue'
import axios from 'axios'
import { useRouter } from "vue-router";

export default {
  name: 'ListPage',
  components: {
    TodoList,
  },
  setup() {
    const ListTodo = ref([]);
    const router = useRouter()

    function remove(name) {
        axios({
          method: 'post',
          url: 'http://localhost:8000/api/todo/del',
          data: {
            name: name,
          }
        }).then(res => {
          console.log(res)
        })
    }

    function edit(name) {
      router.push("modify/name=" + name)
      console.log(name)
    }

    axios({
      method: 'get',
      url: 'http://localhost:8000/api/todo/list'
    }).then(res => {
      ListTodo.value = res.data
      //console.log(res.data)
    })
    return {
      ListTodo,
      remove,
      edit,
    }
  }
}

</script>