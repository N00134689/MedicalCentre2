<?php
class Patient {
    private $name;
    private $address;
    private $mobile;
    private $email;
    private $birthday;
    
    public function __construct($n, $a, $m, $e, $b) {
        $this->name = $n;
        $this->address = $a;
        $this->mobile = $m;
        $this->email = $e;
        $this->birthday = $b;
    }
    
    public function getName() { return $this->name; }
    public function getAddress() { return $this->address; }
    public function getMobile() { return $this->mobile; }
    public function getEmail() { return $this->email; }
    public function getBirthday() { return $this->birthday; }
}
