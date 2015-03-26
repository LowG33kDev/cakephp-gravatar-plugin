<?php

App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('GravatarHelper', 'Gravatar.View/Helper');

class GravatarHelperTest extends CakeTestCase {
    
    public function setUp() {
		parent::setUp();
	    $Controller = new Controller();
	    $View = new View($Controller);
	    $this->Gravatar = new GravatarHelper($View);
    }

    public function testDefaultValues(){
    	$result = $this->Gravatar->generate('');

    	$this->assertContains('http://', $result); // Check if is not secure
    	$this->assertContains('s=80', $result); // Check default size
    	$this->assertContains('d=mm', $result); // Check default image
    	$this->assertTextNotContains('f=y', $result); // Check default no force default
    	$this->assertContains('r=g', $result); // Check default rating

    }

    public function testInitialValues(){
    	$Controller = new Controller();
	    $View = new View($Controller);
	    $this->Gravatar = new GravatarHelper($View, array(
	    	'secure'=>true,
			'extension'=>'.jpg',
			'size'=>'100',
			'default'=>'identicon',
			'forcedefault'=>true,
			'rating'=>'pg'));	

	    $result = $this->Gravatar->generate('');
	    $this->assertContains('https://', $result); // Check if is secure
    	$this->assertContains('.jpg', $result); // Check extension
    	$this->assertContains('s=100', $result); // Check size
    	$this->assertContains('d=identicon', $result); // Check default image
    	$this->assertContains('f=y', $result); // Check no force default
    	$this->assertContains('r=pg', $result); // Check rating
    }

    public function testWrongValues(){
    	$result = $this->Gravatar->generate('',array(
    		'extension'=>'.tiff',
			'size'=>'50000',
			'rating'=>'pgd'));

    	$this->assertContains('s=80', $result); // Check size
    	$this->assertTextNotContains('.tiff', $result); // Check no force default
    	$this->assertContains('r=g', $result); // Check rating

    	$result = $this->Gravatar->generate('',array(
			'size'=>'-1'));
    	$this->assertContains('s=80', $result); // Check size
    }

    public function testWithOptions() {
    	$result = $this->Gravatar->generate('',array(
    		'secure'=>true,
			'extension'=>'.jpg',
			'size'=>'200',
			'default'=>'identicon',
			'forcedefault'=>true,
			'rating'=>'pg',
			'image-options'=>array('class'=>'MyClass')));

	    $this->assertContains('s=200', $result);
	    $this->assertContains('https://', $result); // Check if is secure
    	$this->assertContains('.jpg', $result); // Check extension
    	$this->assertContains('s=200', $result); // Check size
    	$this->assertContains('d=identicon', $result); // Check default image
    	$this->assertContains('f=y', $result); // Check no force default
    	$this->assertContains('r=pg', $result); // Check rating
    	$this->assertContains('MyClass', $result); // Check image options
    }

    public function testWithOverideOptions(){
    	$Controller = new Controller();
	    $View = new View($Controller);
	    $this->Gravatar = new GravatarHelper($View, array(
	    	'secure'=>true,
			'extension'=>'.jpg',
			'size'=>'100',
			'default'=>'identicon',
			'forcedefault'=>true,
			'rating'=>'pg',
			'image-options'=>array('class'=>'MyClass')));	

	    $result = $this->Gravatar->generate('',array(
    		'secure'=>false,
			'extension'=>'.png',
			'size'=>'200',
			'default'=>'wavatar',
			'forcedefault'=>false,
			'rating'=>'x',
			'image-options'=>array('class'=>'OverloadClass')));
	    $this->assertContains('http://', $result); // Check if is secure
    	$this->assertContains('.png', $result); // Check extension
    	$this->assertContains('s=200', $result); // Check size
    	$this->assertContains('d=wavatar', $result); // Check default image
    	$this->assertTextNotContains('f=y', $result); // Check no force default
    	$this->assertContains('r=x', $result); // Check rating
    	$this->assertContains('OverloadClass', $result); // Check image options
    }
}