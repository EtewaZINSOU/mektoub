<?php

class Exo2Pagination
{

    const ODD_LENGHT = 1000;
    const EVEN_LENGHT = 400;

    protected $odds = [];
    protected $evens = [];

    protected $totalItems;
    protected $totalArrayItems = [];
    protected $pageNumber;
    protected $resultsToShowPerPage;
    protected $currentPage;

    protected $previousText = 'Previous';
    protected $nextText = 'Next';


    /**
     * @return array
     */
    public function displayOddsValues()
    {
        for($i = 0; $i < self::ODD_LENGHT; $i++) {
            if($i % 2 != 0) {
                $this->odds[] = $i;
            }
        }

        return $this->odds;
    }

    /**
     * @return array
     */
    public function displayEvensValues()
    {
        for($i = 0; $i < self::EVEN_LENGHT; $i++) {
            if($i % 2 == 0) {
                $this->evens[] = $i;
            }
        }

        return $this->evens;
    }

    /**
     * @param array $array1
     * @param array $array2
     * @return array
     */
    public function mergeTwoArrays(array $array1, array $array2)
    {
        $this->totalArrayItems = array_merge($array1,$array2);

        sort($this->totalArrayItems);

        foreach ($this->totalArrayItems as $key => $val) {
            $result[$key] = $val . "\n";
        }

        return $this->totalArrayItems;
    }

    /**
     * Permet de savoir le total d'articles provenant de la BDD;
     * @param array $items
     * @return int
     */
    public function countAllItems(array $items)
    {
        $this->totalItems = count($items);
        return $this->totalItems;
    }


    /**
     * Calculer le nombre de page totale de pagination suivant le nombre de résultats à afficher par page
     * @param $resultsToShowPerPage
     * @return float
     */
    public function lastPage($resultsToShowPerPage)
    {

        return ceil($this->totalItems / $resultsToShowPerPage);
    }

    /**
     * @param $pageNumber : page actuelle
     * @param $resultsToShowPerPage
     * @return mixed
     */
    public function showResult($pageNumber, $resultsToShowPerPage)
    {
        $first = $this->getCurrentPageFirstItem($pageNumber,$resultsToShowPerPage);

        return $this->displayItems($this->getTotalArrayItems(),$first,$resultsToShowPerPage);

    }

    /**
     * @return mixed
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * @param mixed $totalItems
     * @return Exo2Pagination
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
        return $this;
    }

    /**
     * @param array $allValues : tableau a fournir
     * @param $val1 : offset
     * @param $val2 :limit
     * @return array : valeur de retour
     */
    public function displayItems(array $allValues, $val1,$val2)
    {
        return array_slice($allValues, $val1, $val2);
    }

    /**
     * @return array
     */
    public function getTotalArrayItems()
    {
        return $this->totalArrayItems;
    }


    protected function updateNumPages()
    {
        $this->pageNumber = ($this->resultsToShowPerPage == 0 ? 0 : (int) ceil($this->totalItems / $this->resultsToShowPerPage));
    }


    public function getCurrentPageFirstItem($pageNumber, $resultsToShowPerPage)
    {
        $first = abs(($pageNumber - 1) * $resultsToShowPerPage);

        if ($first > $this->totalItems) {
            return null;
        }

        return $first;
    }


}