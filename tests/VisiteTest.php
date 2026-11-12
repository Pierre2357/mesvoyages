<?php


namespace App\Tests;

use App\Entity\Environnement;
use App\Entity\Visite;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    
     public function testAddEnvironnement(){
        $environnement = new Environnement();
        $environnement->setNom("mer");
        $visite = new Visite();
        $visite->addEnvironnement($environnement);
        $nbEnvironnementAvant = $visite->getEnvironnements()->count();
        $visite->addEnvironnement($environnement);
        $nbEnvironnementApres = $visite->getEnvironnements()->count();
        $this->assertEquals($nbEnvironnementAvant, $nbEnvironnementApres, "ajout même environnement devrait échouer");
    }
}
