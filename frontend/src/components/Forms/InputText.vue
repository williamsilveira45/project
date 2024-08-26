<template>
    <div class="form-group mb-3">
      <label :for="id" class="form-label">{{ label }}</label>
      <input
        :type="isPassword ? 'password' : 'text'"
        :id="id"
        :readonly="isReadonly"
        :class="['form-control', { 'is-invalid': hasError }]"
        v-model="model"
        @input="updateValue"
      />
      <div v-if="hasError" class="invalid-feedback">
        {{ errorMessage }}
      </div>
    </div>
  </template>
  
<script setup>
    import { computed, ref, watch } from 'vue';
  
    const props = defineProps({
        label: {
            type: String,
            default: ''
        },
        id: {
            type: String,
            required: true
        },
        value: {
            type: String,
            default: ''
        },
        isPassword: {
            type: Boolean,
            default: false
        },
        isReadonly: {
            type: Boolean,
            default: false
        },
        errorMessage: {
            type: String,
            default: ''
        }
    });

    const hasError = computed(() => props.errorMessage !== '');
    const emit = defineEmits(['update:modelValue']);
    const model = defineModel({ type: String })

</script>
  
<style scoped>
/* Estilos adicionais, se necessário */
</style>
  