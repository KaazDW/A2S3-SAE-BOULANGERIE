<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class HomePageTest extends WebTestCase
{

    public function testHomePage()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $userRepository = $container->get('doctrine')->getRepository(User::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('admin@gmail.com'); // mettre le mail d'un vrai utilisateur

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // now you can interact with your app as an authenticated user
        $client->request('GET', '/');
        $this->assertResponseRedirects('/accueil');
    }

    public function testProduitPage()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $userRepository = $container->get('doctrine')->getRepository(User::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('admin@gmail.com');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // now you can interact with your app as an authenticated user
        $client->request('GET', '/produit');
        $this->assertResponseIsSuccessful();
    }

}