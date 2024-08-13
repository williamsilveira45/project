<template>
    <div class="form-group mb-3">
      <label :for="id" class="form-label">{{ label }}</label>
      <input
        :type="isPassword ? 'password' : 'text'"
        :id="id"
        :readonly="isReadonly"
        :class="['form-control', { 'is-invalid': hasError }]"
        v-model="internalValue"
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
        modelValue: {
            type: String,
            required: true
        },
        label: {
            type: String,
            default: ''
        },
        id: {
            type: String,
            required: true
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
  
    const internalValue = ref(props.modelValue);

    watch(
        () => props.modelValue,
        (newValue) => internalValue.value = newValue
    );

    // Função para atualizar o valor e emitir o evento de atualização
    const updateValue = (event) => {
        emit('update:modelValue', event.target.value);
    };
</script>
  
<style scoped>
/* Estilos adicionais, se necessário */
</style>
  