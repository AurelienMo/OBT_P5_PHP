<?php


namespace App\Controllers;


class BlogController extends AbstractController
{
    public function blog()
    {
//        $session = $this->get('session');
//        $session->set('filter', array(
//            'accounts' => 'value',
//        ));
        return $this->renderResponse('core/blog.html.twig');
    }
}