<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="row">
      <div class="col-md-12">
        <h1 class="h2">
          Turnos
        </h1>
      </div>
      <div class="col-md-12">
        <form id="validated-form" method="post" @submit.prevent="checkForm">
          <div class="form-group">
            <label>Nombres</label>
            <input v-model="form.turno" type="time" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Activo?</label>
            <input v-model="form.estado" type="checkbox">
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
export default {
  layout: 'admin',
  middleware: 'auth',
  components: {
  },
  async asyncData ({ app, params, context }) {
    return {
      form: (params.id !== 'new') ? await app.$turnos.show(params.id).then(item => item.data) : []
    }
  },
  data () {
    return {
      created: (this.$route.params.id === 'new'),
      errors: null,
      message: null,
      form: {
        turno: null,
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
          await this.$turnos.create('', {
            turno: this.form.turno,
            estado: this.form.estado
          }).then((data) => {
            this.errors = null
            this.message = null
            swal('Exito!', 'Created', 'success')
          })
        } else {
          await this.$turnos.update(this.$route.params.id, this.form).then((data) => {
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
      title: `Turno: ${this.form.turno}`
    }
  }
}
</script>
