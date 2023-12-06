<?php
class Convocatorias implements JsonSerializable
{
    // Propiedades de la clase
    private $idConvocatorias;
    private $movilidades;
    private $tipo;
    private $fechaIni;
    private $fechaFin;
    private $fechaIniBaremacion;
    private $fechaFinBaremacion;
    private $fechaLisProvisional;
    private $fechaLisDefinitiva;
    private $destino;
    private $proyectosCodProyecto;

    // Constructor
    public function __construct($idConvocatoria = null, $movilidades, $tipo, $fechaIni, $fechaFin, $fechaIniBaremacion, $fechaFinBaremacion, $fechaLisProvisional, $fechaLisDefinitiva,$destino,$proyectosCodProyecto)
    {
        $this->idConvocatorias = $idConvocatoria;
        $this->movilidades = $movilidades;
        $this->tipo = $tipo;
        $this->fechaIni = $fechaIni;
        $this->fechaFin = $fechaFin;
        $this->fechaIniBaremacion = $fechaIniBaremacion;
        $this->fechaFinBaremacion = $fechaFinBaremacion;
        $this->fechaLisProvisional = $fechaLisProvisional;
        $this->fechaLisDefinitiva = $fechaLisDefinitiva;
        $this->destino = $destino;
        $this->proyectosCodProyecto = $proyectosCodProyecto;
    }

    public function setIdConvocatorias($idConvocatorias)
    {
        $this->idConvocatorias = $idConvocatorias;
    }

    public function getIdConvocatorias()
    {
        return $this->idConvocatorias;
    }

    public function setMovilidades($movilidades)
    {
        $this->movilidades = $movilidades;
    }

    public function getMovilidades()
    {
        return $this->movilidades;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setFechaIni($fechaIni)
    {
        $this->fechaIni = $fechaIni;
    }

    public function getFechaIni()
    {
        return $this->fechaIni;
    }

    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    }

    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    public function setFechaIniBaremacion($fechaIniBaremacion)
    {
        $this->fechaIniBaremacion = $fechaIniBaremacion;
    }

    public function getFechaIniBaremacion()
    {
        return $this->fechaIniBaremacion;
    }

    public function setFechaFinBaremacion($fechaFinBaremacion)
    {
        $this->fechaFinBaremacion = $fechaFinBaremacion;
    }

    public function getFechaFinBaremacion()
    {
        return $this->fechaFinBaremacion;
    }

    public function setFechaLisProvisional($fechaLisProvisional)
    {
        $this->fechaLisProvisional = $fechaLisProvisional;
    }

    public function getFechaLisProvisional()
    {
        return $this->fechaLisProvisional;
    }

    public function setFechaLisDefinitiva($fechaLisDefinitiva)
    {
        $this->fechaLisDefinitiva = $fechaLisDefinitiva;
    }

    public function getFechaLisDefinitiva()
    {
        return $this->fechaLisDefinitiva;
    }

    public function setProyectosCodProyecto($proyectosCodProyecto)
    {
        $this->proyectosCodProyecto = $proyectosCodProyecto;
    }

    public function getProyectosCodProyecto()
    {
        return $this->proyectosCodProyecto;
    }

    public function setDestino($destino)
    {
        $this->destino = $destino;
    }

    public function getDestino()
    {
        return $this->destino;
    }



    // Método de la interfaz JsonSerializable para serializar el objeto a JSON
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
?>