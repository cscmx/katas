<?php

class Bar
{
    private array $pedidos;
    
    public function buscarPrecio(string $producto): int
    {
        $precio = 0;
        switch ($producto)
        {
            case "cerveza":
                $precio = 2.5;
                break;
            case "agua":
                $precio = 2;
                break;
            case "vino":
                $precio = 3;
                break;
            case "cocacola":
                $precio = 2;
                break;
            case "patatas" :
                $precio = 2.5;
                break;
            default :
            echo "Ese producto no existe";
        }
        return $precio;    
    }
        
    
    public function registrarPedido(array $ordenesClientes): array
    {
        $consumo = [];
        foreach($ordenesClientes as $cliente=>$pedido)
            {
                foreach($pedido as $producto => $cantidad)
                    {
                        $precioProducto = buscarPrecio($producto);
                        $consumo[] = ['cliente' => $cliente, 
                                            'consumo' => $cantidad*$precioProducto,
                                            'pagado' => false
                                            ];
                    }  
            }
            return $consumo;
        
    }

/*pagar(): filtrar por dos condiciones (persona + !pagado), acumular el total, y marcar usando el índice.
*/
    public function pagar(string $nombreCliente, array $consumoClientes): array
    {
        $consumoTotalCliente = 0;
        foreach($consumoClientes as $i => $cliente)
        {
            if($cliente['cliente'] == $nombreCliente && $cliente['pagado'] == false)
                {
                    $consumoTotalCliente += $cliente['consumo'];
                    $consumoClientes[$i]['pagado'] = true;
                }
        }
        echo "El consumo total de ".$cliente['cliente']." es $consumoTotalCliente €".PHP_EOL;
        return $consumoClientes;
    }


    public function pringar($consumoPagado)
    {
        $totalPringar = 0;
        foreach($consumoPagado as $i=>$pagado)
            {
                if($pagado['pagado']==false)
                    {
                        $totalPringar += $pagado['consumo'];
                    }
            }
            echo "Total sin pagar: $totalPringar"."€";
            return $totalPringar;
    }

}
?>