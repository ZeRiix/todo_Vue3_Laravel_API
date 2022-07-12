<template>
  <div class="fixed-top bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <!-- Navbar brand -->
      <div class="navbar-brand"><router-link to="/Home" class="nav-link active" id="txt-logo"><img id="MDB-logo"
              src="https://th.bing.com/th/id/R.f4bad5b3a0d8811f9bcef118aba6b8f8?rik=kQa6f1AiaLQzNA&pid=ImgRaw&r=0" alt="MDB Logo"
              draggable="false" height="50" />TODO</router-link></div>

      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
          data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left links -->
          <ul class="navbar-nav me-3">
              <li class="nav-item">
                  <router-link to="/list" class="nav-link active d-flex align-items-center" aria-current="page"><i
                          class="fas fa-bars pe-2"></i>{{ List }}</router-link>
              </li>
          </ul>
          <!-- Left links -->

          <form class="d-flex align-items-center w-100 form-search" @submit.prevent="search">
              
              <div class="input-group">
                  <button class="btn btn-light dropdown-toggle shadow-0" type="button" data-mdb-toggle="dropdown"
                      aria-expanded="false" style="padding-bottom: 0.4rem;">
                      Name
                  </button>
                  <ul class="dropdown-menu dropdown-menu-dark fa-ul">
                    <li>
                      <button class="dropdown-item" ><span class="fa-li pe-2"><i
                                  class="fas fa-user-friends"></i></span>Name</button>
                      </li>
                      <li>
                          <button class="dropdown-item"><span class="fa-li pe-2"><i
                                      class="fas fa-key"></i></span>{{ Element }}</Button>
                      </li>
                  </ul>
                  <input type="search" class="form-control" placeholder="Search" aria-label="Search" />
              </div>
              
              <div class="text-white"><i class="fas fa-search ps-3"></i></div>
          </form>

          <ul class="navbar-nav ms-3">
              <li class="nav-item me-3">
                  <router-link to="/Add" class="nav-link d-flex align-items-center">{{ Add }}</router-link>
              </li>
              <li class="nav-item">
                  <router-link to="/Modify" class="nav-link d-flex align-items-center">{{ Modify }}</router-link>
              </li>
              <li class="nav-item" style="width: 90px;">
                <router-link to="/Remove" class="nav-link d-flex align-items-center">{{ Remove }}</router-link>
              </li>
          </ul>
        </div>
    </nav>
    <!-- Navbar -->
  </div>
</template>

<script>

import { useStore } from 'vuex'
import {ref} from 'vue';

export default {
  name: 'NavBar',
  setup() {
    const store = useStore()
    console.log(store)
    const name = ref("")
    return {
      name
    }
  }
  ,
  props: {
    Home: String,
    List: String,
    Element: String,
    Remove: String,
    Modify: String,
    Add: String,
  },
  methods: {
    submit() {
      this.$emit('submit')
    }
  }
}

</script>

<style scoped>
    .img {
    width: 4em;
    height: 4em;
    border-left: 2em;
    margin-left: 2em;
    }

  #navbar {
    margin-bottom: 3em;
  }
  .navbar-dark .nav-item .nav-link {
    color: #fff;
  }

  .navbar-dark .nav-item .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    border-radius: 0.25rem;
    color: #fff;
  }
  .nav-item{
    margin-right: 1em;
    
  }

  .fa-li {
    position: relative;
    left: 0;
  }

  #MDB-logo {
    margin-bottom: 1em;
    margin-left: 1em;
  }
  #txt-logo {
    margin-top: 0.35em;
  }

  .text-white {
    margin-left: 0.5em;
    margin-right: 1.5em;
  }

  .navbar {
    margin-left: 15em;
    margin-right: 15em;
  }
</style>