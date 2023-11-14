<script setup>
defineProps({
  msg: {
    type: String,
    required: true
  }
})
</script>

<template>
  <div>
    <h2>{{ msg }}</h2>
  </div>
</template>
