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
        $query = 'INSERT INTO courses (cover, title, description, content) VALUES (:cover, :title, :description, :content)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':cover', $cover);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->execute();

        $courseId = $db->lastInsertId();

    }

    public function getCourseDetails()
    {
        // code here
    }
}