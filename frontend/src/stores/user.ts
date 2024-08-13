import { defineStore } from 'pinia'
import {ref, computed, ComputedRef} from 'vue'
import { User } from "./types/user.ts";

export const useUserStore = defineStore('user', () => {
    const user = ref<User | null>(null);

    const setUser = (newUser: User) => user.value = newUser;

    const isAuthenticated: ComputedRef<boolean> = computed((): boolean => {
        return user.value !== null;
    });

    return { user, isAuthenticated, setUser };
});
