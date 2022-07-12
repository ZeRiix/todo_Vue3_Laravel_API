<template>
    <div class="container">
        <h1>Element</h1>
        <form @submit.prevent="search">
            <input class="espace" type="text" placeholder="search task by ID" v-model="id" />
            <button @click="search" class="btn btn-primary">Search</button>
        </form>
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
import { ref } from 'vue'
import axios from 'axios'

    export default {
        name: 'ElementPage',
        components: {
        },
        setup() {
            const id = ref('')
            const final = ref({})
            const search = () => {
                axios({
                    method: 'get',
                    url: 'http://localhost:8000/api/todo/element/'+id.value
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
        color:green;
    }
    p {
        display: inline-block;
        margin: 0 10px; 
    }
</style>