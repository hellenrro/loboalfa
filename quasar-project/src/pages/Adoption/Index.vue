<template>
  <div v-if="loading" class="loading">
    <q-spinner-facebook color="blue-10" size="10em"></q-spinner-facebook>
  </div>
  <div v-else>
    <div class="title-area">
      <span class="title">Animais para a adoção</span>
      <div class="filter-area">
        <q-select filled v-model="modelSelectAge" :options="optionsSelectAge" label="Idade" emit-value map-options
          clearable class="select" color="blue-10" @update:modelValue="onFilterAge" @clear="onClearFilterAge">
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

        <q-select filled v-model="modelSelectColor" :options="optionsSelectColor" label="Cor" emit-value map-options
          clearable class="select" color="blue-10" @update:modelValue="onFilterColor" @clear="onClearFilterColor">
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
      </div>
    </div>
    <div class="body-area">
      <div class="cards-area" style="margin-right: 2.45rem">
        <CardGenericList v-for="(item, index) in data" :key="index" :name="item.name" :color="item.color"
          :size="item.size" :age="item.age" :description="item.description" :id="item.id" :images-src="item.img" />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import CardGenericList from 'components/CardGenericList.vue';
import { Ref, defineComponent, ref } from 'vue';
import _ from 'lodash';
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

    interface Ioptions {
      label: string,
      value: string,
    }
    const data: Ref<Idata[]> = ref([]);
    const loading = ref(false);

    let optionsSelectAge: Ioptions[] = [];
    let optionsSelectColor: Ioptions[] = [];

    const getData = async () => {
      loading.value = true;
      const response = await axios.get('http://localhost:8989/list');
      loading.value = false;
      data.value = response.data.data;

      optionsSelectAge = _.uniqWith(data.value.map((item) => {
        return {
          label: `${item.age}`,
          value: item.age
        }
      }), _.isEqual);

      optionsSelectColor = _.uniqWith(data.value.map((item) => {
        return {
          label: `${item.color}`,
          value: item.color
        }
      }), _.isEqual);
    };

    getData();

    const modelSelectAge = ref([]);
    const modelSelectSize = ref([]);
    const modelSelectColor = ref([]);

    const onFilterAge = () => {
      if (modelSelectAge.value !== null) {
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
      if (modelSelectColor.value !== null) {
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
      optionsSelectAge,
      optionsSelectSize,
      optionsSelectColor,
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
  margin: 0 6.25em;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
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
