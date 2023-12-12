<template>
  <div v-if="loading" class="loading">
    <q-spinner-facebook color="blue-10" size="10em"></q-spinner-facebook>
  </div>
  <div v-else>
    <div class="title-area">
      <div class="filter-area">
        <q-input class="select" filled v-model="modelSelectAge" label="Idade" @blur="onFilterAge">
        </q-input>

        <q-select filled v-model="modelSelectSize" :options="optionsSelectSize" label="Porte/Tamanho" emit-value
          map-options clearable class="select" color="blue-10" @update:modelValue="onFilterSize"
          @clear="onClearFilterSize">
          <template v-slot:option="{ itemProps, opt, selected, toggleOption }">
            <q-item v-bind="itemProps">
              <q-item-section>
                <!-- eslint-disable -->
                <q-item-label v-html="opt.label"></q-item-label>
                <!--eslint-enable-->
              </q-item-section>
              <q-item-section side>
                <q-checkbox :model-value="selected" @update:model-value="toggleOption(opt)"></q-checkbox>
              </q-item-section>
            </q-item>
          </template>
        </q-select>

        <q-input class="select" filled v-model="modelSelectColor" label="Cor" @blur="onFilterAge">
        </q-input>
      </div>
    </div>
    <div class="body-area">
      <div class="cards-area" style="margin-right: 2.45rem">
        <CardGenericList v-for="(item, index) in data" :key="index" :name="item.name" :color="item.color"
          :size="item.size" :age="item.age" :description="item.description" :id="item.id" :images-src="''" />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import CardGenericList from 'components/CardGenericList.vue';
import { Ref, defineComponent, ref } from 'vue';
import axios from 'axios';

export default defineComponent({
  components: { CardGenericList },
  name: 'IndexPage',
  setup() {
    interface Idata {
      name: string,
      color: string,
      size: 'pequeno' | 'médio' | 'grande',
      age: number,
      description: string,
      id: number,
      img: string[],
    }

    const data: Ref<Idata[]> = ref([]);
    const loading = ref(false);

    const getData = async () => {
      loading.value = true;
      const response = await axios.get('http://localhost:8989/list');
      loading.value = false;
      data.value = response.data.data;
    };

    getData();

    const modelSelectAge: Ref<string | number | null | undefined> = ref('');
    const modelSelectSize = ref([]);
    const modelSelectColor: Ref<string | number | null | undefined> = ref('');

    const onFilterAge = () => {
      if (modelSelectAge.value !== '') {
        loading.value = true;
        axios.get(`http://localhost:8989/list?age=${modelSelectAge.value}${modelSelectSize.value !== null ? `&size=${modelSelectSize.value}` : ''}${modelSelectColor.value !== null ? `&color=${modelSelectColor.value}` : ''}`).then(response => {
          loading.value = false;
          data.value = response.data.data;
        });
      }
    };

    const onFilterSize = () => {
      if (modelSelectSize.value !== null) {
        loading.value = true;
        axios.get(`http://localhost:8989/list?size=${modelSelectSize.value}${modelSelectAge.value !== null ? `&age=${modelSelectAge.value}` : ''}${modelSelectColor.value !== null ? `&color=${modelSelectColor.value}` : ''}`).then(response => {
          loading.value = false;
          data.value = response.data.data;
        });
      }
    };

    const onFilterColor = () => {
      if (modelSelectColor.value !== '') {
        loading.value = true;
        axios.get(`http://localhost:8989/list?color=${modelSelectColor.value}${modelSelectSize.value !== null ? `&size=${modelSelectSize.value}` : ''}${modelSelectAge.value !== null ? `&age=${modelSelectAge.value}` : ''}`).then(response => {
          loading.value = false;
          data.value = response.data.data;
        });
      }
    };

    const onClearFilterAge = () => {
      loading.value = true;
      axios.get(`http://localhost:8989/list${modelSelectSize.value !== null ? `&size=${modelSelectSize.value}` : ''}${modelSelectColor.value !== null ? `&color=${modelSelectColor.value}` : ''}`).then(response => {
        loading.value = false;
        data.value = response.data.data;
      });
    };

    const onClearFilterSize = () => {
      loading.value = true;
      axios.get(`http://localhost:8989/list${modelSelectAge.value !== null ? `&age=${modelSelectAge.value}` : ''}${modelSelectColor.value !== null ? `&color=${modelSelectColor.value}` : ''}`).then(response => {
        loading.value = false;
        data.value = response.data.data;
      });
    };

    const onClearFilterColor = () => {
      loading.value = true;
      axios.get(`http://localhost:8989/list${modelSelectSize.value !== null ? `&size=${modelSelectSize.value}` : ''}${modelSelectAge.value !== null ? `&age=${modelSelectAge.value}` : ''}`).then(response => {
        loading.value = false;
        data.value = response.data.data;
      });
    };

    const optionsSelectSize = [
      {
        label: 'Pequeno',
        value: 'pequeno'
      },
      {
        label: 'Médio',
        value: 'médio'
      },
      {
        label: 'Grande',
        value: 'grande'
      },
    ];

    return {
      data,
      loading,
      modelSelectAge,
      modelSelectSize,
      modelSelectColor,
      onFilterAge,
      onFilterSize,
      onFilterColor,
      onClearFilterAge,
      onClearFilterSize,
      onClearFilterColor,
      optionsSelectSize,
    };
  }
});
</script>

<style scoped>
.loading {
  height: 30em;
  display: flex;
  align-items: center;
  justify-content: center;
  flex: 1;
}

.body-area {
  margin-left: 5.45em;
  display: flex;
  flex-direction: row;
  max-width: 100vw;
}

.title-area {
  margin-left: 5.25em;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: start;
  padding: 1.25em 0;
}

.filter-area {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.select {
  width: 15em;
  margin-left: 1em;
}

.title {
  background-color: #ffa500;
  color: #00008b;
  height: fit-content;
  width: fit-content;
  padding: 0.1em 0.5em;
  font-size: 2.125em;
  font-weight: bold;
}

.cards-area {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 9.25em;
}
</style>
