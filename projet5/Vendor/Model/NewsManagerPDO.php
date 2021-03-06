<?php
namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager
{
    /**
     * @see NewsManager::add()
     */
    protected function add(News $news)
    {
        $request = $this->dao->prepare('INSERT INTO news(user_id, title, content, status, trash, dateCreated, dateModified) 
        VALUES(:user_id, :title, :content, :status, :trash, NOW(), NOW())');

        $request->bindValue(':user_id', $news->user_id());
        $request->bindValue(':title', $news->title());
        $request->bindValue(':content', $news->content());
        $request->bindValue(':status', 'brouillon');
        $request->bindValue(':trash', 0);
        

        $request->execute();
    }

     /**
    * @see NewsManager::save()
    */
    public function save (News $news)
    {
        if ($news->isValid())
        {
            $news->isNew() ? $this->add($news) : $this->modify($news);
        }
        else
        {
            throw new RuntimeException('La News doit être valide pour être enregistrée');
        }
    }

    /**
    * @see NewsManager::modify()
    */
    protected function modify(News $news)
    {
    $request = $this->dao->prepare('UPDATE news 
    SET  user_id = :user_id, title = :title, content = :content, status = :status, trash = :trash, dateModified = NOW()
    WHERE id = :id');
   
    $request->bindValue(':user_id', $news->user_id());    
    $request->bindValue(':title', $news->title());
    $request->bindValue(':content', $news->content());
    $request->bindValue(':status', $news->status());
    $request->bindValue(':trash', $news->trash());
    $request->bindValue(':id', $news->id(), \PDO::PARAM_INT);

    $request->execute();
    }

     /**
     * @see NewsManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM news WHERE id = '.(int) $id);
    }

    /**
     * @see NewsManager::count()
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news WHERE trash = \'0\' ')->fetchColumn();
    }

    /**
     * @see NewsManager::count()
     */
    public function countPublish()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news WHERE trash = \'0\' AND status = \'publié\' ')->fetchColumn();
    }

     /**
     * @see NewsManager::countTrash()
     */
    public function countTrash()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news WHERE trash = \'1\' ')->fetchColumn();
    }

      /**
     * @see NewsManager:newsExist()
     */
    public function newsExist($user_id)
    {
        $request = $this->dao->prepare('SELECT * FROM news WHERE user_id = ?');
        $request->execute(array($user_id));
        $newsExist = $request->rowCount();

        return $newsExist;
    }


    /**
     * @see NewsManager::getList()
     */
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, user_id, title, content, status, trash, dateCreated, dateModified 
        FROM news
        WHERE trash = \'0\'
        ORDER BY dateCreated DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        
        $newsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($newsList as $news)
        {
            
            $news->setDateCreated(new \DateTime($news->dateCreated()));
            $news->setDateModified(new \DateTime($news->dateModified()));
        }

        $request->closeCursor();

        return $newsList;
    } 

    /**
     * @see NewsManager::getListPublish()
     */
    public function getListPublish($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, user_id, title, content, status, trash, dateCreated, dateModified 
        FROM news
        WHERE trash = \'0\'
        AND status = \'publié\'
        ORDER BY dateCreated DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        
        $newsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($newsList as $news)
        {
            
            $news->setDateCreated(new \DateTime($news->dateCreated()));
            $news->setDateModified(new \DateTime($news->dateModified()));
        }

        $request->closeCursor();

        return $newsList;
    }


    /**
     * @see NewsManager::getListTrash()
     */
    public function getListTrash($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, title, content, status, trash, dateCreated, dateModified 
        FROM news
        WHERE trash = \'1\'
        ORDER BY dateCreated DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        
        $newsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($newsList as $news)
        {
            
            $news->setDateCreated(new \DateTime($news->dateCreated()));
            $news->setDateModified(new \DateTime($news->dateModified()));
        }

        $request->closeCursor();

        return $newsList;
    } 

     /**
     * @see NewsManager::getListByAutor())
     */
    public function getListByAutor($user_id)
    {
        $sql = 'SELECT id, user_id
        FROM news
        WHERE user_id = ?';

        $request = $this->dao->prepare($sql);
        $request->execute(array($user_id));
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
        
        $newsList = $request->fetchAll();

        $request->closeCursor();

        return $newsList;
    } 
      

    /**
     * @see NewsManager::getUnique()
     */
    public function getUnique($id)
    {
        $request = $this->dao->prepare('SELECT id, user_id, title, content, status, trash, dateCreated, dateModified 
        FROM news WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        $news = $request->fetch();

        $news->setDateCreated(new \DateTime($news->dateCreated()));
        $news->setDateModified(new \DateTime($news->dateModified()));
   
        return $news;
    }
}