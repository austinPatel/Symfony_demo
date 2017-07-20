<?php

namespace ZymerCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ZymerCartBundle\Manager\Extended\CartExtended;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZymerCartBundle\Entity\Employee;
use ZymerCartBundle\Form\EmployeeType;


class ZymerCartController extends Controller
{
    public function __construct() 
    {
        $this->responseArray=null;
        $this->enitityManager=null;
        $this->cartManager1 = null;
    }
    public function __destruct()
    {
        unset($this->responseArray);
        unset($this->enitityManager);
        unset($this->cartManager1);
        
    }
    public function initAction()
    {
        $this->request = $this->getRequest();
        $this->cartManager1 = $this->get("symercart_bundle_cart_manager");
        $this->empId= $this->request->get('empId',null);
        $this->responseArray['empId']=$this->empId;
       
       
    }
    /**
     * @Route("employee/list",name="zymercart_bundle_employee_list")
     * @Template("ZymerCartBundle:Cart:add.html.twig")
     */
    public function listEmployeeAction()
    {
        $this->initAction();
        $this->responseArray['recordSet'] = $this->cartManager1->listEmployee();
        echo "<pre>";
        print_r($this->responseArray['recordSet']);
        exit;
    }
    /**
     * @Route("employee/add",name="zymercart_bundle_employee_add")
     * @Method({"GET"})
     * @Template("ZymerCartBundle:Cart:add.html.twig")
     */
    public function addEmployeeAction()
    {
        $this->initAction();
        $employee= new Employee();
        $this->form=$this->createForm(new EmployeeType($container),$employee);
        $this->form->handleRequest($this->request);
        $this->responseArray['form_employee'] = $this->form->createView();
        return $this->responseArray;
    }
    /**
     * @Route("employee/add",name="zymercart_bundle_employee_add_post")
     * @Method({"POST"})
     * @Template("ZymerCartBundle:Cart:add.html.twig")
     */
    public function addEmployeePostAction()
    {
        $this->initAction();
        $employee= new Employee();
        $this->form=$this->createForm(new EmployeeType($container),$employee);
        $this->form->handleRequest($this->request);
        if($this->form->isValid())
        {
            $data=$this->form->getData();
            $this->responseArray['record']=$this->cartManager1->addEmployee($data);
            switch($this->responseArray['record'])
            {
                case 'Success':
                   return $this->redirect($this->generateUrl("zymercart_bundle_employee_list"));
                    break;
                case 'fail':
                    break;
               
            }
        }
        $this->responseArray['form_employee'] = $this->form->createView();
        return $this->responseArray;
    }
    /**
     * @Route("employee/edit/{empId}",name="zymercart_bundle_employee_edit")
     * @Method({"GET"})
     * @Template("ZymerCartBundle:Cart:edit.html.twig")
     */
    public function editEmployeeAction()
    {
        $this->initAction();
        
        $employee=$this->get('doctrine')->getManager()->getRepository('ZymerCartBundle:Employee')->find($this->responseArray['empId']);
        $this->form=$this->createForm(new EmployeeType($container),$employee);
        $this->form->handleRequest($this->request);
        $this->responseArray['form_employee'] = $this->form->createView();
        return $this->responseArray;
    }
    /**
     * @Route("employee/edit/{empId}",name="zymercart_bundle_employee_edit_post")
     * @Method({"Post"})
     * @Template("ZymerCartBundle:Cart:edit.html.twig")
     */
    public function editEmployeePostAction()
    {
        $this->initAction();
        $employee=$this->get('doctrine')->getManager()->getRepository('ZymerCartBundle:Employee')->find($this->responseArray['empId']);
        
        $this->form=$this->createForm(new EmployeeType($container),$employee);
        $this->form->handleRequest($this->request);
        if($this->form->isValid())
        {
            $data=$this->form->getData();
            $this->responseArray['record']=$this->cartManager1->editEmployee($data);
            switch($this->responseArray['record'])
            {
                case 'Success':
                    return $this->redirect($this->generateUrl("zymercart_bundle_employee_list"));
                    break;
                case 'fail':
                    break;
                    
            }
        }
        $this->responseArray['form_employee'] = $this->form->createView();
        return $this->responseArray;
    }
}
