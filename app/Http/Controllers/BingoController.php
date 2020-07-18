<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BingoController extends Controller
{

    public $results;
    public $lastNumber;

    private function initializeGame()
    {
        $this->results = [];
        for ($i=0; $i <= 75; $i++)
        {
            $this->results[] = 0;
        }
        unset($this->results[0]);

        $this->lastNumber = 0;
    }
}
