<?php

class enroll
{
    private $student_id;
    private $course_id;
    private $enrollment_id;

    public function __construct($student_id, $course_id, $enrollment_id = null)
    {
        $this->student_id = $student_id;
        $this->course_id = $course_id;
        $this->enrollment_id = $enrollment_id;
    }

    // public function getUserId()
    // {
    //     return $this->student_id;
    // }

    // public function getCourseId()
    // {
    //     return $this->course_id;
    // }

    // public function getEnrollId()
    // {
    //     return $this->enrollment_id;
    // }

    public static function checkIfEnroll(PDO $db ,$student_id, $course_id)
    {
        $query = 'SELECT * FROM enrollments WHERE course_id = :course_id AND student_id = :student_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();

        return $stmt->fetch();
    }
}
