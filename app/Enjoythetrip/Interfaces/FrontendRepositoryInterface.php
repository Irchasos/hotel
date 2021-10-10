<?php

namespace App\Enjoythetrip\Interfaces;

interface FrontendRepositoryInterface
{
    public function getObjectForMainPage();

    public function getObject($id);
}
