<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/show/{id}", name="author_show", methods={"GET"})
     */
    public function show(Author $author): Response
    {
        return $this->render('author/show.html.twig', [
                    'author' => $author,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="author_edit", methods={"GET","POST"}, requirements={"id":"\d+"}, defaults={ "id":null})
     */
    public function edit(Request $request, EntityManagerInterface $em, Author $author = null ): Response
    {
        if(!$author){
            $author = new Author;
        }

        $form = $this->createForm(AuthorType::class, $author, [
            'app_mode'=>$request->get('form_mode')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(!$em->contains($author)){
                $em->persist($author);
            }
            $em->flush();

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
     * @Route("/delete/{id}", name="author_delete", methods={"DELETE"})
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

    
}
