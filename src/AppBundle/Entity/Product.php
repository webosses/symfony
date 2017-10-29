<?php 
//src/AppBundle/Entity/Product.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 *@ORM\Entity
 *@ORM\Table(name="Product")
*/
class Product{
	
	/**
	 *@ORM\Column(type="integer")
	 *@ORM\Id
	 *@ORM\GeneratedValue(strategy="AUTO")
	*/
	private $id;
	
	/**
	 *@ORM\Column(type="string", length=100)
	*/
	private  $name;
	
	/**
	 *@ORM\Column(type="decimal" , scale=2)
	*/
	private $price;
	
	
	/**
	 *@ORM\Column(type="text")
	*/
	private $description;
	
	
	/**
	 *@ORM\ManyToOne(targetEntity="Category", inversedBy="products")
	 *@ORM\JoinColumn(name="category_id", referencedColumnName="id")
	*/
	private $category;
	
	
	  public function getCategory(){
		   return $this->category;
		  
		  }
		
		public function setCategory($cat){
			$this->category=$cat;
			}
	
	
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name=$name;
	}
	
	public function getPrice()
	{
		return $this->price;
	}
	
	public function setPrice($price)
	{
		$this->price=$price;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($desc)
	{
		$this->description=$desc;
	}
	
	public function getId()
	{
		 return $this->id;
	}
	
	
	
	
	
	}

?>