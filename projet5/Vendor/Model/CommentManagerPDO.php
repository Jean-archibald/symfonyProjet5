<?php
namespace Model;

use \Entity\Comment;

class CommentManagerPDO extends CommentManager
{
    /**
     * @see CommentManager::add()
     */
    protected function add(Comment $comment)
    {
        $request = $this->dao->prepare('INSERT INTO comment(user_id, news_id, content, status, trash, dateCreated, dateModified) 
        VALUES(:user_id, :news_id, :content, :status, :trash, NOW(), NOW())');

        $request->bindValue(':user_id', $comment->user_id());
        $request->bindValue(':news_id', $comment->news_id());
        $request->bindValue(':content', $comment->content());
        $request->bindValue(':status', 'brouillon');
        $request->bindValue(':trash', 0);
        

        $request->execute();
    }

    /**
     * @see CommentManager::count()
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM comment ')->fetchColumn();
    }

    /**
     * @see CommentManager::count()
     */
    public function countTrash()
    {
        return $this->dao->query('SELECT COUNT(*) FROM comment WHERE trash = 1 ')->fetchColumn();
    }

    
    /**
     * @see CommentManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM comment WHERE id = '.(int) $id);
    }

        /**
     * @see CommentManager::getList()
     */
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, user_id, news_id, content, status, trash, dateCreated, dateModified 
        FROM comment
        WHERE trash = 0
        ORDER BY dateCreated DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        
        $commentsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($commentsList as $comment)
        {
            
            $comment->setDateCreated(new \DateTime($comment->dateCreated()));
            $comment->setDateModified(new \DateTime($comment->dateModified()));
        }

        $request->closeCursor();

        return $commentsList;
    } 

    /**
     * @see CommentManager::getListPublish()
     */
    public function getListPublish($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, user_id, news_id, content, status, trash, dateCreated, dateModified 
        FROM comment
        WHERE status = "publié" 
        ORDER BY dateCreated DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        
        $commentsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($commentsList as $comment)
        {
            
            $comment->setDateCreated(new \DateTime($comment->dateCreated()));
            $comment->setDateModified(new \DateTime($comment->dateModified()));
        }

        $request->closeCursor();

        return $commentsList;
    } 
      
    /**
     * @see CommentManager::getListPublish()
     */
    public function getListTrash($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, user_id, news_id, content, status, trash, dateCreated, dateModified 
        FROM comment
        WHERE trash = 1 
        ORDER BY dateCreated DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        
        $commentsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($commentsList as $comment)
        {
            
            $comment->setDateCreated(new \DateTime($comment->dateCreated()));
            $comment->setDateModified(new \DateTime($comment->dateModified()));
        }

        $request->closeCursor();

        return $commentsList;
    } 
      
    /**
     * @see CommentManager::getUnique()
     */
    public function getUnique($id)
    {
        $request = $this->dao->prepare('SELECT id, user_id, news_id, content, status, trash, dateCreated, dateModified 
        FROM comment WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $comment = $request->fetch();

        $comment->setDateCreated(new \DateTime($comment->dateCreated()));
        $comment->setDateModified(new \DateTime($comment->dateModified()));
   
        return $comment;
    }
/**
     * @see NewsManager::getListByNews())
     */
    public function getListByNews($news_id)
    {
        $sql = 'SELECT id, news_id
        FROM News
        WHERE news_id = "'.$news_id.'"';

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        
        $commentsList = $request->fetchAll();

        $request->closeCursor();

        return $commentsList;
    } 

    /**
    * @see CommentsManager::save()
    */
    public function save (Comment $comment)
    {
        if ($comment->isValid())
        {
            $comment->isNew() ? $this->add($comment) : $this->modify($comment);
        }
        else
        {
            throw new RuntimeException('Le commentaire doit être valide pour être enregistrée');
        }
    }

    /**
    * @see CommentsManager::modify()
    */
    protected function modify(Comment $comment)
    {
    $request = $this->dao->prepare('UPDATE comment 
    SET  user_id = :user_id, news_id = :news_id, content = :content, status = :status, trash = :trash, dateModified = NOW()
    WHERE id = :id');
   
    $request->bindValue(':user_id', $comment->user_id());
    $request->bindValue(':news_id', $comment->news_id());
    $request->bindValue(':content', $comment->content());
    $request->bindValue(':status', $comment->status());
    $request->bindValue(':trash', $comment->trash());
    $request->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

    $request->execute();
    }
    
      /**
     * @see CommentManager:commentsExist()
     */
    public function commentsExist($news_id)
    {
        $request = $this->dao->prepare('SELECT * FROM comment WHERE news_id = ?');
        $request->execute(array($news_id));
        $commentsExist = $request->rowCount();

        return $commentsExist;
    }


  /**
     * @see NewsManager::getListByComment())
     */
    public function getListByComment($news_id)
    {
        $sql = 'SELECT id, news_id
        FROM comment
        WHERE news_id = "'.$news_id.'"';

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        
        $commentList = $request->fetchAll();

        $request->closeCursor();

        return $commentList;
    }

      /**
     * @see CommentManager:commentsExist()
     */
    public function commentsExistOfUser($user_id)
    {
        $request = $this->dao->prepare('SELECT * FROM comment WHERE  user_id = ?');
        $request->execute(array($user_id));
        $commentsExistOfUser = $request->rowCount();

        return $commentsExistOfUser;
    }

     

         /**
     * @see NewsManager::getListByComment())
     */
    public function getListByCommentOfUser($user_id)
    {
        $sql = 'SELECT id, user_id
        FROM comment
        WHERE user_id = "'.$user_id.'"'  ;

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        
        $commentList = $request->fetchAll();

        $request->closeCursor();

        return $commentList;
    }
    
}