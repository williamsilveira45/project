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
