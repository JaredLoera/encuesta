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
        $consulta = "SELECT user.id ,concat(nombre, ' ',ap_paterno,' ',ap_materno) as nombre ,telefono,correo,rfc FROM user join contacto on  contacto.id = user.contacto_id where user.company_id=".$id;
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
                <td><?php echo $info->telefono; ?></td>
                <td>
                    <form action="respuestasWorker.php?id=<?php echo $info->id; ?>" method="post">
                        <button type="submit" class="btn btn-outline-primary">Ver encuesta</button>
                    </form>
                </td>
            </tr>
            <?php
        }
    }
    public static function getAnswersUser($conexion,$id){
        $consulta ="select pregunta.id as id_pregunta,pregunta.pregunta as pregunta,respuestasuser.respuesta as respuesta FROM pregunta join respuestasuser on pregunta.id = respuestasuser.pregunta_id where respuestasuser.user_id=" .$id;
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr>
            <?php
        }
        else {
            foreach ($resultados as $info) {
                ?>
                <tr>
                    <td><?php echo $info->id_pregunta; ?></td>
                    <td><?php echo $info->pregunta; ?></td>
                    <td><?php echo $info->respuesta; ?></td>
                </tr>
                <?php
            }
        }
    }
    public function getAllQuiestions($conexion,$company_id){
        $consulta = "SELECT * from pregunta";
        $resultados = datosCompany::consultas($conexion,$consulta);
        if (!$resultados) {
            ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos";?></td>
            </tr>
            <?php
        }
        else {
            foreach ($resultados as $info) {
                ?>
                <tr>
                    <td><?php echo $info->id; ?></td>
                    <td><?php echo $info->pregunta; ?></td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'siempre' AND user.company_id= $company_id AND pregunta.id =".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'Casi siempre' AND user.company_id= $company_id AND pregunta.id = ".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'Algunas veces' AND user.company_id= $company_id  AND pregunta.id = ".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'Casi nunca' AND $company_id AND pregunta.id = ".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                    <td>
                    <?php 
                    Conexion::abrir_conexion();
                    echo $this->getNum(Conexion::obtener_conexion(),"SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id JOIN user on user.id = respuestasuser.user_id WHERE respuestasuser.respuesta = 'Nunca' AND user.company_id= $company_id AND pregunta.id = ".$info->id);
                    Conexion::cerrar_conexion();
                    ?>
                    </td>
                </tr>
                <?php
            }
        }
    }
}