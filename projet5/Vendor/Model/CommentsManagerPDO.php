<?php
namespace Model;

use \Entity\Comments;

class CommentsManagerPDO extends CommentsManager
{
    /**
     * @see CommentsManager::add()
     */
    protected function add(Comments $comments)
    {
        $request = $this->dao->prepare('INSERT INTO news(users_id, news_id, content, publish, trash, dateCreated, dateModified) 
        VALUES(:users_id, :news_id, :content, :publish, :trash, NOW(), NOW())');

        $request->bindValue(':users_id', $comments->users_id());
        $request->bindValue(':news_id', $comments->news_id());
        $request->bindValue(':publish', false);
        $request->bindValue(':trash', false);
        

        $request->execute();
    }

    /**
     * @see CommentsManager::count()
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM comments ')->fetchColumn();
    }

    
    /**
     * @see CommentsManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
    }

    /**
     * @see CommentsManager::getList()
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
        foreach ($commentsList as $comments)
        {
            
            $comments->setDateCreated(new \DateTime($comments->dateCreated()));
            $comments->setDateModified(new \DateTime($comments->dateModified()));
        }

        $request->closeCursor();

        return $commentsList;
    } 
      

    /**
     * @see CommentsManager::getUnique()
     */
    public function getUnique($id)
    {
        $request = $this->dao->prepare('SELECT id, users_id, news_id, content, publish, trash, dateCreated, dateModified 
        FROM comments WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comments');

        $comments = $request->fetch();

        $comments->setDateCreated(new \DateTime($comments->dateCreated()));
        $comments->setDateModified(new \DateTime($comments->dateModified()));
   
        return $comments;
    }

    /**
    * @see CommentsManager::save()
    */
    public function save (Comments $comments)
    {
        if ($comments->isValid())
        {
            $comments->isNew() ? $this->add($comments) : $this->modify($comments);
        }
        else
        {
            throw new RuntimeException('Le commentaire doit être valide pour être enregistrée');
        }
    }

    /**
    * @see CommentsManager::modify()
    */
    protected function modify(Comments $comments)
    {
    $request = $this->dao->prepare('UPDATE comments 
    SET  users_id = :users_id, news_id = :news_id, content = :content, publish = :publish, trash = :trash, dateModified = NOW()
    WHERE id = :id');
   
    $request->bindValue(':users_id', $comments->users_id());
    $request->bindValue(':news_id', $comments->news_id());
    $request->bindValue(':content', $comments->content());
    $request->bindValue(':publish', $comments->publish());
    $request->bindValue(':trash', $comments->trash());
    $request->bindValue(':id', $comments->id(), \PDO::PARAM_INT);

    $request->execute();
    }
 
    
}