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

    public function getAllCours(PDO $db)
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
            $stmt->bindParam(':cover', $cover);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':content', $content);
            $stmt->execute();
    
            $courseId = $db->lastInsertId();
    
            if($courseId) {
                $_SESSION['course_id'] = $courseId;
                $_SESSION['cover'] = $cover;
                $_SESSION['title'] = $title;
                $_SESSION['description'] = $description;
                $_SESSION['content'] = $content;
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