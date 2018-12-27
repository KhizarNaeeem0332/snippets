<?php


 private function headers()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: Content-Type ,Authorization ,x-xsrf-token');
        header('Content-Type: application/json');
    }
