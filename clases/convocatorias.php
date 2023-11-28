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
    private $proyectosCodProyecto;
    private $candidatosIdCandidato;

    // Constructor
    public function __construct($idConvocatorias,$movilidades, $tipo, $fechaIni, $fechaFin, $fechaIniBaremacion, $fechaFinBaremacion, $fechaLisProvisional, $fechaLisDefinitiva, $proyectosCodProyecto, $candidatosIdCandidato)
    {
        $this->idConvocatorias = $idConvocatorias;
        $this->movilidades = $movilidades;
        $this->tipo = $tipo;
        $this->fechaIni = $fechaIni;
        $this->fechaFin = $fechaFin;
        $this->fechaIniBaremacion = $fechaIniBaremacion;
        $this->fechaFinBaremacion = $fechaFinBaremacion;
        $this->fechaLisProvisional = $fechaLisProvisional;
        $this->fechaLisDefinitiva = $fechaLisDefinitiva;
        $this->proyectosCodProyecto = $proyectosCodProyecto;
        $this->candidatosIdCandidato = $candidatosIdCandidato;
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

    public function setCandidatosIdCandidato($candidatosIdCandidato)
    {
        $this->candidatosIdCandidato = $candidatosIdCandidato;
    }

    public function getCandidatosIdCandidato()
    {
        return $this->candidatosIdCandidato;
    }

    // Método de la interfaz JsonSerializable para serializar el objeto a JSON
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars; 
    }
}
?>