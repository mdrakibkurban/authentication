<template>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../assets/vue.svg" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link :to="{ name : 'home'}" class="nav-link">Home</router-link>
        </li>

        <li class="nav-item">
          <router-link :to="{ name : 'about'}" class="nav-link">About</router-link>
        </li>

      
        <li class="nav-item">
          <router-link v-if="!loggedIn" :to="{ name : 'login'}" class="nav-link">Login</router-link>
        </li>

        <li class="nav-item">
          <router-link v-if="!loggedIn" :to="{ name : 'register'}" class="nav-link" >Register</router-link>
        </li>
        <li class="nav-item">
          <router-link v-if="loggedIn" class="nav-link" :to="{ name : 'logout'}">Logout</router-link>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>

<script>
export default {
    computed:{
        loggedIn(){
           return this.$store.getters.loggedIn;
        }
    }
}
</script>