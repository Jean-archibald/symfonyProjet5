<?php
namespace Entity;

use \MyFram\Entity;
/**
   * Class represent a chapter
*/
class News extends Entity
{
    protected   $user_id,
                $title,
                $content,
                $status,
                $dateCreated,
                $dateModified;

    /**
     * Relatives Constants to possible errors during method execution
     */
    const INVALID_TITLE = 1;
    const INVALID_CONTENT = 2;

    /**
     * Method useful to know if the news is valid
     * @return bool
     */
    public function isValid()
    {
        return !(empty($this->title) || empty($this->content));
    }

    // SETTERS //

    public function setUserId($user_id)
    {
         $this->user_id = $user_id;
    }

    public function setTitle($title)
    {
        if (!is_string($title) || empty($title))
        {
            $this->errors[] = self::INVALID_TITLE;
        }
        else
        {
            $this->title = $title;
        }
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content))
        {
            $this->errors[] = self::INVALID_CONTENT;
        }
        else
        {
            $this->content = $content;
        }
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    public function setDateModified(\DateTime $dateModified)
    {
        $this->dateModified = $dateModified;
    }

    // GETTERS //
    public function user_id()
    {
        return $this->user_id;
    }
    
    public function title()
    {
        return $this->title;
    }

    public function content()
    {
        return $this->content;
    }

    public function status()
    {
        return $this->status;
    }


    public function dateCreated()
    {
        return $this->dateCreated;
    }

    public function dateModified()
    {
        return $this->dateModified;
    }
}