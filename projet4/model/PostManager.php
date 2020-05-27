<?php


/*namespace Simon\Projet4\Model;*/

require_once("Manager.php");

class PostManager extends Manager
{
    public function __construct() {
        parent::__construct();
    }


    public function newPost($id, $author, $title, $quote, $content)
    {
        $author = $_POST['author'];
        $title = $_POST['title'];
        $quote = $_POST['quote'];
        $content = $_POST['texteditor'];
        
        $db = $this->database;
        $req = $db->prepare('INSERT INTO posts(id, author, title, quote, content, date_post) 
                                VALUES(:author, :title, :quote, :content, CURDATE())');
        $req->execute(array(
                        'author' => $author,
                        'title' => $title,
                        'quote' => $quote,
                        'content' => $content
                          ));

   
       return $req;
       
    }

    public function getLastPosts(){

                
        $db = $this->database;
        $req = $db->query('SELECT id, author, title, quote, content, DATE_FORMAT(date_post, \'%d/%m/%Y\')
         AS date_post_fr FROM posts ORDER BY date_post DESC LIMIT 0, 3');

        return $req;/*->fetchAll();*/
    
    }

    public function getAllPosts(){


        $db = $this->database;
        $req = $db->query('SELECT id, author, title, quote, content, DATE_FORMAT(date_post, \'%d/%m/%Y\')
         AS date_post_fr FROM posts ORDER BY date_post');


        /*var_dump($this->database);*/

        return $req;

    }

    public function getPost($postId) {


        $db = $this->database;
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(date_post, \'%d/%m/%Y \')
         AS date_post_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
    
        return $post;
    }


}