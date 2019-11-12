<?php
namespace Model;

use \MyFram\Manager;
use \Entity\News;

abstract class NewsManager extends Manager
{
    /**
     * Method to add a chapter.
     * @param $chapter Chapter The chapter to add
     * @return void
     */
    abstract protected function add(News $news);

    /**
    * Method to tell the total number of news
    * @return int
    */
    abstract public function count();

      /**
    * Method to tell the total number of news
    * @return int
    */
    abstract public function countTrash();

    /**
     * Method to delete a chapter
     * @param $id int Identification of the chapter to delete
     * @return void
     */
    abstract public function delete($id);

     /**
     * Method return a list of asked chapters
     * @param $start int The first chapter to select
     * @param $limit int The number of chapter to select
     * @return array The list of the chapters, Each entrance is an instance of Chapter.
     */
    abstract public function getList($start = -1,$limit = -1);

      /**
     * Method return a list of asked chapters in trash
     * @param $start int The first chapter to select
     * @param $limit int The number of chapter to select
     * @return array The list of the chapters in trash, Each entrance is an instance of Chapter.
     */
    abstract public function getListTrash($start = -1,$limit = -1);

    /**
     * Metho return a specific news
     * @param $id int Identification of the news to get
     * @return News the news asked
     */
    abstract public function getUnique($id);
    
    /**
     * Method to save a News
     * @param $news news The news to save
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    abstract protected function save(News $news);
    
    /**
     * Method to modify a news
     * @param $chapter chapter the chapter to modify
     * @return void
     */
    abstract protected function modify(News $news);


}