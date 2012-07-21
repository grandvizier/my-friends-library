<?php

namespace TFL\Library\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TFLLibraryUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
