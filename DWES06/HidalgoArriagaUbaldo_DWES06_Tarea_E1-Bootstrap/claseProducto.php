<?php
class claseProducto {

    protected $codigo;
    protected $nombre;
    protected $descripcion;
    protected $pvp;
    protected $familia;
    protected $stock;

    function __construct($codigo, $nombre, $descripcion, $pvp, $familia, $stock) {

        $this->$codigo = $codigo;
        $this->$nombre = $nombre;
        $this->$descripcion = $descripcion;
        $this->$pvp = $pvp;
        $this->$familia = $familia;
        $this->$stock = $stock;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getDescripcion(){
        return $this->descripcion;
    }

    function getPvp(){
        return $this->pvp;
    }

    function getFamilia(){
        return $this->familia;
    }

    function getStock(){
        return $this->stock;
    }
}




?>