import { ref } from 'vue';
import axios from 'axios';

export class LoginService {
    private isLoading = ref(false);
    private error = ref<string | null>(null);

    public async login(usuario: string, senha: string): Promise<boolean> {
        this.isLoading.value = true;
        this.error.value = null;

        try {
            const response = await axios.post('http://localhost:8000/login', { usuario, password: senha });

            const token = response.data.token;
            localStorage.setItem('token', token);

            return true;
        } catch (err) {
            this.error.value = 'Falha ao realizar login.';
            return false;
        } finally {
            this.isLoading.value = false;
        }
    }
}