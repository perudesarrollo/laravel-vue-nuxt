<template>
  <div>
    <Menu />
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 d-none d-md-block bg-light sidebar">
          <Navbar />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Menu from '~/components/Menu.vue'
import Navbar from '~/components/Navbar.vue'

export default {
  components: {
    Menu,
    Navbar
  }
}
</script>

<style>

</style>
