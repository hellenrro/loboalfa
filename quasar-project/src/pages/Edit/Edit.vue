<template>
  <div>
    <div v-if="loading" class="loading "
      style="display: flex;justify-content: center; align-content: center; align-items: center">
      <q-spinner-facebook color="blue-10" style="justify-content: center; align-content: center; align-items: center"
        size="10em"></q-spinner-facebook>
    </div>
    <div v-if="!loading" class="area">
      <div v-if="!loading" class="image-area">
        <q-uploader multiple class="input-file" accept="image/" :factory="factoryFn" @added="(file) => {
          form.files.push(file[0]);
        }" @removed="(file) => {
          form.files = form.files.filter((item) => item.__key !== file[0].__key);
        }">
          <template v-slot:header="scope">
            <div class="row no-wrap items-center q-pa-sm q-gutter-xs title-uploader">
              <q-spinner v-if="scope.isUploading" class="q-uploader__spinner"></q-spinner>
              <div class="col">
                <div class="q-uploader__title">Insira as imagens do animal</div>
              </div>
              <q-btn v-if="scope.canAddFiles" type="a" icon="add_box" @click="scope.pickFiles" round dense flat>
                <q-uploader-add-trigger></q-uploader-add-trigger>
                <q-tooltip class="tooltip">Selecionar imagem</q-tooltip>
              </q-btn>
            </div>
          </template>
        </q-uploader>
        <div class="imags-area">
          <div v-for="(item, index) in form.files" :key="index">
            <q-img src="../../statics/cachorro.webp" no-native-menu class="imgs">
              <q-icon :onclick="() => {
                  form.files = form.files.filter((item) => item.__key !== file[0].__key);
                }" class="absolute all-pointer-events" size="25px" name="close" color="white" style="top: 8px; right: 8px; cursor: pointer;">
                <q-tooltip>
                  Tooltip
                </q-tooltip>
              </q-icon>
            </q-img>
          </div>
        </div>
      </div>
      <div v-if="!loading" class="form-area">
        <q-form class="input" @submit="onSubmit" @reset="onReset" ref="myForm">
          <q-input class="input" outlined v-model="form.name" color="blue-10" placeholder="Digite o nome" hint="Nome"
            :rules="[
              val => val && val.length > 0 || 'Nome obrigatório'
            ]" />

          <q-input class="input" outlined v-model="form.description" color="blue-10"
            placeholder="Digite a descrição do animal" hint="Descrição" :rules="[
              val => val && val.length > 0 || 'Descricao obrigatória'
            ]" />

          <q-input class="input" outlined v-model="form.color" color="blue-10" placeholder="Digite a cor" hint="Cor"
            :rules="[
              val => val && val.length > 0 || 'Cor obrigatória'
            ]" />

          <q-input class="input" v-model.number="form.age" type="number" color="blue-10" placeholder="Digite a idade"
            hint="Idade" outlined :rules="[
              val => val !== null || val !== '' || 'Idade obrigatória',
              val => val > 0 && val < 100 || 'Coloque uma idade real'
            ]" />

          <q-select class="input" outlined v-model="form.size" :options="sizeOptions" color="blue-10"
            label="Selecione o porte/tamanho do animal" hint="Porte/tamanho" emit-value map-options :rules="[
              val => val && val.length > 0 || 'Porte/tamanho obrigatório'
            ]" />

          <div class="col-12">
            <q-btn label="Editar" type="submit" style="background-color: #00008b; color: white;" class="float-right" />
          </div>
        </q-form>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import axios from 'axios';

export default defineComponent({
  name: 'EditPage',
  data() {
    const data = ref();
    const loading = ref(false);
    const getData = async () => {
      loading.value = true;
      //const response = await axios.get('http://localhost:8989/list');
      loading.value = false;
      //data.value = response.data.data.find((item) => item.id === +this.$route.params.id);
      data.value = { 'name': 'teste', 'color': 'preto', 'size': 'pequeno', 'age': 12, 'description': 'companheiro e brincalh\u00e3o', 'id': 24, 'img': ['../../statics/cachorro.webp', 'a', 'b', 'd', 'e', 'f'] }
    };

    getData();
    return {
      form: {
        name: data.value.name,
        description: data.value.description,
        color: data.value.color,
        age: data.value.age,
        size: data.value.size,
        files: data.value.img,
      },
      loading: false,
      sizeOptions: [
        { label: 'Pequeno', value: 'pequeno' },
        { label: 'Médio', value: 'médio' },
        { label: 'Grande', value: 'grande' }
      ],
    }
  },
  methods: {
    onSubmit() {
      this.loading = true;
      axios.put(`http://localhost:8989/edit/${this.$route.params.id}`, {
        name: this.form.name,
        description: this.form.description,
        color: this.form.color,
        age: this.form.age,
        size: this.form.size,
        img: this.form.files.map((item) => item),
      }).then(() => {
        this.loading = false;
      }).catch(() => {
        this.loading = false;
      });
    },
  },
})
</script>

<style scoped>
.area {
  display: flex;
  flex-direction: row;
  margin-top: 1.25em;
  margin-bottom: 10em;
}

.image-area {
  width: 45%;
  margin-left: 6.25em;
}

.form-area {
  width: 50%;
  height: 40em;
  margin-left: 6.25em;
  margin-right: 6.25em;
}

.input-file {
  width: 100%;
  border: 1px dashed black;
  height: 100vh;
}

.input {
  margin-bottom: 1em;
}

.title-uploader {
  background-color: #00008b;
  margin-left: 0;
}

.tooltip {
  font-size: 16px;
}

.imags-area {
  display: flex;
  flex-direction: row;
  align-items: center;
  width: 100%;
  overflow: auto;
}
.imgs {
  margin: 1em;
  height: 150px;
  width: 150px;
  min-width: 150px;
}
</style>
