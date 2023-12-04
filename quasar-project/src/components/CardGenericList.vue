<template>
  <div class="card-generic">
    <div>
      <q-carousel
      swipeable
      animated
      v-model="slide"
      ref="carousel"
      infinite
      height="130px"
      style="border-radius: 35px 35px 0 0;"
    >
      <!-- <div v-for="(url, index) in urls.value" :key="index">
        <q-carousel-slide :name="index" :img-src="url" />
      </div> -->
      <q-carousel-slide :name="0" img-src="../statics/Cachorro-Png.webp" />
      <q-carousel-slide :name="1" img-src="../statics/Cachorro-Pequeno-Png.webp" />
    </q-carousel>
    </div>
    <div class="name">
      <q-btn
        class="btn-arrow"
        flat icon="arrow_left"
        @click="$refs.carousel.previous()"
      />
      {{ name }}
      <q-btn
        class="btn-arrow"
        flat icon="arrow_right"
        @click="$refs.carousel.next()"
      />
    </div>

    <div>
      <span>Idade: 2 anos</span>
    </div>

    <div>
      <span>Porte: médio</span>
    </div>

    <div class="description">
      {{ description.length > 165 ? description.substr(0, 165).concat('...') : description }}
      <q-tooltip anchor="top end" self="top middle" max-width="300px">
        <div class="description">
          {{ description }}
        </div>
      </q-tooltip>
    </div>
  </div>
</template>

<script>
import {computed, ref} from 'vue';

export default {
  props: {
    imageSrc: Array(String),
    name: String,
    description: String,
  },
  setup (props) {
    const urls = computed(() => {
      const urlsAux = [];
      props.imageSrc.map(img => {
        urlsAux.push(img);
      });
      return urlsAux;
    });

    return {
      urls,
      slide: ref(0),
    };
  }
};
</script>

<style scoped>
.card-generic {
  height: 370px;
  padding: 20px;
  margin: 15px;
  width: 300px;
  background-color: #fff;
  border-radius: 50px;
  box-shadow:  5px 5px 5px #bebebe,
             -5px -5px 5px #ffffff;
}
.name {
  font-size: 18px;
  font-weight: bold;
  margin: 10px 0;
  text-align: center;
}
.description {
  margin: 10px 0;
  height: fit-content;
  word-break: break-all;
}

.btn-arrow {
  border-radius: 50px;
}
</style>
