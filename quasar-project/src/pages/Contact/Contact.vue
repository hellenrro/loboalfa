<template>
  <div>
    <div v-if="loading" class="loading"
      style="display: flex;justify-content: center; align-content: center; align-items: center">
      <q-spinner-facebook color="blue-10" style="justify-content: center; align-content: center; align-items: center"
        size="10em"></q-spinner-facebook>
    </div>
    <div class="title-area">
      <div class="title">
        Fale Conosco
      </div>
    </div>
    <q-form v-if="!loading" method="POST" action="https://formsubmit.co/diogomarquesbhdm19@gmail.com" class="input"
      @reset="onReset" ref="myForm">
      <div v-if="!loading" class="area">
        <div v-if="!loading" class="form-area">
          <q-input type="text" name="name" class="input" outlined v-model="form.name" color="blue-10"
            placeholder="Digite o nome" hint="Nome" :rules="[
              val => val && val.length > 0 || 'Nome obrigatório'
            ]" />

          <q-input type="email" name="email" class="input" outlined v-model="form.email" color="blue-10"
            placeholder="Digite o seu e-mail" hint="E-mail" :rules="[
              val => val && val.length > 0 || 'E-mail inválido'
            ]">
            <template v-slot:prepend>
              <q-icon name="mail"></q-icon>
            </template>
          </q-input>

          <q-input class="input" outlined v-model="form.subject" color="blue-10" placeholder="Digite o assunto"
            hint="Assunto" :rules="[
              val => val && val.length > 0 || 'Assunto obrigatório'
            ]" />
          <input type="hidden" name="_subject" :value="form.subject" />
          <input type="hidden" name="_captcha" value="false" />
          <input type="hidden" name="_next" value="http://localhost:9000/#/contact">
        </div>
        <div v-if="!loading" class="subject-area">
          <q-input type="textarea" name="message" class="input" outlined v-model="form.message" color="blue-10"
            placeholder="Digite o corpo da mensagem" hint="Sua mensagem" :rules="[
              val => val && val.length > 0 || 'Mensagem obrigatória'
            ]" />
          <div class="col-12">
            <q-btn label="Cadastrar" type="submit" style="background-color: #00008b; color: white;"
              class="float-right" />
            <q-btn label="Resetar" type="reset" color="default" class="float-right text-grey-10 q-mr-md" />
          </div>
        </div>
      </div>
    </q-form>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  name: 'RegisterPage',
  data() {
    return {
      form: {
        name: '',
        email: '',
        subject: '',
        message: '',
      },
      loading: false,
    }
  },
  methods: {
    onSubmit() {
      this.loading = true;
      //axios.post('http://localhost:8989/create', {
        //name: this.form.name,
        //description: this.form.description,
        //color: this.form.color,
        //age: this.form.age,
        //size: this.form.size,
        //img: this.form.files.map((item) => item),
      //}).then(() => {
        this.loading = false;
        this.onReset()
      //});
    },
    async onReset() {
      await this.resetForm()
      this.$refs.myForm.resetValidation()
    },
    async resetForm() {
      this.form = {
        name: '',
        email: '',
        subject: '',
        message: '',
      }
    }
  },
})
</script>

<style scoped>
.title-area {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: start;
  margin-left: 5.25em;
  padding: 1.25em 0;
}

.title {
  color: #00008b;
  padding: 0.1em 0.5em;
  font-size: 2.125em;
  font-weight: bold;
}

.area {
  display: flex;
  flex-direction: row;
  margin-top: 1.25em;
}

.form-area {
  width: 50%;
  height: 20em;
  margin-left: 6.25em;
  margin-right: 6.25em;
}

.input {
  margin-bottom: 1em;
}

.subject-area {
  width: 45%;
  margin-right: 6.25em;
}
</style>
