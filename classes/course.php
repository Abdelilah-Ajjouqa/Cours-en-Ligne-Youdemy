<?php

class Courses {

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

    public function addCourse() {
        // code here
    }

    public function getCourseDetails()
    {
        // code here
    }
}