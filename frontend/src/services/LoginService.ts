import { ref } from 'vue';
import api from './api';

export class LoginService {

    public async login(usuario: string, senha: string): Promise<boolean> {
        try {
            const response = await api.post('/login', { usuario, password: senha });

            const token = response.data.token;
            localStorage.setItem('token', token);

            const responseUser = await api.get('/user');

            const user = responseUser.data;
            localStorage.setItem('usuario', JSON.stringify(user));

            return true;
        } catch (err) {
            return false;
        }
    }

    public async logout(): Promise<number | undefined> {
        try {
            const response = await api.post('/logout');
            return response.status;
        } catch (err) {
            return undefined;
        }
    }
}