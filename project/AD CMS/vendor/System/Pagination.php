<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/4/2017
 * Time: 10:43 PM
 */

namespace System;


class Pagination
{
    /**
     * Application Class
     *
     * @var Application
     */
    private $app;

    /**
     * Total Items
     *
     * @var int
     */
    private $totalItems;

    /**
     * Items Prepage
     *
     * @var int
     */
    private $itemsPerPage = 3;

    /**
     * Last Page
     *
     * @var int
     */
    private $lastPage;

    /**
     * Current Page
     *
     * @var int
     */
    private $currentPage = 1;

    /**
     * Pagination constructor
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;

        $this->setCurrentPage();
    }

    /**
     * Set Current Page
     *
     * @return void
     */
    private function setCurrentPage()
    {
        // ?page=1
        // ?page=2
        // ?page=3
        $page = $this->app->request->get('page');

        if (!is_numeric($page) || $page < 1) {
            $page = 1;
        }

        $this->currentPage = $page;
    }

    /**
     * Get Current Page
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * Set Total Items
     *
     * @param $totalItems
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
    }

    /**
     * Get Total Items
     *
     * @return int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * Set Items Perpage
     *
     * @param $itemsPerPage
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
    }

    /**
     * Get Current Items Prepage
     *
     * @return int
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * Paginate
     *
     * @return $this
     */
    public function paginate()
    {
        $this->setLastPage();

        return $this;
    }

    /**
     * Get Last Page
     *
     * @return int
     */
    public function getLastPage()
    {
        return $this->lastPage;
    }

    /**
     * Set Last Page
     *
     * @return void
     */
    public function setLastPage()
    {
        $this->lastPage = ceil($this->totalItems / $this->itemsPerPage);
    }
}