<template>
  <div class="card-generic">
    <div>
      <q-carousel swipeable animated v-model="slide" ref="carousel" infinite height="8.125em">
        <q-carousel-slide :name="1"
          img-src="https://adimax.com.br/wp-content/uploads/2022/05/cuidados-filhote-de-cachorro.jpg" />
        <q-carousel-slide :name="2"
          img-src="https://veterinario.pt/wp-content/uploads/2015/09/cat-pet-animal-domestic-gato800.jpg" />
      </q-carousel>
    </div>
    <div class="name">
      <q-btn class="btn-arrow" flat icon="arrow_left" @click="$refs.carousel.previous()" />
      {{ name }}
      <q-btn class="btn-arrow" flat icon="arrow_right" @click="$refs.carousel.next()" />
    </div>

    <div>
      <span><span class="bold">Idade</span>: {{ age }} anos</span>
    </div>

    <div>
      <span><span class="bold">Porte</span>: {{ size }}</span>
    </div>

    <div>
      <span><span class="bold">Cor</span>: {{ color }}</span>
    </div>

    <div class="description">
      {{ description.length > 30 ? description.substr(0, 30).concat('...') : description }}
      <q-tooltip anchor="top end" self="top middle" max-width="300px">
        <div class="description tooltip">
          {{ description }}
        </div>
      </q-tooltip>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  props: {
    name: String,
    color: String,
    size: String,
    age: Number,
    description: String,
    id: Number,
    imagesSrc: Array(String),
  },
  setup() {
    return {
      slide: ref(1),
    }
  }
};
</script>

<style scoped>
.card-generic {
  height: 22em;
  width: 17.80em;
  min-height: 22em;
  /*min-width: 18.75em;*/
  padding: 1.25em;
  margin: 0.938em;
  background-color: #fff;
  box-shadow: -38px -36px 34px -20px rgba(0, 0, 0, 0.1);
}

.name {
  font-size: 1.125em;
  font-weight: bold;
  margin: 0.625em 0;
  text-align: center;
}

.bold {
  font-size: 1.125em;
  font-weight: bold;
}

.description {
  margin: 0.625em 0;
  height: fit-content;
  word-break: break-all;
}

.tooltip {
  font-size: 14px;
}
</style>
