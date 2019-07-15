<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return new JsonResponse([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

  /**
   * @Route("/api/v1/users", name="all_users")
   */
  public function users ()
  {
    return $this->json([
      'message' => 'Welcome to your new controller!',
      'path' => 'src/Controller/UserController.php',
    ]);
  }
}
