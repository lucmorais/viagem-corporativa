import { ref } from 'vue';
import api from './api';

export class LoginService {

    public async login(usuario: string, senha: string): Promise<boolean> {
        try {
            const response = await api.post('/login', { usuario, password: senha });

            const token = response.data.token;
            localStorage.setItem('token', token);

            return true;
        } catch (err) {
            return false;
        }
    }
}