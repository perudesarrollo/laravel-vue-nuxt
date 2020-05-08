<template>
  <div v-if="loggedInUser" class="sidebar-sticky">
    <div class="nav flex-column">
      <li class="nav-item">
        <NLink class="nav-link" to="/dashboard">
          <i class="fa fa-home" aria-hidden="true" />
          Dashboard
        </NLink>
      </li>
      <li class="nav-item">
        <NLink class="nav-link" to="/peliculas">
          <i class="fa fa-film text-muted" aria-hidden="true" />
          Películas
        </NLink>
      </li>
      <li class="nav-item">
        <NLink class="nav-link" to="/turnos">
          <i class="fa fa-calendar text-muted" aria-hidden="true" />
          Turnos
        </NLink>
      </li>
      <li class="nav-item">
        <NLink class="nav-link" to="/administradores">
          <i class="fa fa-address-card-o text-muted" aria-hidden="true" />
          Administradores
        </NLink>
      </li>
      <li class="nav-item">
        <NLink class="nav-link" to="/perfil">
          <i class="fa fa-user-o text-muted" aria-hidden="true" />
          Perfil
        </NLink>
      </li>
      <li class="nav-item">
        <NLink class="nav-link" to="`javascript:void(0);`" @click="logout">
          <i class="fa fa-close text-muted" aria-hidden="true" />
          Cerrar Sesión
        </NLink>
      </li>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters(['isAuthenticated', 'loggedInUser'])
  },
  methods: {
    async logout () {
      await this.$auth.logout()
    }
  }
}
</script>
<style>
/*
 * Sidebar
 */

.sidebar {
  /* position: fixed; */
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 4px 0 0; /* Height of navbar */
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

@supports ((position: -webkit-sticky) or (position: sticky)) {
  .sidebar-sticky {
    position: -webkit-sticky;
    position: sticky;
  }
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #999;
}

.sidebar .nav-link.active {
  color: #007bff;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}

a.nuxt-link-active {
  color: #007bff !important;
}
li.nuxt-link-active a {
  color: #007bff !important;
}
</style>
