<template>
  <q-layout class="layout">
    <div class="centered-image q-pt-md">
<!--      '../../../back/app-laravel/storage/app/public/pets/1699122368.png-->
<!--      ../../../back/app-laravel/storage/app/public/pets/1699121483.png-->
<!--      // ../statics/logo.png-->
      <q-img src="../statics/logo.png" width="200px"/>
    </div>
    <div class="menu">
      <div class="a-area"><router-link class="a" :to="{ name: 'institutional.index' }">Institucional</router-link></div>
      <div class="a-area"><router-link class="a" :to="{ name: 'pets.index' }">Animais</router-link></div>
      <div class="a-area"><a class="a" href="#">Contato</a></div>
    </div>

    <!-- Se desejar centralizar a imagem verticalmente, você pode usar flexbox na div .centered-image -->
    <!-- <div class="centered-image flex-center-v"> -->

    <router-view />

    <q-footer class="footer">
      <q-toolbar>
        <q-toolbar-title>O Lobo Alfa 2023</q-toolbar-title>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<style scoped>
.centered-image {
  display: flex;
  justify-content: center;
  align-items: center;
}

.menu {
  margin: 0.938em 6.25em 0 6.25em;
  background-color: #00008b;
  border-top: 0.375em solid #ffa500;
  border-bottom: 0.375em solid #ffa500;
  display: flex;
  align-items: center;
  justify-content: space-around;
  height: 4.5em;
}

.a-area {
  display: flex;
  align-items: center;
  height: 85%;
}
.a {
  color: white;
  text-decoration: none;
  font-size: 1.125em;
  font-weight: bold;
  margin: 0 0.75em;
}

.footer {
  background: url(../assets/bgfooter.jpg) repeat-x;
  height: 10em;
  width: 100%;
  text-align: center;
  color: #999999;
  font-size: 0.875em;
  font-weight: normal;
  position: fixed;
  bottom: 0;
}
</style>

<script setup lang="ts">
</script>
