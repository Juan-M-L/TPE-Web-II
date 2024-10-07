<?php

class TaskView {

    public function home() {
        require 'templates/layout/header.phtml';

        require 'templates/home/carousel.phtml';

        require 'templates/layout/footer.phtml';
    }

    public function showVehicles($vehicles) {
        require 'templates/layout/header.phtml';

        require 'templates/showVehicles/form.phtml';
        require 'templates/showVehicles/showVehicles.phtml';

        require 'templates/layout/footer.phtml';
    }
}
