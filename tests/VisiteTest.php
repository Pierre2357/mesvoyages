<?php


namespace App\Tests;

use App\Entity\Visite;
use PHPUnit\Framework\TestCase;

/**
 * Description of VisiteTest
 *
 * @author leber
 */
class VisiteTest extends TestCase {
    
    public function testGetDateCreactionString(){
        $visite = new Visite();
        $visite->setDateCreation(new \DateTime("2024-04-24"));
        $this->assertEquals("24/04/2024", $visite->getDateCreationString());
    }
}
