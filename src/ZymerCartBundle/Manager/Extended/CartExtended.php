<?php
namespace ZymerCartBundle\Manager\Extended;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface as container;
use ZymerCartBundle\Manager\AbstractManager\CartAbstract;
class CartExtended extends CartAbstract
{
    public function __construct($entityManager,$request)
    {
        parent::__construct($entityManager,$request);
    }
   
}