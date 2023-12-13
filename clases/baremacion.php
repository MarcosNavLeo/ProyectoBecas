<?php

class baremacion{
    private $idbaremacion;
    private $iditem_barenables;
    private $idConvocatorias;
    private $url;
    private $Candidatos_idCandidato;

    public function __construct($idbaremacion, $iditem_barenables, $idConvocatorias,$url, $Candidatos_idCandidato) {
        $this->idbaremacion = $idbaremacion;
        $this->iditem_barenables = $iditem_barenables;
        $this->idConvocatorias = $idConvocatorias;
        $this->url = $url;
        $this->Candidatos_idCandidato = $Candidatos_idCandidato;
    }

    //los getters y setters
    public function getIdbaremacion() {
        return $this->idbaremacion;
    }

    public function getIditem_barenables() {
        return $this->iditem_barenables;
    }

    public function getIdConvocatorias() {
        return $this->idConvocatorias;
    }

    public function getCandidatos_idCandidato() {
        return $this->Candidatos_idCandidato;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setIdbaremacion($idbaremacion) {
        $this->idbaremacion = $idbaremacion;
    }

    public function setIditem_barenables($iditem_barenables) {
        $this->iditem_barenables = $iditem_barenables;
    }

    public function setIdConvocatorias($idConvocatorias) {
        $this->idConvocatorias = $idConvocatorias;
    }

    public function setCandidatos_idCandidato($Candidatos_idCandidato) {
        $this->Candidatos_idCandidato = $Candidatos_idCandidato;
    }

    public function setUrl($url) {
        $this->url = $url;
    }
}