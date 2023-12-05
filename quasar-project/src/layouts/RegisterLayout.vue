<template>
  <q-layout class="layout">
    <div class="centered-image q-pt-md">
<!--      '../../../back/app-laravel/storage/app/public/pets/1699122368.png-->
<!--      ../../../back/app-laravel/storage/app/public/pets/1699121483.png-->
<!--      // ../statics/logo.png-->
      <q-img src="../statics/logo.png" width="200px"/>
    </div>
    <div class="menu q-mt-sm">
      <a class="a" href="#">Home</a>
      <router-link class="a" :to="{ name: 'pets.index' }">Animais</router-link>
      <a class="a" href="#">Contato</a>
      <router-link  class="a" :to="{ name: 'register.index' }">Cadastro</router-link>
    </div>

    <!-- Se desejar centralizar a imagem verticalmente, você pode usar flexbox na div .centered-image -->
    <!-- <div class="centered-image flex-center-v"> -->

    <router-view />

    <q-footer class="footer">
      <q-toolbar>
        <q-toolbar-title>O Lobo Alfa</q-toolbar-title>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script>
</script>

<style scoped>
.layout {
  height: inherit;
  width: inherit;
}

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
  text-align: center;
  padding: 1.25em;
}

.a {
  height: 100%;
  color: white;
  text-decoration: none;
  margin: 0em 3.75em;
  font-size: 1.125em;
  font-weight: bold;
  display: inline-block;
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
