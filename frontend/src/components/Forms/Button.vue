<template>
    <button 
      :type="type"
      :class="buttonClass"
      :disabled="disabled"
    >
      <slot></slot>
    </button>
  </template>
  
  <script setup>
  import { computed, defineProps, defineEmits } from 'vue'
  
  const props = defineProps({
    type: {
      type: String,
      default: 'button',
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    variant: {
      type: String,
      default: 'primary', // Opções: 'primary', 'secondary', 'success', 'danger', etc.
    },
    size: {
      type: String,
      default: '', // Opções: 'sm', 'lg' ou vazio para o tamanho padrão
    },
    block: {
      type: Boolean,
      default: false, // Para botões que ocupam a largura total do container
    },
    float: {
      type: String,
      default: '', // Opções: 'start', 'end' ou vazio para nenhum float
    }
  })
  
  const emits = defineEmits(['click'])
  
  const handleClick = (event) => {
    if (!props.disabled) {
      emits('click', event)
    }
  }
  
  const buttonClass = computed(() => {
    return [
      'btn',
      `btn-${props.variant}`,
      { 
        'btn-block': props.block, 
        [`btn-${props.size}`]: props.size,
        [`float-${props.float}`]: props.float,
      },
    ]
  })
  </script>
  
  <style scoped>
  /* Adicione estilos personalizados aqui, se necessário */
  </style>
  