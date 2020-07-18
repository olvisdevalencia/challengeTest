<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BingoController extends Controller
{

    public $results;
    public $lastNumber;

    /**
     * Method to initialize array of numbers and start a new game
     */
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

    /**
     * Method to check it game have been finished
     */
    private function weFinish()
    {
        $finished = true;
        foreach($this->results as $result)
        {
            if($result == 0)
            {
                $finished = false;
                break;
            }
        }
        return $finished;
    }

    /**
     * Method to play a new game and check for the new number
     */
    public function newGame()
    {
        if(!$this->weFinish())
        {
            $found = false;

            do
            {
                $currentNumber = \random_int(1, 75);

                if($this->results[$currentNumber] == 0)
                {
                    $found = true;
                }

            }while($found == false);

            $this->lastNumber = $currentNumber;
            $this->results[$currentNumber] = 1;

            usleep(1 * 1000000);
        }
        else
        {
            $this->initializeGame();
            usleep(1 * 1000000);
        }

    }

    /**
     * Method to show , what numbers is not appear
     */
    private function notAppear($whichNumber)
    {
        if($this->results[$whichNumber] == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Method to generate a ramdon card.
     */
    function generateCard()
    {

        $card = array();

        for ($row = 1; $row < 8; ++$row)
        {

          $card[$row] = array();

          $deck = range($row*10, $row*10+9);

          shuffle($deck);

          for($col = 1; $col < 8; ++$col)
          {

            if($row == 7 OR $col == 7)
            {
              $card[$row][$col] = 0;
            }
            else
            {
              $card[$row][$col] = $deck[$col];
            }

          }

        }

        return $card;

    }
}
