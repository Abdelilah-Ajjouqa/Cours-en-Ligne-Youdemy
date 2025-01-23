<?php

class Courses
{
    protected $course_id;
    protected $cover;
    protected $title;
    protected $description;
    protected $content;
    protected $teacher_id;

    public function __construct($course_id, $cover, $title, $description, $content, $teacher_id)
    {
        $this->course_id = $course_id;
        $this->cover = $cover;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->teacher_id = $teacher_id;
    }

    public static function getAllCourses(PDO $db)
    {
        $query = "SELECT * FROM courses c
        JOIN categories cat
        ON c.categorie_id = cat.categorie_id
        JOIN users u
        ON c.teacher_id = u.user_id";
        
        $stmt = $db->query($query);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($courses)) {
            return $courses;
        } else {
            echo "there's no courses for now";
        }
    }

    public function addCourse(PDO $db)
    {
        try {
            $query = 'INSERT INTO courses (cover, title, description, content, teacher_id) VALUES (:cover, :title, :description, :content, :teacher_id)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':cover', $this->cover);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':teacher_id', $this->teacher_id);
            $stmt->execute();

            $courseId = $db->lastInsertId();

            if ($courseId) {
                $_SESSION['course_id'] = $courseId;
                $_SESSION['cover'] = $this->cover;
                $_SESSION['title'] = $this->title;
                $_SESSION['description'] = $this->description;
                $_SESSION['content'] = $this->content;
                $_SESSION['teacher_id'] = $this->teacher_id;
            }

            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public static function getCourseDetails(PDO $db, $course_id)
    {
        $query = '
        select c.*, u.username  from courses c
        join users u
        on c.teacher_id = u.user_id;
        WHERE course_id = :course_id';
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_ASSOC);


        if (!empty($course)) {
            return $course;
        } else {
            echo "there's no courses for now";
        }
    }

    public function deleteCourse(PDO $db)
    {
        try {
            $query = 'DELETE FROM courses WHERE course_id = :course_id';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':course_id', $this->course_id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function updateCourse(PDO $db)
    {
        try {
            $query = 'UPDATE courses SET cover = :cover, title = :title, description = :description, content = :content WHERE course_id = :course_id';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':cover', $this->cover);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':course_id', $this->course_id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getCourseTitle(PDO $db)
    {
        $query = 'SELECT title FROM courses WHERE course_id = :course_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':course_id', $this->course_id);
        $stmt->execute();
        $title = $stmt->fetch(PDO::FETCH_ASSOC);

        return $title['title'];
    }

    public function getCourseDescription(PDO $db)
    {
        $query = 'SELECT description FROM courses WHERE course_id = :course_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':course_id', $this->course_id);
        $stmt->execute();
        $description = $stmt->fetch(PDO::FETCH_ASSOC);

        return $description['description'];
    }

    public function getCourseContent(PDO $db)
    {
        $query = 'SELECT content FROM courses WHERE course_id = :course_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':course_id', $this->course_id);
        $stmt->execute();
        $content = $stmt->fetch(PDO::FETCH_ASSOC);

        return $content['content'];
    }

    public function getCourseCover(PDO $db)
    {
        $query = 'SELECT cover FROM courses WHERE course_id = :course_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':course_id', $this->course_id);
        $stmt->execute();
        $cover = $stmt->fetch(PDO::FETCH_ASSOC);

        return $cover['cover'];
    }

    public function getCourseId(PDO $db)
    {
        $query = 'SELECT course_id FROM courses WHERE title = :title';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->execute();
        $courseId = $stmt->fetch(PDO::FETCH_ASSOC);

        return $courseId['course_id'];
    }

    public static function myCourses(PDO $db, $teacher_id)
    {
        $query = 'SELECT * FROM courses WHERE teacher_id = :teacher_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($courses)) {
            return $courses;
        }
    }
}
