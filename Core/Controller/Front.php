<?php

class Core_Controller_Front
{
    public function init()
    {
        $request = Mage::getModel('core/request');
        $actionName = $request->getActionName() . 'Action';
        $className = $request->getFullControllerClass();//page_controller_index
        $controller = new $className();
        $controller->$actionName();
    }
}


