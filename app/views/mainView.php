<?php

class MainView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function home($DBError) {
        require 'templates/layout/header.phtml';
        
        if ($DBError) {
            require 'templates/layout/DBError.phtml';
        }

        require 'templates/home/presentation.phtml';

        require 'templates/layout/footer.phtml';
    }

    public function showVehicles($vehicles, $DBError) {
        require 'templates/layout/header.phtml';

        if ($DBError) {
            require 'templates/layout/DBError.phtml';
        }

        if (isset($this->user->admin) && $this->user->admin == true) {
            require 'templates/showVehicles/adminOptions.phtml';
        }

        if (count($vehicles) > 0) {
            require 'templates/showVehicles/showVehicles.phtml';            
        } else {
            require 'templates/layout/showEmptyResult.phtml';
        }

        require 'templates/layout/footer.phtml';
    }

    public function vehicle($vehicle, $DBError) {
        require 'templates/layout/header.phtml';

        if ($DBError) {
            require 'templates/layout/DBError.phtml';
        }

        if (count($vehicle) > 0) {
            require 'templates/vehicle/vehicle.phtml';
        } else {
            require 'templates/layout/showEmptyResult.phtml';
        }

        require 'templates/layout/footer.phtml';
    }

    public function showAddVehicle($DBError, $message="", $categories) {
        require 'templates/layout/header.phtml';

        if ($DBError) {
            require 'templates/layout/DBError.phtml';
        }

        require 'templates/addVehicle/body.phtml';

        require 'templates/layout/footer.phtml';
    }

    public function showUpdateVehicle($DBError, $message="", $categories, $vehicle) {
        require 'templates/layout/header.phtml';

        if ($DBError) {
            require 'templates/layout/DBError.phtml';
        }

        require 'templates/updateVehicle/body.phtml';

        require 'templates/layout/footer.phtml';
    }

    public function showCategories($categories, $DBError) {
        require 'templates/layout/header.phtml';

        if ($DBError) {
            require 'templates/layout/DBError.phtml';
        }

        if (isset($this->user->admin) && $this->user->admin == true) {
            require 'templates/showCategories/adminOptions.phtml';
        }

        require 'templates/showCategories/showCategories.phtml';

        require 'templates/layout/footer.phtml';
    }

    public function category($category, $DBError) {
        require 'templates/layout/header.phtml';

        if ($DBError) {
            require 'templates/layout/DBError.phtml';
        }

        if (count($category) > 0) {
            require 'templates/showCategories/category.phtml';
        } else {
            require 'templates/layout/showEmptyResult.phtml';
        }
        require 'templates/layout/footer.phtml';
    }
}
