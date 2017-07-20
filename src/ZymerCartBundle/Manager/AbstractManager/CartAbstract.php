<?php
namespace ZymerCartBundle\Manager\AbstractManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface as container;
use ZymerCartBundle\Entity\Employee;

abstract class CartAbstract
{
    protected $cartRepository;
    
    public function __construct($entityManager,$request)
    {
        
       $this->entityManager=$entityManager;
       $this->request=$request;
       $this->cartRepository = $this->entityManager->getRepository("ZymerCartBundle:Employee");
       
    }
    public function listEmployee()
    {
        return $this->cartRepository->listEmployee();
        
    }
    public function addEmployee($data)
    {
        $data=$this->cartRepository->addEmployee($data);
        if($data)
        {
            return 'Success';
        }
        else
        {
            return 'fail';
        }
    }
    public function editEmployee($data)
    {
        $data=$this->cartRepository->editEmployee($data);
        if($data)
        {
            return 'Success';
        }
        else
        {
            return 'fail';
        }
    }
}