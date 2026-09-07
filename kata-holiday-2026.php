<?php
/*
Feu un programa que registri totes les cerveses que porta consumides cada un/a de nosaltres! (Poden no ser cerveses)
- Registrar cada nova cervesa (o el que sigui) demanat per cada persona.
- Pagar. Assumint un preu unitari (arbitrari) per a cada producte, trient del registre el que estigui pagat.
- Pringar. Retorna la suma de tot el que no s'ha pagat i que, típicament, sol recaure sobre qui o els qui se'n van al final.
Bonus track: Si en vols més, fes els tests de l'aplicació.
*/
declare(strict_types=1);
$ordenesClientes = [
    'Juan' => [
        'cerveza' => 2,
        'patatas' => 1
    ], 
    'Pedro' => [
        'cerveza' => 1,
        'agua' => 2,
        'patatas' => 1
    ],
    'Ana' => [
        'cerveza' => 1,
        'cocacola' => 1,
        'vino' => 1,
        'patatas' => 2
    ]
];

function buscarPrecio($producto)
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

function registrarPedido($ordenesClientes)
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

$consumoClientes = registrarPedido($ordenesClientes);


function pagar($nombreCliente, $consumoClientes)
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
    echo "El consumo total de $nombreCliente es $consumoTotalCliente €".PHP_EOL;
    return $consumoClientes;
}

$consumoPagado = pagar('Juan',$consumoClientes);


function pringar($consumoPagado)
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
pringar($consumoPagado);


?>