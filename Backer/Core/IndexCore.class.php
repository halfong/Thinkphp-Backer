<?php
namespace Backer\Core;

class IndexCore extends BaseCore {

	public function index(){
		if( !$this->_assigns['Backer'] ){ A('Auth')->index(); }
		else{ $this->play('./Home'); }
	}

}