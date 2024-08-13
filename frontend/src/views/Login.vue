<template>
    <div class="container mt-3">
        <div class="col-md-4 offset-md-4">
            <div class="row">
                <h1>Login</h1>
            </div>
            <div class="row mt-3">
                <form @submit.prevent="loginAction">
                    <InputText
                        label="Email:"
                        id="email"
                        v-model="email"
                        :errorMessage="emailError"
                    />
                    <InputText
                        label="Password:"
                        id="password"
                        isPassword
                        v-model="password"
                        :errorMessage="passwordError"
                    />
                    <button type="submit" class="btn btn-primary float-end">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from "axios";
import { useLogin } from "@/composables/authFunctions";
import InputText from "@/components/Forms/InputText.vue";

const email = ref('');
const password = ref('');
const emailError = ref('');
const passwordError = ref('');

const { login } = useLogin();

const loginAction = async () => {
    try {
        emailError.value = '';
        passwordError.value = '';

        await axios.get('http://backend.project/sanctum/csrf-cookie');
        await login(email.value, password.value);
    } catch (error) {
        if (error.response.status === 422) {
            if (Object.keys(error.response.data.errors).length > 0) {
                Object.keys(error.response.data.errors).forEach((key) => {
                    if (key === 'email') {
                        emailError.value = error.response.data.errors[key].join('<br>');
                    }
                    if (key === 'password') {
                        passwordError.value = error.response.data.errors[key].join('<br>');
                    }
                });
            }
        }
    }
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
