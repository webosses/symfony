<?php 
// src/AppBundle/Entity/Task.php
namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Task
{
	/**
	 *@Assert\NotBlank()
	*/
	protected $task;
	
	/**
	 *@Assert\NotBlank()
	 *@Assert\Type("\DateTime")
	*/
	protected $dueDate;
	
	public function getTask()
	{
		return $this->task;
		}
		
	public function setTask($task)
	{
		$this->task=$task;
		}
		
	public function setDueDate(\DateTime $dueDate=null)
	{
	   $this->dueDate=$dueDate;
	   	
		}
	public function getDueDate()
	{
		return $this->dueDate;
		}
	
	}
?>