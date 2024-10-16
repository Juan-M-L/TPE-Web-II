<?php

class MainView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function home($error) {
        require 'templates/layout/header.phtml';
        
        if ($error) {
            require 'templates/layout/error.phtml';
        }

        require 'templates/home/presentation.phtml';

        require 'templates/layout/footer.phtml';
    }

    public function showVehicles($vehicles, $error) {
        require 'templates/layout/header.phtml';

        if ($error) {
            require 'templates/layout/error.phtml';
        }

        require 'templates/showVehicles/form.phtml';

        if (isset($this->user->admin) && $this->user->admin == true) {
            require 'templates/showVehicles/adminOptions.phtml';
        }

        if (count($vehicles) > 0) {
            require 'templates/showVehicles/showVehicles.phtml';            
        } else {
            require 'templates/showVehicles/showEmptyResult.phtml';
        }

        require 'templates/layout/footer.phtml';
    }

    public function vehicle($vehicle, $error) {
        require 'templates/layout/header.phtml';

        if ($error) {
            require 'templates/layout/error.phtml';
        }

        if (count($vehicle) > 0) {
            require 'templates/vehicle/vehicle.phtml';
        } else {
            require 'templates/vehicle/noVehicleFound.phtml';
        }

        require 'templates/layout/footer.phtml';
    }
}
