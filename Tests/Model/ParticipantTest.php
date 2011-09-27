<?php

namespace Lime\CalendarBundle\Tests\Model;

class ParticipantTest extends \PHPUnit_Framework_TestCase
{
    
    public function testGettersSetters()
    {
        $participant = new Impl\ParticipantImpl();
        
        $this->assertTrue(null === $participant->getId());
        
        $this->assertTrue(null === $participant->getCreatedAt());
        
        $this->assertTrue(null === $participant->getUpdatedAt());
        
        $this->assertTrue(null === $participant->getExpiry());
        $expiry = new \DateTime();
        $participant->setExpiry($expiry);
        $this->assertTrue($participant->getExpiry() === $expiry);
        $participant->setExpiry(null);
        $this->assertTrue(null === $participant->getExpiry());
        
        $this->assertTrue(null === $participant->getUser());
        $user = new Impl\UserImpl(1, 'foo-user');
        $participant->setUser($user);
        $this->assertTrue($participant->getUser() === $user);
        
        $this->assertTrue(null === $participant->getRole());
        $participant->setRole('ROLE_OWNER');
        $this->assertTrue('ROLE_OWNER' === $participant->getRole());
    }

}
