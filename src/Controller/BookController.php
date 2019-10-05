<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book")
 */
class BookController extends AbstractController
{
    /**
     * @Route("/", name="book_index", methods={"GET"})
     */
    public function index(BookRepository $bookRepository, Request $request): Response
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 10);

        $query = $bookRepository->createQueryBuilder('b')
            ->addSelect('a,c')
            ->leftJoin('b.author', 'a')
            ->leftJoin('b.categories', 'c')
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        if ($term = $request->get('term')) {
            $query->andWhere('b.title LIKE :term')->setParameter('term', '%'.$term.'%');
        }

        $books = new Paginator($query, true);

        return $this->render('book/index.html.twig', [
            'books' => $books,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    /**
     * @Route("/show/{id}", name="book_show", methods={"GET"})
     */
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="book_edit", methods={"GET","POST"}, requirements={"id":"\d+"}, defaults={ "id":null} )
     */
    public function edit(Request $request, EntityManagerInterface $em, Book $book = null): Response
    {
        if (!$book) {
            $book = new Book();
        }

        $form = $this->createForm(BookType::class, $book, [
            'app_mode' => $request->get('form_mode'),
        ]);

        // $form = $this->createForm(FormType::class, $book);
        // $form->add('title')
        //     ->add('publicationDate')
        //     ->add('ISBN')
        //     ->add('author')
        //     ->add('categories', null, ['expanded' => true])
        //     ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$book->getId()) {
                $em->persist($book);
            }

            $em->flush();

            return $this->redirectToRoute('book_index', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="book_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_index');
    }
}
