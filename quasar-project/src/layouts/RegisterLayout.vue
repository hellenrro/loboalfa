<template>
  <q-layout>
    <div class="centered-image q-pt-md">
      <q-img src="../statics/logo.png" width="200px"/>
    </div>
    <div class="menu q-mt-sm">
      <a href="#">Home</a>
      <router-link :to="{ name: 'pets.index' }">Animais</router-link>
      <a href="#">Contato</a>
      <a href="#">Cadastro</a>
    </div>

    <!-- Se desejar centralizar a imagem verticalmente, você pode usar flexbox na div .centered-image -->
    <!-- <div class="centered-image flex-center-v"> -->

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<style>
.centered-image {
  display: flex;
  justify-content: center;
  align-items: center;
}
.menu {
  width: 100%;
  background-color: darkblue;
  border-top: 6px solid orange;
  border-bottom: 6px solid orange;
  text-align: center;
  padding: 20px;
}

.menu a {
  color: white;
  text-decoration: none;
  margin: 0 20px;
}
</style>

<script setup lang="ts">

</script>
