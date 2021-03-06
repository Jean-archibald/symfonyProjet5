<?php
namespace Model;

use \MyFram\Manager;
use \Entity\User;

abstract class UserManager extends Manager
{
    /**
     * Method to add a user.
     * @param $user User The user to add
     * @return void
     */
    abstract protected function add(User $user);

    /**
     * Method to save a User
     * @param $user User The user to save
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    abstract protected function save(User $user);

        /**
     * Method to modify a user
     * @param $user user the user to modify
     * @return void
     */
    abstract protected function modify(User $user);

    /**
     * Method to delete a user
     * @param $id int Identification of the user to delete
     * @return void
     */
    abstract public function delete($id);

    /**
    * Method to tell the total number of user
    * @return int
    */
    abstract public function count();

     /**
    * Method to tell the total number of user in Trash
    * @return int
    */
    abstract public function countTrash();

    /**
    * Method to tell if the mail already exist
    * @return int
    */
    abstract public function mailExist($email);

    /**
    * Method to tell if the mail already exist
    * @return int
    */
    abstract public function userExist($email,$password);


    /**
    * Method to get a user by his Email
    * @return bool
    */
    abstract public function getUserByEmail($email);

    /**
    * Method to get a user by his id
    * @return bool
    */
    abstract public function getUserById($id);

    /**
     * Method return a list of all users
     * @param $start int the first member
     * @param $limit int The last member
     * @return array The list of the users, Each entrance is an instance of User.
     */
    abstract public function getList($start ,$limit );

    /**
     * Method return a list of all users in trash
     * @param $start int the first member
     * @param $limit int The last member
     * @return array The list of the users, Each entrance is an instance of User.
     */
    abstract public function getListTrash($start ,$limit );
    

}