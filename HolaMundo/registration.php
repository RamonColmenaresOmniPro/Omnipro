<?php
use Magento\Framework\Component\ComponentRegistrar;//Importacion

ComponentRegistrar::register( //Funcion Estatica ::
    ComponentRegistrar::MODULE, //Tipo de componente
    'Omnipro_HolaMundo', //Nombre del modulo
    __DIR__
);
