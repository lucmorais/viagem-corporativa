import { ref } from 'vue';
import api from './api';
import type PedidoI from '../interfaces/PedidoInterface';

export class PedidoService {

    public async getPedidos(): Promise<PedidoI[] | undefined> {
        try {
            const response = await api.get<PedidoI[]>('/pedido');
            return response.data;
        } catch (err) {
            return undefined;
        }
    }

    public async getPedido(id: number): Promise<PedidoI | undefined> {
        try {
            const response = await api.get<PedidoI>(`/pedido/${id}`);
            return response.data;
        } catch (error) {
            return undefined;
        }
    }

    public async createPedido(pedido: Omit<PedidoI, 'id' | 'solicitante' | 'status' | 'created_at' | 'updated_at'>) {
        try {
            const response = await api.post<PedidoI>('/pedido', pedido);
            return response.status;
        } catch (err) {
            return undefined;
        }
    }

    public async updatePedido(id: number, pedido: Partial<Omit<PedidoI, 'id' | 'created_at' | 'updated_at'>>) {
        try {
            const response = await api.put<PedidoI>(`/pedido/${id}`, pedido);
            return response.status
        } catch (err) {
            return undefined;
        }
    }

    public async filtrarPedidos(
        solicitante: string,
        destino: string,
        dataIda: string,
        dataVolta: string,
        status: string
    ): Promise<PedidoI[] | undefined> {
        try {
            const response = await api.post<PedidoI[]>('/pedido/filtrar', {
                solicitante,
                destino,
                dataIda,
                dataVolta,
                status
            });
            return response.data;
        } catch (err) {
            return undefined;
        }
    }
}