<?php 
class teacher {
    private $teacher_id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $course_id;
    private $categorie_id;

    public function __construct($teacher_id, $username, $email, $password, $role, $course_id = null, $categorie_id = null) {
        $this->teacher_id = $teacher_id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->course_id = $course_id;
        $this->categorie_id = $categorie_id;
    }

    public function getTeacherId() {
        return $this->teacher_id;
    }

    public function getUserName() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getCourseId() {
        return $this->course_id;
    }

    public function getCategorieId() {
        return $this->categorie_id;
    }

    public static function checkIfTeacher(PDO $db, $teacher_id) {
        $query = '
            SELECT u.username, c.* FROM courses c
            join users u 
            on u.user_id = c.teacher_id
            where teacher_id = :teacher_id;
            ';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllTeacher(PDO $db){
        $query = 'SELECT * FROM users WHERE role = "teacher"';
        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}