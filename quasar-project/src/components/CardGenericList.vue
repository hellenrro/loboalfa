<template>
  <div class="card-generic q-pa-md" style="background-color: #d3d3d3">
    <div>
      <q-img :src="url" width="80px" class="card-image" alt="Descrição da imagem"/>
    </div>
    <div class="name">{{ name }}</div>
    <div class="description">{{ description }}</div>
  </div>
</template>

<script>
import {computed, onBeforeMount, ref} from "vue";

export default {
  props: {
    imageSrc: String,
    name: String,
    description: String,
  },
  setup (props) {
    const url = computed(() => {
      return `http://localhost:8989/storage/pets/${props.imageSrc}`
    })

    return {
      url
    };
  }
};
</script>

<style scoped>
.card-generic {
  text-align: center;
  padding: 20px;
  border-radius: 5px;
}

.card-image {
  padding: 10px;
  max-width: 100%;
  height: auto;
}

.name {
  font-weight: bold;
  margin: 10px 0;
}

.description {
  margin: 10px 0;
}
</style>
