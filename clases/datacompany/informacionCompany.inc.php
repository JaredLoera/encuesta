<?php
include "datosCompany.inc.php";
class informacionCompany{
    
    public static function Encuestas($conexion, $id)
    {

        $consulta = "select * from quiz where quiz.company_id= '$id'";
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <h1>No se encontraron encuestas</h1>
            <?php
        }
        foreach($resultados as $resultado){ 
         ?>
           <div class="col">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nombre: <?php echo $resultado->nombre ?></h5>
                <p class="card-text">Descripcion de la encuesta:<?php echo $resultado->descripcion ?></p>
            </div>
            <div class="card-footer bg-transparent"><a href="http://">Ver detalles</a> </div>
            </div>
        </div>
         <?php
         }
    }
        public static function getNum($conexion,$sql){
            $resultado = datosCompany::count($conexion,$sql);
            return $resultado[0]->num;
    }
}