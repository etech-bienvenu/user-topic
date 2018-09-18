<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserVuTopicControllerTest extends WebTestCase
{
    public function testAddvisitor()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addVisitor');
    }

    public function testPostvisitor()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/postVisitor');
    }

}
