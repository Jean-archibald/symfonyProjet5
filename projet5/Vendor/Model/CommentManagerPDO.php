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
        $request = $this->dao->prepare('INSERT INTO news(users_id, news_id, content, publish, trash, dateCreated, dateModified) 
        VALUES(:users_id, :news_id, :content, :publish, :trash, NOW(), NOW())');

        $request->bindValue(':users_id', $comment->users_id());
        $request->bindValue(':news_id', $comment->news_id());
        $request->bindValue(':publish', false);
        $request->bindValue(':trash', false);
        

        $request->execute();
    }

    /**
     * @see CommentManager::count()
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM comments ')->fetchColumn();
    }

    
    /**
     * @see CommentManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
    }

    /**
     * @see CommentManager::getList()
     */
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, users_id, news_id, content, publish, trash, dateCreated, dateModified 
        FROM comments
        ORDER BY dateCreated DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comments');
        
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
        $request = $this->dao->prepare('SELECT id, users_id, news_id, content, publish, trash, dateCreated, dateModified 
        FROM comments WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comments');

        $comment = $request->fetch();

        $comment->setDateCreated(new \DateTime($comment->dateCreated()));
        $comment->setDateModified(new \DateTime($comment->dateModified()));
   
        return $comment;
    }

    /**
    * @see CommentsManager::save()
    */
    public function save (Comments $comment)
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
    $request = $this->dao->prepare('UPDATE comments 
    SET  users_id = :users_id, news_id = :news_id, content = :content, publish = :publish, trash = :trash, dateModified = NOW()
    WHERE id = :id');
   
    $request->bindValue(':users_id', $comment->users_id());
    $request->bindValue(':news_id', $comment->news_id());
    $request->bindValue(':content', $comment->content());
    $request->bindValue(':publish', $comment->publish());
    $request->bindValue(':trash', $comment->trash());
    $request->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

    $request->execute();
    }
 
    
}