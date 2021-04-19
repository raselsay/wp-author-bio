<?php 

function wedo_author_contact_methods( $methods )
{
	$methods['twitter']=__('Twitter','wedo');
	$methods['facebook']=__('Facebook','wedo');
	$methods['linkedin']=__('Linkedin','wedo');
	$methods['youtube']=__('Youtube','wedo');
   return $methods;
}

add_action('user_contactmethods','wedo_author_contact_methods');