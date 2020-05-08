<template>
  <div class="custom-file">
    <input type="file" class="custom-file-input" accept="image/jpeg, image/png" @change="loadTextFromFile">
    <label class="custom-file-label" for="customFile">Elija un archivo</label>
  </div>
</template>

<script>
export default {
  data () {
    return {
      imageSrc: null
    }
  },
  methods: {
    loadTextFromFile (ev) {
      const file = ev.target.files[0]
      const reader = new FileReader()
      reader.onload = e => this.$emit('load', e.target.result)
      reader.readAsDataURL(file)
    }
  }
}
</script>
