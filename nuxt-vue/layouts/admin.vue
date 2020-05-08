
<template>
  <div>
    <Menu />
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 d-none d-md-block bg-light sidebar">
          <Navbar />
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <nuxt />
        </main>
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
html {
  font-family: "Playfair Display", Georgia, "Times New Roman", serif;
}

h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display", Georgia, "Times New Roman", serif;
}

/*
 * Content
 */

[role="main"] {
  padding-top: 133px; /* Space for fixed navbar */
}

@media (min-width: 768px) {
  [role="main"] {
    padding-top: 5px; /* Space for fixed navbar */
  }
}
</style>
