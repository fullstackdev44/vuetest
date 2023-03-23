<?php

// src/Command/ImportFruitCommand.php
namespace App\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Fruits;
use Doctrine\ORM\EntityManagerInterface;

class ImportFruitCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->entityManager;
        $em->createQuery('DELETE FROM App\Entity\Fruits')->execute();
        $c = curl_init();
        curl_setopt( $c , CURLOPT_URL , 'https://fruityvice.com/api/fruit/all');
        curl_setopt( $c , CURLOPT_USERAGENT, "Mozilla/5.0 (Linux Centos 7;) Chrome/74.0.3729.169 Safari/537.36");
        curl_setopt( $c , CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $c , CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $c , CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $c , CURLOPT_TIMEOUT, 10000); // 10 sec
        $data = curl_exec($c);
        curl_close($c);
        $data2 = json_decode($data, JSON_UNESCAPED_UNICODE);
        
        foreach($data2 as $fruit){
       
            $entityManager =  $this->entityManager;
            $project = new Fruits();
            $project->setGenus($fruit['genus']);
            $project->setName($fruit['name']);
            $project->setFamily($fruit['family']);
            $project->setOrders($fruit['order']);
            $project->setCarbohydrates($fruit['nutritions']['carbohydrates']);
            $project->setProtein($fruit['nutritions']['protein']);
            $project->setFat($fruit['nutritions']['fat']);
            $project->setCalories($fruit['nutritions']['calories']);
            $project->setSugar($fruit['nutritions']['sugar']);
            $entityManager->persist($project);
            $entityManager->flush();
            
        }
            
            return Command::SUCCESS;
    }
    
     // the command description shown when running "php bin/console list"
    protected static $defaultDescription = 'Import Fruits into Database.';

    protected function configure(): void
    {
         $this->setName('app:import-fruit');
        $this
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command allows you to import fruits into Database...')
        ;
    }

}

?>