<?php
include 'datosRoot.inc.php';
class informacionRoot
{

    public static function informacion($conexion)
    {
        $sql = "SELECT company.id as id_company,nombre,refimenFiscal,domicilio,pass,correo from company join contacto on contacto.id = company.contacto_id ;";
        $resultados = datosRoot::consultas($conexion, $sql);
        if (!$resultados) {
?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
        <?php
        }
        foreach ($resultados as $resultado) {
        ?>
            <tr>
                <td><?php echo $resultado->id_company; ?></td>
                <td><?php echo $resultado->nombre; ?></td>
                <td><?php echo $resultado->refimenFiscal; ?></td>
                <td><?php echo $resultado->domicilio; ?></td>
                <td><?php echo $resultado->correo; ?></td>
                <td>
                    <form action="companyquiz.php?id=<?php echo $resultado->id_company; ?>" method="post">
                        <button type="submit" class="btn btn-outline-primary">Ver encuestas</button>
                    </form>
                </td>
            </tr>
        <?php
        }
    }
    public static function getQuizesCompanys($conexion, $id)
    {
        $sql = "SELECT * FROM quiz WHERE company_id = '$id'";
        $resultados = datosRoot::consultas($conexion, $sql);
        if (!$resultados) {
        ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
        <?php
        }
        foreach ($resultados as $resultado) { ?>
            <tr>
                <td><?php echo $resultado->id; ?></td>
                <td>
                    <?php echo $resultado->nombre; ?>
                </td>
            </tr>
        <?php
        }
    }
    public static function getNumCompanys($conexion, $sql)
    {
        $resultado = datosRoot::count($conexion, $sql);
        return $resultado[0]->num;
    }
    public static function getTableCaps($conexion)
    {
        $sql = "SELECT company.id as id_company,nombre,domicilio,pass,correo from company join contacto on contacto.id = company.contacto_id ;";
        $resultados = datosRoot::consultas($conexion, $sql);
        if (!$resultados) {
        ?>
            <tr>
                <td colspan="5" class="text-center"><?php echo "No hay datos"; ?></td>
            </tr>
        <?php
        }
        foreach ($resultados as $resultado) {
            $sql_trbajadores = "SELECT count(*) as num FROM user where company_id = $resultado->id_company;";
            $resultados_trabajadores = datosRoot::consultas($conexion, $sql_trbajadores);
            // echo '<pre>';
            // var_dump($resultados_trabajadores);
            // echo '</pre>';
        ?>
            <tr>
                <td style="font-weight: bold;"><?php echo $resultado->id_company; ?></td>
                <td><?php echo $resultado->nombre; ?></td>
                <td><?php echo $resultados_trabajadores[0]->num; ?></td>
                <td><?php echo $resultado->domicilio; ?></td>
                <td>
                    <form action="viewcapitulos.php?id=<?php echo $resultado->id_company; ?>&companyname=<?php echo $resultado->nombre; ?>" method="post">
                        <button type="submit" class="btn btn-outline-primary">Ver Capitulos</button>
                    </form>
                </td>
            </tr>
        <?php
        }
    }
    public static function capitulosRespuestas($company_id)
    {
        Conexion::abrir_conexion();
        $consulta = "SELECT * from capitulo where company_id =" . $company_id . ";";
        $resultados = datosRoot::consultas(Conexion::obtener_conexion(), $consulta);
        if (!$resultados) {
        ?>
            <div class="col text-center">
                <h2>
                    No se encontraron capítulos
                </h2>
            </div>
            <?php
        } else {
            foreach ($resultados as $info) {
            ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Capitulo <?php echo $info->numcapitulo ?></h3>
                            <p class="card-text">
                            <div class="row">
                                <div class="col fs-5">
                                    Descripción: <?php echo $info->descripcion ?>.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col fs-5">
                                    Total exámenes: <?php echo informacionRoot::getNum(Conexion::obtener_conexion(), "SELECT count(*) as num FROM quiz join capitulo on capitulo.id = quiz.capitulo_id where company_id= $company_id and capitulo.id =$info->id;") ?>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-success"><a href="examenesrespuesta.php?idcap=<?php echo $info->id ?>">Ver exámenes del capitulo</a></div>
                    </div>
                </div>
<?php
                Conexion::cerrar_conexion();
            }
        }
    }
    public static function getNum($conexion, $sql)
    {
        $resultado = datosRoot::count($conexion, $sql);
        return $resultado[0]->num;
    }
}
