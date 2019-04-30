<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/author")
 */
class AuthorController extends AbstractController
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository= $authorRepository;
    }

    /**
     * @Route("/", name="author_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 10);

        $query = $this->authorRepository->createQueryBuilder('b')
                ->setMaxResults($limit)
                ->setFirstResult($offset);

        $authors = new Paginator($query);


        return $this->render('author/index.html.twig', [
                    'authors' => $authors,
                    'offset' => $offset,
                    'limit' => $limit
        ]);
    }

    /**
     * @Route("/new", name="author_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($author);
            $entityManager->flush();

            return $this->redirectToRoute('author_index');
        }

        return $this->render('author/new.html.twig', [
                    'author' => $author,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="author_show", methods={"GET"})
     */
    public function show(Author $author): Response
    {
        return $this->render('author/show.html.twig', [
                    'author' => $author,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="author_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Author $author): Response
    {
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('author_index', [
                        'id' => $author->getId(),
            ]);
        }

        return $this->render('author/edit.html.twig', [
                    'author' => $author,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="author_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Author $author): Response
    {
        if ($this->isCsrfTokenValid('delete' . $author->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($author);
            $entityManager->flush();
        }

        return $this->redirectToRoute('author_index');
    }

    /**
     * @Route("/test/me", name="author_test")
     */
    public function test()
    {
        echo "memory usage=",memory_get_usage();
        
//        $pdo = new \PDO('mysql://db_user:db_pass@database:3306/sf_test');
        $pdo = new PDO('mysql:host=database;dbname=sf_test', 'db_user', 'db_pass', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
//                
//        $stmt = ;

//        $results = $stmt->fetchAll();
        $results = $pdo->query("SELECT * FROM author")->fetchAll();
//        $results = $pdo->query("SELECT * FROM author");

        foreach ($results as $row) {
            print_r($row);
        }
        
        echo "memory usage=",memory_get_usage();


        return new Response('<html><head></head><body></body></html>');
    }

}
