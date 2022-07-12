<template>
    <div class="grey shadow p-3 mb-5 bg-body rounded size-box">
        <h1 class="display-3">Add Task</h1>
        <form @submit.prevent="add" class="center2">
            <div class="form-group">
                <label for="exampleFormControlInput1">Task</label>
                <input class="form-control espace size-input-text center" type="text" placeholder="Name of Task" v-model="newItem" />
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Content</label>
                <textarea class=" espace form-control" id="exampleFormControlTextarea1" 
                type="text" placeholder="Content..." v-model="newContent" rows="6" cols="45"></textarea>
            </div>
            <button class="btn btn-success">Add </button>
        </form>    
    </div>
    <h3>{{ final }}</h3>
</template>

<script> 
import { ref } from 'vue'
import axios from 'axios'

    export default {
        name: 'AddPage',
        setup() {
            const newItem = ref("")
            const newContent = ref("")
            const final = ref('')
            const add = () => {
                console.log(newContent.value)
                axios({
                    method: 'post',
                    url: 'http://localhost:8000/api/todo/add',
                    data: {
                        name: newItem.value,
                        content: newContent.value
                    }
                }).then(res => {
                    console.log(res.error)
                    final.value = 'OK'
                })
            }
            return {
                newItem,
                add,
                final,
                newContent
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

        .grey {
            background-color: #d1d1d2 !important;
        }
        .size-box {
            width: 40%;
            margin: auto;
        }

        .size-input-text {
            width: 100%;
            
        }

        .center {
            display:block !important; 
            margin-right: 11.5em;

        }
    </style>