<?php
namespace Model;

use \MyFram\Manager;
use \Entity\Comments;

abstract class CommentsManager extends Manager
{
    /**
     * Method to add a comment.
     * @param $comments Comments The comment to add
     * @return void
     */
    abstract protected function add(Comments $comments);

    /**
    * Method to tell the total number of comments
    * @return int
    */
    abstract public function count();

    /**
     * Method to delete a comments
     * @param $id int Identification of the comment to delete
     * @return void
     */
    abstract public function delete($id);

     /**
     * Method return a list of asked comments
     * @param $start int The first comment to select
     * @param $limit int The number of comment to select
     * @return array The list of the comments, Each entrance is an instance of Comment.
     */
    abstract public function getList($start = -1,$limit = -1);

    /**
     * Metho return a specific comment
     * @param $id int Identification of the comment to get
     * @return Comments the comment asked
     */
    abstract public function getUnique($id);
    
    
    /**
     * Method to save a Comment
     * @param $comments comments The comment to save
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    abstract protected function save(Comments $comments);
    
    

    /**
     * Method to modify a comment
     * @param $comments comment the comment to modify
     * @return void
     */
    abstract protected function modify(Comments $comments);


    

}