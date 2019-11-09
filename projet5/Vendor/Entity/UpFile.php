<?php
namespace Entity;

use \MyFram\Entity;
/**
   * Class represent a chapter
*/
class UpFile extends Entity
{
   protected   $news_id,
               $up_filename,
               $up_file_url,
               $dateCreated;

   /**
   * Relatives Constants to possible errors during method execution
   */
    const INVALID_FILE = 1;

   //SETTERS//

   public function setNews_id($news_id)
   {
      $this->news_id = (int) $news_id;
   }

   public function setUp_filename($up_filename)
   {
      $this->up_filename = $up_filename;
   }

   public function setUp_file_url($up_file_url)
   {
      $this->up_file_url = $up_file_url;
   }

   public function setDateCreated(\DateTime $dateCreated)
   {
      $this->dateCreated = $dateCreated;
   }


   //GETTERS//

   public function news_id()
   {
      return $this->news_id;
   }

   public function up_filename()
   {
      return $this->up_filename;
   }

   public function up_fileurl()
   {
      return $this->up_file_url;
   }

   public function dateCreated()
   {
      return $this->dateCreated;
   }

}