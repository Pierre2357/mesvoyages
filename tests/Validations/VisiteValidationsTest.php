<?php


namespace App\Tests\Validations;

use App\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of VisiteValidationsTest
 *
 * @author leber
 */
class VisiteValidationsTest extends KernelTestCase {
    
    public function getVisite(): Visite{
        return (new Visite())
                ->setVille("New York")
                ->setPays("USA");
    }
    
    public function assertErrors(Visite $visite, int $nbErreursAttendues, string $message=""){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($visite);
        $this->assertCount($nbErreursAttendues, $error, $message);
    }
    
    public function testValidNoteVisite(){
        $visite = $this->getVisite()->setNote(10);
        $this->assertErrors($visite, 0);
    }
    
    public function testLimiteValidNoteVisite(){
        $visite0 = $this->getVisite()->setNote(0);
        $visite20 = $this->getVisite()->setNote(20);
        $this->assertErrors($visite0, 0);
        $this->assertErrors($visite20, 0);
    }
    
    public function testLimiteNonValidNoteVisite(){
        $visiteNeg = $this->getVisite()->setNote(-1);
        $visitePos = $this->getVisite()->setNote(21);
        $this->assertErrors($visiteNeg, 1);
        $this->assertErrors($visitePos, 1);
    }
    
    public function testNonValidNoteVisite(){
        $visiteNeg = $this->getVisite()->setNote(-30);
        $visitePos = $this->getVisite()->setNote(48);
        $this->assertErrors($visiteNeg, 1);
        $this->assertErrors($visitePos, 1);
    }
    
    public function testNonValidTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(30)
                ->setTempmax(5);
        $this->assertErrors($visite, 1, "min=30, max=5 devrait échouer");
    }
    
    public function testValidTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(5)
                ->setTempmax(25);
        $this->assertErrors($visite, 0);
    }
    
    public function testLimiteValidTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(20)
                ->setTempmax(21);
        $this->assertErrors($visite, 0);
    }
    
    public function testLimiteNonValidTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(20)
                ->setTempmax(19);
        $this->assertErrors($visite, 1);
    }
    
    public function testTempminEgalTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(20)
                ->setTempmax(20);
        $this->assertErrors($visite, 1);
    }
    
     public function testValidDatecreationVisite(){ 
        $aujourdhui = new \DateTime();
        $this->assertErrors($this->getVisite()->setDatecreation($aujourdhui), 0, "aujourd'hui devrait réussir");
        $plustot = (new \DateTime())->sub(new \DateInterval("P5D"));
        $this->assertErrors($this->getVisite()->setDatecreation($plustot), 0, "plus tôt devrait réussir");
    }
    
    public function testNonValidDatecreationVisite(){ 
        $demain = (new \DateTime())->add(new \DateInterval("P1D"));
        $this->assertErrors($this->getVisite()->setDatecreation($demain), 1, "demain devrait échouer");
        $plustard = (new \DateTime())->add(new \DateInterval("P5D"));
        $this->assertErrors($this->getVisite()->setDatecreation($plustard), 1, "plus tard devrait échouer");
    }
    
}
