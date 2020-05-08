<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="row">
      <div class="col-md-12">
        <h1 class="h2">
          Peliculas
        </h1>
      </div>
      <div class="col-md-12">
        <form id="validated-form" method="post" @submit.prevent="checkForm">
          <div class="form-group">
            <label>Nombres</label>
            <input v-model="form.nombre" type="text" class="form-control" required>
            <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
          </div>
          <div class="form-group">
            <label>Fecha Publicación</label>
            <b-form-datepicker v-model="form.fpublicacion" class="form-control" aria-required="true" locale="es-ES" />
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label>Imagen</label>
              </div>
              <div class="col-md-12 my-4">
                <FileReader @load="text = $event" />
                <picture v-if="form.imagen" class="py-4">
                  <b-img
                    :src="`${form.imagen}`"
                    fluid
                    rounded
                    alt="Fluid image"
                    width="200"
                    class="mt-4"
                  />
                </picture>
              </div>
              <div class="col-md-12">
                <picture v-if="text" class="py-4">
                  <b-img
                    :src="`${text}`"
                    fluid
                    rounded
                    alt="Fluid image"
                    width="200"
                  />
                </picture>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">
            Guardar
          </button>
          <div v-for="(value, key) in errors" :key="key" class="alert alert-info mt-3" role="alert">
            {{ value[0] }}
          </div>
          <div v-if="message" class="alert alert-danger mt-2" role="alert">
            {{ message }}
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import swal from 'sweetalert'
import FileReader from '~/components/FileReader'
export default {
  layout: 'admin',
  middleware: 'auth',
  components: {
    FileReader
  },
  async asyncData ({ app, params, context }) {
    return {
      form: (params.id !== 'new') ? await app.$peliculas.show(params.id).then(item => item.data) : []
    }
  },
  data () {
    return {
      created: (this.$route.params.id === 'new'),
      text: null,
      errors: null,
      message: null,
      form: {
        fpublicacion: null,
        nombre: null,
        imagen: null,
        estado: 0
      }
    }
  },
  methods: {
    async checkForm () {
      try {
        if (this.text) {
          this.form.imagen = this.text
        }
        if (this.created) {
          // this.$axios.setHeader('Content-Type', ['application/json', 'application/x-www-form-urlencoded'])
          // this.$axios.setHeader('X-Requested-With', 'XMLHttpRequest')
          await this.$peliculas.create('', {
            nombre: this.form.nombre,
            imagen: this.form.imagen,
            fpublicacion: this.form.fpublicacion,
            estado: 0
          }).then((data) => {
            swal('Exito!', 'Created', 'success')
          })
        } else {
          await this.$peliculas.update(this.$route.params.id, this.form).then((data) => {
            if (data.message) {
              swal('Error!', data.message, 'aviso')
            } else {
              swal('Exito!', 'actualizado', 'success')
            }
          })
        }
      } catch (e) {
        if (e.response.data.message) {
          this.message = e.response.data.message
        }
        this.errors = e.response.data.errors
      }
    }
  },
  head () {
    return {
      title: this.form.nombre
    }
  }
}
</script>
