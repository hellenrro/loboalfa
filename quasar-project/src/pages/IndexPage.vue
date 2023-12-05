<template>
  <div class="page-under-construction">
   <span>Pagina em contrução</span>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'IndexT',
  props: {
  }
});
</script>

<style scoped>
.page-under-construction {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  font-weight: bold;
  height: 30em;
}
</style>
