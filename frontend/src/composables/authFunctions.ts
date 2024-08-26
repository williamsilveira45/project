import axios from 'axios';
import { useUserStore } from '@/stores/user';

export function useLogin() {
    const userStore = useUserStore();

    const login = async (email: string, password: string, xsrf_token: string) => {
        try {
            const response = await axios.post('/users/login', {
                email: email,
                password: password,
            });
    
            userStore.setUser(response.data);

            return response;
        } catch (error) {
            throw error;
        }
    };

    return { login };
}

export function useLogout() {
    const userStore = useUserStore();

    const logout = async () => {
        if (!userStore.user) {
            return;
        }

        try {
            await axios.delete(`/users/${userStore.user.id}/logout`);
            userStore.setUser(null);
        } catch (error) {
            throw error;
        }
    };

    return { logout };
}
