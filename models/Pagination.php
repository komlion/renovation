<?php

namespace app\models;

use yii\base\Model;

class Pagination extends Model
{
    public $recordsCount;
    public $pageCount;
    public $recordsOnPage;
    public $previousPage;
    public $currentPage;
    public $nextPage;
    public $isFirstPage;
    public $isLastPage;
    public $start;
    public $end;

    static function createPagination($recordsCount, $recordsOnPage, $currentPage): Pagination
    {
        $pagination = new Pagination;

        $pagination->recordsCount = $recordsCount;
        $pagination->recordsOnPage = $recordsOnPage;
        $pagination->pageCount = $pagination->getPageCount();
        $pagination->currentPage = $currentPage;
        $pagination->previousPage = $pagination->getPreviousPage();
        $pagination->nextPage = $pagination->getNextPage();
        $pagination->isFirstPage = $pagination->isFirstPage();
        $pagination->isLastPage = $pagination->isLastPage();
        $pagination->start = $currentPage - 1;
        $pagination->end = $pagination->getEnd();

        return $pagination;

    }

    private function getPageCount() : Int
    {
        $pageCount = $this->recordsCount / $this->recordsOnPage;

        if ($this->recordsCount % $this->recordsOnPage > 0)
        {
            $pageCount ++;
        }

        return $pageCount;
    }

    private function getPreviousPage(): int
    {
        return $this->currentPage - 1;
    }

    private function getNextPage(): int
    {
        return $this->currentPage + 1;
    }

    private function isFirstPage(): bool
    {
        if ($this->currentPage == 1)
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    private function isLastPage(): bool
    {
        if ($this->currentPage == $this->pageCount)
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    private function getEnd(): int
    {
        if ($this->currentPage == 1)
        {
            return $this->currentPage + 3;
        }
        else
        {
            return $this->currentPage + 2;
        }
    }

    public function echoPagination()
    {
        echo "<nav>
        <ul class='pagination justify-content-center'>
            <li class='page-item"; if($this->isFirstPage) {echo " disabled'>";} else {echo "'>";}
                echo "<a class='page-link' href='/projects?page=$this->previousPage'>Назад</a>
            </li>";

            for ($page = $this->start; $page < $this->end; $page++):
                if ($page > 0 and $page <= $this->pageCount):
                    echo "<li class='page-item"; if ($this->currentPage == $page) {echo " active'>";} else {echo "'>";}
                        echo "<a class='page-link' href='projects?page=$page'>$page</a>
                    </li>";
                endif;
            endfor;

            echo "<li class='page-item"; if ($this->isLastPage) {echo " disabled'>";} else {echo "'>";}
                echo "<a class='page-link' href='/projects?page=$this->nextPage'>Вперёд</a>
            </li>
        </ul>
    </nav>";
    }
}