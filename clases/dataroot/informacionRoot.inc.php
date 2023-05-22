<?php
include 'datosRoot.inc.php';
class informacionRoot{

    public static function informacion($conexion){
        $sql = "SELECT * FROM company";
        $resultados = datosRoot::consultas($conexion,$sql);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr> 
            <?php
        }
        foreach($resultados as $resultado){
            ?>
            <tr>  
                <td><?php echo $resultado->id; ?></td>
                <td><?php echo $resultado->nombre;?></td>
                <td><?php echo $resultado->refimenFiscal;?></td>
                <td><?php echo $resultado->domicilio;?></td>
                <td><?php echo $resultado->correo;?></td>
                <td>
                 <form action="encuestasEmpresa.php?id=<?php echo $resultado->id; ?>" method="post">
                   <!-- <button type="submit" class="btn btn-outline-primary">Ver encuestas</button> -->
                 </form>   
                </td>
            </tr>
            <?php
        }
    }
    public static function getQuizesCompanys($conexion,$id){
        $sql = "SELECT * FROM quiz WHERE company_id = '$id'";
        $resultados = datosRoot::consultas($conexion,$sql);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr> 
            <?php
        }
        foreach($resultados as $resultado){ ?>
            <tr>  
                <td><?php echo $resultado->id; ?></td>
                <td>
                   <?php echo $resultado->nombre; ?>
                </td>
            </tr>
            <?php
        }   
    }
}