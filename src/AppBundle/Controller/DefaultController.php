<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use AppBundle\Entity\Task;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




class DefaultController extends Controller
{
	/**
	  *@Route("/newtask", name="newtask")
	*/
	
	public function newtaskAction(Request $request){
		 $task=new Task();
		 $task->setTask('get work done');
		 $task->setDueDate(new \Datetime('tomorrow'));
		 $form=$this->createFormBuilder($task)
		 ->add('task', TextType::class)
		 ->add('dueDate',DateType::class,array('widget'=>'single_text'))
		 ->add('save', SubmitType::class,array('label'=>'save task'))
		 ->getForm();
		 
		 $form->handleRequest($request);
		 
		 if($form->isSubmitted() && $form->isValid()){
			 
			$task= $form->getData();
			return new Response('get task'.print_r($task));
			
			 }
			 
			
			
		
		 return $this->render('default/new.html.twig',array('form'=>$form->createView()));
		 
		
		}
	
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
	
	/**
	  *@Route("/create" , name="createpro")
	*/
	public function createAction()
	{
		$em=$this->getDoctrine()->getManager();
		// $this->getDoctrine()->getManager();
		$product=new Product();
		$product->setName('iphone6s');
		$product->setPrice(5800.99);
		$product->setDescription("very nice good looking phone");
		
		$em->persist($product);
		$em->flush();
		return new Response(' saved one product'.$product->getId());
		
		}
	
	/**
	 *@Route("/show/{id}", name="show_pro", requirements={"id" : "\d+"} )
	*/
	public function showAction($id=2)
	{
		//$repository=$this->getDoctrine()->getRepository(Product::class);
		
		
		$product= $this->getDoctrine()->getRepository(Product::class)->find($id);
		if(!$product){
			throw $this->createNotFoundException("not found product by id".$id);
		}
		
		$categoryName=$product->getCategory()->getName();
		return new Response('product found category is '.$categoryName . 'productName'.$product->getName());
		
		
		}
	
	
	/**
	 *@Route("/update/{id}", name="update", requirements={"id" : "\d+"})
	*/
	public function updateAction($id){
		$em= $this->getDoctrine()->getManager();
		
		$pro= $em->getRepository(Product::class)->find($id);
		if(!$pro){
			throw $this->createNotFoundException('Not found product'.$id);
			}
			$pro->setName('Mac NoteBook');
			$pro->setPrice(12888.90);
			$pro->setDescription('nice notebook');
			$em->flush();
		  return $this->redirectToRoute('homepage');
		
		}
		
		/**
		 *@Route("/remove/{id}", name="remove_pro", requirements={"id" : "\d+"})
		*/
		public function removeAction($id){
			
			 $em= $this->getDoctrine()->getManager();
			 $pro= $em->getRepository(Product::class)->find($id);
			 if(!$pro){
				 throw createNotFoundException('prodcut not existed'.$id);
				 }
				 $em->remove($pro);
				 $em->flush();
				 return $this->redirectToRoute('homepage');
			
			}
			
			/**
			 *@Route("/test", name="test")
			*/
		public function test(){
			$em=$this->getDoctrine()->getManager();
			$query=$em->createQuery('SELECT p from AppBundle:Product p where p.price>:price  ORDER BY p.price  ASC')
			->setParameter('price', 8000);
			$pros=$query->getResult();
			return new Response('pros found '.print_r($pros));
			
			}
			
			/**
			 *@Route("/addpro",name="addpro")
			*/
			public function addAction(){
				
				$product=new Product();
				$category=new Category();
				$category->setName('notebooks');
				
				$product->setName('Sumsun notebook');
				$product->setPrice(7899.00);
				$product->setDescription('this is a good looking notebook');
				$product->setCategory($category);
				
				$em=$this->getDoctrine()->getManager();
				$em->persist($category);
				$em->persist($product);
				$em->flush();
				return new Response('product created with id '.$product->getId(). 'and category id is '.$category->getId());
				
				}
}


