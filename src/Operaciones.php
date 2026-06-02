<?php
/*
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location:login.php');
}*/

require_once 'conexion.php';

class Operaciones
{
    function getDatosProd($id){
        require_once 'conexion.php';

       $consulta = "SELECT e.usuario as user , c.nombre as cnombre, c.apellido1 as cape1, c.apellido2 as cape2, v.id
                from ventas v inner join empleados e on  v.id_empleado = e.id
                inner join clientes c on v.id_cliente = c.id 
                where v.id_producto = :id
                ";
        
        $stmt = $conProyecto->prepare($consulta);

        $stmt->execute([
            ":id=>$id"
        ]);

        $res = [];

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $res[] = "Empleado: {$filas->user} \n Cliente: {$filas->cnombre} {$filas->cape1} {$filas->cape2}";
        }

        if (empty($res)) {
            $res[] = "Sin ventas";
        }

        return $res;
    }
}
