<?php 
namespace UnitTestFiles\Test;
use PHPUnit\Framework\TestCase;
class SecondTest extends TestCase
{
public function testTrueAssetsToTrue_booking1()
{
    
    $package_weight="46";
    $package_width=50;
    $package_hight=60;
    $this->assertTrue(is_int($package_weight));
    $this->assertTrue(is_int($package_width));
   $this->assertTrue(is_int($package_hight));
    
}

public function testTrueAssetsToTrue_booking2()
{
    $package_weight=70;
    $package_width=50;
    $package_height=100;

    $this->assertLessThanOrEqual($package_weight,60);
    $this->assertLessThanOrEqual($package_width,80);
    $this->assertLessThanOrEqual($package_height,100);  
}


public function testTrueAssetsToTrue_booking3()
{
    $contact="222-2-222";
    $contactLength=strlen($contact);
    
    $this->assertEquals($contactLength,10);
    
}
}
?>