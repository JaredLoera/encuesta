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
    public static function getWorkers($conexion,$id){
        $consulta = "SELECT * FROM user where user.company_id = ".$id;
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr>
            <?php
        }
        foreach ($resultados as $info) {
            ?>
            <tr>
                <td><?php echo $info->id; ?></td>
                <td><?php echo $info->nombre; ?></td>
                <td><?php echo $info->rfc; ?></td>
                <td><?php echo $info->correo; ?></td>
                <td>
                    <form action="encuestasEmpresa.php?id=<?php echo $info->id; ?>" method="post">
                        <button type="submit" class="btn btn-outline-primary">Ver encuesta</button>
                    </form>
                </td>
            </tr>
            <?php
        }
    }
}