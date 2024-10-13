<?php

namespace MyPlugin;

class MyService {
    private $newService;

    public function __construct(NewService $newService) {
        $this->newService = $newService;
    }

    public function onInit() {
        // Your code to run on 'init'
        $this->newService->onWpLoaded();
    }
}
