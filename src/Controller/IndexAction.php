<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexAction extends AbstractController
{
    /**
     * @return Response
     *
     * @throws \Exception
     */
    public function __invoke(): Response
    {
        return $this->render('index/index.twig');
    }
}