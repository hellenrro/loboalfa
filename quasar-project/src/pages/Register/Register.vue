<template>
  <q-page class="container" padding>
    <p class="text-h4">Cadastrar animal</p>
      <q-form
        @submit="onSubmit"
        @reset="onReset"
        class="row q-col-gutter-md"
        ref="myForm"
      >
        <q-input
          outlined
          v-model="form.name"
          color="deep-purple"
          label="Nome"
          class="col-md-12 col-sm-12 col-xs-12"
          :rules="[
            val => val && val.length > 0 ||  'Nome obrigatório'
          ]"
        />

        <q-input
          outlined
          v-model="form.description"
          color="deep-purple"
          label="Descricao"
          class="col-md-12 col-sm-12 col-xs-12"
          :rules="[
            val => val && val.length > 0 ||  'Descricao obrigatória'
          ]"
        />

        <q-input
          outlined
          v-model="form.color"
          color="deep-purple"
          label="Cor"
          class="col-md-12 col-sm-12 col-xs-12"
          :rules="['anyColor']"
        >
          <template v-slot:append>
            <q-icon name="colorize" class="cursor-pointer">
              <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                <q-color v-model="form.color" />
              </q-popup-proxy>
            </q-icon>
          </template>
        </q-input>

        <q-input
          v-model.number="form.age"
          type="number"
          outlined
          label="Idade"
          class="col-md-12 col-sm-12 col-xs-12"
          :rules="[
            val => val !== null || val !== '' || 'Idade obrigatória',
            val => val > 0 && val < 100 || 'Coloque uma idade real'
          ]"
        />

        <q-select
          outlined
          v-model="form.size"
          :options="sizeOptions"
          label="Porte/tamanho"
          class="col-md-12 col-sm-12 col-xs-12"
          emit-value
          map-options
          :rules="[
            val => val && val.length > 0 || 'Porte/tamanho obrigatório'
          ]"
        />

        <q-file
          outlined
          v-model="form.file"
          color="deep-purple"
          label="Imagem"
          class="col-md-12 col-sm-12 col-xs-12"
          accept="image/"
          :rules="[
              val => val != null || 'Imagem obrigatória',
          ]"
        >
          <template v-slot:prepend>
            <q-icon name="attach_file" />
          </template>
        </q-file>

        <div class="col-12">
          <q-btn
            label="Cadastrar"
            type="submit"
            style="background-color: darkblue; color: white;"
            class="float-right"
          />
          <q-btn
            label="Resetar"
            type="reset"
            color="default"
            class="float-right text-grey-10 q-mr-md"
          />
        </div>
      </q-form>
  </q-page>
</template>

<script>
import {defineComponent} from 'vue';
import axios from 'axios';

export default defineComponent({
  name: 'RegisterPage',
  data () {
    return {
      form: {
        name: '',
        description: '',
        color: '',
        age: null,
        size: '',
      },
      sizeOptions: [
        { label: 'Pequeno', value: 'p' },
        { label: 'Médio', value: 'm' },
        { label: 'Grande', value: 'g' }
      ],
    }
  },
  methods: {
    onSubmit () {
      console.log(this.form);

      axios.post('http://localhost:8989/create', {
        name: this.form.name,
        description: this.form.descricao,
        img: this.form.file,
      }).then(response => {
        console.log(response.data);
      });

      this.$q.notify({
        message: 'Animal cadastrado com sucesso',
        color: 'positive',
        icon: 'check_circle_outline'
      })
      this.onReset()
    },
    async onReset () {
      await this.resetForm()
      this.$refs.myForm.resetValidation()
    },
    async resetForm () {
      this.form = {
        name: '',
        description: '',
        color: '',
        age: null,
        size: '',
      }
    }
  }
})
</script>
