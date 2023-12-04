<template>
  <div class="body-area">
    <div class="row">

    </div>
    <!-- <div v-else class="col-4 q-pa-md" v-for="(item, index) in data" :key="index">
      <CardGenericList :name="item.name" :description="item.description" :image-src="item.imgs" />
    </div> -->
    <div class="cards-area">
      <CardGenericList :name="'item.name'" :description="'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id ratione sequi assumenda possimus. Cupiditate mollitia ullam asperiores! Nesciunt optio quisquam, impedit reiciendis delectus unde, voluptas, aperiam sint id magni suscipit!'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      <CardGenericList :name="'item.name'" :description="'item.description'" :image-src="''" />
      </div>
    <div class="sider-area">

    </div>
  </div>
</template>

<script lang="ts">
import CardGenericList from 'components/CardGenericList.vue';
import {defineComponent, onBeforeMount, ref} from 'vue';
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

<style>
.body-area {
  margin: 0 100px;
  display: flex;
  flex: 1;
  flex-direction: row;
}

.cards-area {
  display: flex;
  flex-wrap: wrap;
  height: 500px;
  width: 70%;
  overflow: auto;
  margin-right: 10px;
}

.sider-area {
  background-color: #00008b;
  border-top: 6px solid #ffa500;
  border-bottom: 6px solid #ffa500;
  width: 30%;
}
</style>
