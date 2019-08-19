<?php


namespace controllers;


class logout
{
    public function __construct()
    {
        session_destroy();
    }
}