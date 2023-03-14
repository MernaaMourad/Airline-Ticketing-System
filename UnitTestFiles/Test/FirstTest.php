<?php
namespace UnitTestFiles\Test;
use PHPUnit\Framework\TestCase;
class FirstTest extends TestCase
{
public function testTrueAssetsToTrue()
{
    $email="admin@yahoo.com";
    $this->assertEquals($email,"admi@yahoo.com");

}


public function testTrueAssetsToTrue2()
{
    
    $pass="1234";
    $this->assertEquals($pass,"134");

}

public function testTrueAssetsToTrue3()
{
    
    $pass="1234";
    $email="admin@yahoo.com";
    $this->assertEquals($pass,"1234");
    $this->assertEquals($email,"admi@yahoo.com");

}


}
?>

