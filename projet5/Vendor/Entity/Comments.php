<?php
namespace Entity;

use \MyFram\Entity;
/**
   * Class represent a comment
*/
class Comments extends Entity
{
    protected   $users_id,
                $news_id,
                $content,
                $publish,
                $dateCreated,
                $dateModified;

    /**
     * Relatives Constants to possible errors during method execution
     */
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
    
    public function setUsers_id($users_id)
    {
        $this->users_id = $users_id;
    }

    public function setNews_id($news_id)
    {
        $this->news_id = $news_id;
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

    public function setPublish($publish)
    {
        $this->publish = $publish;
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

    public function users_id()
    {
        return $this->users_id;
    }

    public function news_id()
    {
        return $this->news_id;
    }

    public function content()
    {
        return $this->content;
    }

    public function publish()
    {
        return $this->publish;
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