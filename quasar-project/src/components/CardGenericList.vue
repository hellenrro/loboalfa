<template>
  <div class="card-generic">
    <div>
      <q-carousel swipeable animated v-model="slide" ref="carousel" infinite height="8.125em">
        <q-carousel-slide v-for="(url, index) in imagesSrc" :key="index" :name="index"
          :img-src="`http://localhost:8989/storage/pets/${url}`" />
        <q-carousel-slide :name="0" img-src="../statics/Cachorro-Png.webp" />
        <q-carousel-slide :name="1" img-src="../statics/Cachorro-Pequeno-Png.webp" />
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
      <span><span class="bold">Cor</span>: {{ cor }}</span>
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
};
</script>

<style scoped>
.card-generic {
  height: 22em;
  width: 18.75em;
  min-height: 22em;
  min-width: 18.75em;
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
