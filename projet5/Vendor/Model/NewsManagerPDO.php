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
        $request = $this->dao->prepare('INSERT INTO news(title, content, publish, trash, dateCreated, dateModified) 
        VALUES(:title, :content, :publish, :trash, NOW(), NOW())');

        $request->bindValue(':title', $news->title());
        $request->bindValue(':content', $news->content());
        $request->bindValue(':publish', false);
        $request->bindValue(':trash', false);
        

        $request->execute();
    }

    /**
     * @see NewsManager::count()
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM news ')->fetchColumn();
    }

    
    /**
     * @see NewsManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM news WHERE id = '.(int) $id);
    }

    /**
     * @see NewsManager::getList()
     */
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, title, content, publish, trash, dateCreated, dateModified 
        FROM news
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
     * @see NewsManager::getUnique()
     */
    public function getUnique($id)
    {
        $request = $this->dao->prepare('SELECT id, title, content, publish, trash, dateCreated, dateModified 
        FROM news WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        $news = $request->fetch();

        $news->setDateCreated(new \DateTime($news->dateCreated()));
        $news->setDateModified(new \DateTime($news->dateModified()));
   
        return $news;
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
    SET  title = :title, content = :content, publish = :publish, trash = :trash, dateModified = NOW()
    WHERE id = :id');
   
    $request->bindValue(':title', $news->title());
    $request->bindValue(':content', $news->content());
    $request->bindValue(':publish', $news->publish());
    $request->bindValue(':trash', $news->trash());
    $request->bindValue(':id', $news->id(), \PDO::PARAM_INT);

    $request->execute();
    }
 
    
}