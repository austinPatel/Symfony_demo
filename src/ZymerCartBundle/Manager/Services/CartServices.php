<?php
namespace ZymerCartBundle\Manager\Services;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface as container;
use ZymerCartBundle\Manager\Extended as CartManager;
class CartServices
{
    protected $requst;
    protected $response;

    public static function initFactory($entityManager,$request)
    {
        $classInstance = new CartManager\CartExtended($entityManager,$request);
        return $classInstance;
    }
}