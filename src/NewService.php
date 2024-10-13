<?php

namespace MyPlugin;

class NewService {
    public function onWpLoaded() {
        // Code for the 'wp_loaded' action hook
        print_r('From New Service');
    }
}
