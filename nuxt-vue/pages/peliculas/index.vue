<template>
  <div class="">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
      <h1 class="h2">
        Peliculas
      </h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <NLink class="btn btn-sm btn-outline-primary" to="/peliculas/new">
          Nueva Pelicula
        </NLink>
      </div>
    </div>
    <b-table
      :items="items.data"
      :current-page="items.meta.current_page"
      :per-page="items.meta.per_page"
      :fields="fields"
      hover
      striped
      thead-class="py-2 bg-light text-semibold text-center border-bottom"
      thead-tr-class="border-th-border-0"
      responsive
    >
      <template v-slot:cell(id)="data">
        {{ data.index + 1 }}
      </template>
      <template v-slot:cell(actions)="data" :class="'lo-stats__actions'">
        <div class="btn-group" role="group" aria-label>
          <nuxt-link v-b-tooltip.hover :to="`/peliculas/${data.item.id}`" class="btn btn-sm btn-outline-secondary" title="Editar">
            <i class="fa fa-pencil-square-o" aria-hidden="true" />
          </nuxt-link>
          <nuxt-link v-b-tooltip.hover :to="`/peliculas/${data.item.id}`" class="btn btn-sm btn-outline-secondary" title="Turno">
            <i class="fa fa-bars" aria-hidden="true" />
          </nuxt-link>
          <button v-b-tooltip.hover class="btn btn-sm btn-outline-secondary" title="Estado" @click="statusChange(data.item)">
            <i v-if="!data.item.estado" class="fa fa-lock text-danger" aria-hidden="true" />
            <i v-if="data.item.estado" class="fa fa-unlock" aria-hidden="true" />
          </button>
          <button v-b-tooltip.hover type="button" class="btn btn-sm btn-outline-secondary" title="Eliminar" @click="deleteTo(data.item)">
            <i class="fa fa-trash-o" aria-hidden="true" />
          </button>
        </div>
      </template>
    </b-table>
  </div>
</template>
<script>
import swal from 'sweetalert'
export default {
  layout: 'admin',
  middleware: 'auth',
  async asyncData (ctx) {
    return {
      items: await ctx.app.$peliculas.index()
    }
  },
  data () {
    return {
      companyId: this.$auth.state.user.companyId,
      items: [],
      fields: [
        {
          key: 'id',
          label: 'Id',
          sortable: true
        },
        {
          key: 'nombre',
          label: 'Nombre',
          sortable: true
        },
        {
          key: 'fpublicacion',
          label: 'F. Publicación',
          sortable: true
        }, 'actions']
    }
  },
  methods: {
    async statusChange (data) {
      const estado = (data.estado) ? 0 : 1
      await swal({
        title: '¿Está seguro?',
        text: 'Una vez cambiado el estado, no podrás recuperar.',
        icon: 'warning',
        buttons: true,
        dangerMode: true
      })
        .then(async (willDelete) => {
          if (willDelete) {
            data.estado = estado
            await this.$peliculas.update(data.id, data).then((data) => {
              swal('Exito!', 'actualizado', 'success')
            })
            this.items.data.filter(f => f.id === data.id).map((m) => { m.estado = estado })
          }
        })
    },
    async deleteTo (item) {
      await swal({
        title: '¿Está seguro?',
        text: 'Una vez eliminado, no podrás recuperar.',
        icon: 'warning',
        buttons: true,
        dangerMode: true
      })
        .then(async (willDelete) => {
          if (willDelete) {
            await this.$peliculas.delete(item.id).then(async (data) => {
              swal('Exito!', data.message, 'success')
              this.items = await this.$peliculas.index()
            })
          }
        })
    }
  },
  head () {
    return {
      title: 'Peliculas'
    }
  }
}
</script>

<style>

</style>
