<template>
  <div class="grey shadow p-3 mb-5 bg-body rounded size-box">
    <h1 class="display-3">Login Page</h1>
    <form @submit.prevent="login" class="center2">
      <div class="form-group">
        <label for="exampleFormControlInput1">Email</label>
        <input class="form-control espace size-input-text center" type="email" placeholder="email@email.com..." v-model="email" />
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">password</label>
        <input class="form-control espace size-input-text center" type="password" placeholder="********" v-model="password"/>
      </div>
      <button class="btn btn-success">Login</button>
    </form>
  </div>
  <h3>{{ result }}</h3>
</template>

<script>

  import { ref } from 'vue'
  import axios from 'axios'
  import { useStore } from 'vuex'
  import { useRouter } from "vue-router";

  export default {
    name: 'LoginPage',
    setup() {
      const store = useStore()
      const router = useRouter()

      const email = ref("")
      const password = ref("")
      const result = ref('')
      const login = async () => {
        try{
          const response = await axios({
            method: 'post',
            url: 'http://localhost:8000/api/jwt/login',
            data: {
              email: email.value,
              password: password.value
            }
          })

          result.value = response.data[0].token
          console.log(result.value)

        } catch (e) {
          result.value = e.response.data.response
          console.log(result, "error")
        }

        if (result.value) {
          console.log('login success')
          store.commit('user/SET_TOKEN', result.value)
          await router.push('/home')
        }


      }
      return {
        email,
        login,
        result,
        password
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