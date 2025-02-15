import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useUserStore = defineStore('user', () => {
    const user = ref(null);

    function setUser(newUser) {
        user.value = newUser;
    }

    const isAuthenticated = computed(() => user.value !== null);

    return {
        user,
        setUser,
        isAuthenticated
    };
});