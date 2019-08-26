
<?php

/* Aplicación Nº 19 (Figuras geométricas)
La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,
un método getter y setter para el atributo _color , un método virtual ( ToString ) y dos
métodos abstractos: Dibujar (público) y CalcularDatos (protegido). */


class FiguraGeometrica
{

    protected $_color;
    protected $_perimetro;
    protected $_superficie;


    public function __construct()
    {

    }

    public function GetColor()
    {
        return $this->_color;
    }

    public function SetColor($color)
    {
        $this->_color = $color;
    }
    

    abstract public function Dibujar();
    abstract protected function CalcularDatos();


}


?>