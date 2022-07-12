<template>
  <NavbarVue Home="Home" List="List" Element="Element" Remove="Remove" Modify="Modify" Add="Add" />
  <div class="container espace-v espace-vb">
    <router-view></router-view>
  </div>

  <FooterVue />
</template>

<script>
import NavbarVue from './components/Navbar.vue'
import FooterVue from './components/Footer.vue'

export default {
  name: 'App',
  components: {
    NavbarVue,
    FooterVue,
},
  setup() {

    return {
    }
  },
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.espace-v {
  margin-top: 15em;
  
}

.espace-vb {
  margin-bottom: 15em;
  
}

</style>