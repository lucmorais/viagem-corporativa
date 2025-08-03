import { ref } from 'vue';
import api from './api';
import type PedidoI from '../interfaces/PedidoInterface';

export class PedidoService {
    private pedidos = ref<PedidoI[]>([]);
    private isLoading = ref(false);
    private error = ref<string | null>(null);

    public async getPedidos(): Promise<PedidoI[] | undefined> {
        this.isLoading.value = true;
        this.error.value = null;
        try {
            const response = await api.get<PedidoI[]>('/pedido');
            return response.data;
        } catch (err) {
            this.error.value = 'Falha ao buscar pedidos.';
        } finally {
            this.isLoading.value = false;
        }

        return undefined;
    }

    public async getPedido(id: number): Promise<PedidoI | undefined> {
        try {
            const response = await api.get<PedidoI>(`/pedido/${id}`);
            return response.data;
        } catch (error) {
            this.error.value = 'Falha ao buscar pedido.';
        }
    }

    public async createPedido(pedido: Omit<PedidoI, 'id' | 'created_at' | 'updated_at'>) {
        this.isLoading.value = true;
        this.error.value = null;
        try {
            const response = await api.post<PedidoI>('/pedido', pedido);
            this.pedidos.value.push(response.data);
        } catch (err) {
            this.error.value = 'Falha ao adicionar pedido.';
        } finally {
            this.isLoading.value = false;
        }
    }
    public async updatePedido(id: number, pedido: Partial<Omit<PedidoI, 'id' | 'created_at' | 'updated_at'>>) {
        this.isLoading.value = true;
        this.error.value = null;
        try {
            const response = await api.put<PedidoI>(`/pedido/${id}`, pedido);
            const index = this.pedidos.value.findIndex(p => p.id === id);
            if (index !== -1) {
                this.pedidos.value[index] = response.data;
            }
        } catch (err) {
            this.error.value = 'Falha ao atualizar pedido.';
        } finally {
            this.isLoading.value = false;
        }
    }
}