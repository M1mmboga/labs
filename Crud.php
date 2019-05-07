<?php 


//we create
interface Crud
{
	public function save();
	public function readAll($table);
	public function readUnique();
	public function search();
	public function update();
	public function removeOne();
	public function removeAll();

	//new kab 2 functions
	public function validateForm();
	public function createFormErrorSessions();

}

?>