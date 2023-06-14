<?php
class Bloque
{
    public $folio;
    public $company_id;
    public $bloqueinfo_id;

    public function set_folio($folio)
    {
        $this->folio = $folio;
    }
    public function get_folio()
    {
        return $this->folio;
    }
    public function set_company_id($company_id)
    {
        $this->company_id = $company_id;
    }
    public function get_company_id()
    {
        return $this->company_id;
    }
    public function set_bloqueinfo_id($bloqueinfo_id)
    {
        $this->bloqueinfo_id = $bloqueinfo_id;
    }
    public function get_bloqueinfo_id()
    {
        return $this->bloqueinfo_id;
    }


    //Metodos
    public function save()
    {
        try {
            Conexion::abrir_conexion();
            $pdo = Conexion::obtener_conexion();

            $sql = "INSERT INTO bloque (folio,company_id,bloqueinfo_id) VALUES ('$this->folio',$this->company_id, $this->bloqueinfo_id)";
            $consulta = $pdo->prepare($sql);
            $resultado = $consulta->execute();
            if ($resultado) {
                $lastInsertId = $pdo->lastInsertId();
                Conexion::cerrar_conexion();
                return $lastInsertId;
            } else {
?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>¡Error!</strong> Hubo un problema al crear el bloque.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php
            }
        } catch (PDOException $ex) {
            echo "ERROR " . $ex->getMessage();
        }
    }
}
