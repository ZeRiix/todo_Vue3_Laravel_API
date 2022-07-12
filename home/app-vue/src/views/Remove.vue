<template>
    <div class="grey shadow p-3 mb-5 bg-body rounded size-box">
        <h1 class="display-3" style="margin-bottom: 0.25em;">Remove</h1>
        <form @submit.prevent="rm">
            <input class="form-control espace size-input-text center" type="text" placeholder="task to remove" v-model="Item" />
            <button class="btn btn-danger">Remove</button>
        </form>
        <h3>{{ final }}</h3>
    </div>
</template>

<script> 
import { ref } from 'vue'
import axios from 'axios'

    export default {
        name: 'RMPage',
        setup() {
            const Item = ref('')
            const final = ref('')
            const rm = () => {
                axios({
                    method: 'post',
                    url: 'http://localhost:8000/api/todo/del',
                    data: {
                        name: Item.value,
                    }
                }).then(res => {
                    console.log(res)
                    final.value = 'OK'
                })
            }
            return {
                Item,
                rm,
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

        .grey {
            background-color: #d1d1d2 !important;
        }
        .size-box {
            width: 40%;
            margin: auto;
        }

        .size-input-text {
            width: 85%;
            
        }

        .center {
            display:block !important; 
            margin-left: 4em;
            margin-right: 4em;

        }
    </style>