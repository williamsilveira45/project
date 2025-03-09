import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useUserStore = defineStore('user', () => {
    const user = ref(null);
    
    if (localStorage.getItem('user')) {
        user.value = JSON.parse(localStorage.getItem('user'));
    }

    function setUser(newUser) {
        user.value = newUser;
        localStorage.setItem('user', JSON.stringify(newUser));
    }

    const isAuthenticated = computed(() => user.value !== null);

    return {
        user,
        setUser,
        isAuthenticated
    };
});