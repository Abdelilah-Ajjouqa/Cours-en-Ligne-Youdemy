<?php 
class admin {
    protected $admin_id;
    
    public function __construct($admin_id) {
        $this->admin_id = $admin_id;
    }

    public function getAdminId() {
        return $this->admin_id;
    }

    public function active(){
        
    }
}