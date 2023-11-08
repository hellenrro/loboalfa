<template>
  <div class="row q-pa-xl">
    <div v-if="loading" class="row">
      <q-skeleton class="q-ma-md" height="170px" width="320px" />
      <q-skeleton class="q-ma-md" height="170px" width="320px" />
      <q-skeleton class="q-ma-md" height="170px" width="320px" />
      <q-skeleton class="q-ma-md" height="170px" width="320px" />
      <q-skeleton class="q-ma-md" height="170px" width="320px" />
      <q-skeleton class="q-ma-md" height="170px" width="320px" />
      <q-skeleton class="q-ma-md" height="170px" width="320px" />
      <q-skeleton class="q-ma-md" height="170px" width="320px" />
    </div>
    <div v-else class="col-4 q-pa-md" v-for="(item, index) in data" :key="index">
      <CardGenericList :name="item.name" :description="item.description" :image-src="item.img" />
    </div>
  </div>
</template>

<script lang="ts">
import CardGenericList from 'components/CardGenericList.vue';
import {defineComponent, onBeforeMount, onMounted, ref} from 'vue';
import axios from 'axios';

export default defineComponent({
  components: { CardGenericList },
  name: 'IndexPage',
  setup () {
    const data = ref([]);
    const loading = ref(false);

    onBeforeMount(() => {
      // jogar no env
      loading.value = true;
      axios.get('http://localhost:8989/list').then(response  => {
        loading.value = false;
        data.value = response.data.data;
      });
    });

    return {
      data,
      loading
    };
  }
});
</script>
