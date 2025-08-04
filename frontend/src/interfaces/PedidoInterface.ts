export default interface PedidoI {
    id: number;
    solicitante: number | string;
    destino: string;
    dataIda: string;
    dataVolta: string;
    status: string;
    created_at: string;
    updated_at: string;
}