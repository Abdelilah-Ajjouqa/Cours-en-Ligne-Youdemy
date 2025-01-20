<?php

class Courses {
    protected $cover;
    protected $title;
    protected $description;
    protected $content;

    public function __construct($cover, $title, $description, $content)
    {
        $this->cover = $cover;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
    }

    public static function getAllCours(PDO $db)
    {
        $query = "SELECT * FROM courses";
        $stmt = $db->query($query);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!empty($courses)){
            return $courses;
        } else {
            echo "there's no courses for now";  
        }
    }

    public function addCourse(PDO $db) {
        try {
            $query = 'INSERT INTO courses (cover, title, description, content) VALUES (:cover, :title, :description, :content)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':cover', $this->cover);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':content', $this->content);
            $stmt->execute();
    
            $courseId = $db->lastInsertId();
    
            if($courseId) {
                $_SESSION['course_id'] = $courseId;
                $_SESSION['cover'] = $this->cover;
                $_SESSION['title'] = $this->title;
                $_SESSION['description'] = $this->description;
                $_SESSION['content'] = $this->content;
            }

            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getCourseDetails()
    {
        // code here
    }
}