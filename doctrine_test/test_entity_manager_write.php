<?php

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events as ORMEvents;
use Doctrine\DBAL\Events as DBALEvents;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\Common\EventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\Util\Debug;

require_once 'boot.php';

/*@var $em EntityManager*/
$em = require_once 'get_entity_manager.php';

//ajout de listener sur l'entity Manager
class EchoSubscriber implements EventSubscriber
{
   public function getSubscribedEvents()
   {
       return [ 
           //NB on utilise ORMEvents car DBALEvents existe également 
           // (de même pour la classe queryBuilder qui existe dans les packages ORM et DBAL), 
           // !!! attention aux initiatives de vos IDE
           ORMEvents::prePersist,
           ORMEvents::postPersist,
           ORMEvents::preFlush,
           ORMEvents::onFlush,
           ORMEvents::postFlush,
           ORMEvents::preUpdate,
           ORMEvents::postUpdate,
           ORMEvents::preRemove,
           ORMEvents::postRemove,
       ];
   }
   public function prePersist(LifecycleEventArgs $event)
   {
       echo PHP_EOL, " [prePersist Event]";
   }
   public function postPersist(LifecycleEventArgs $event)
   {
       echo PHP_EOL, " [postPersist Event]";
   }
   public function preUpdate(LifecycleEventArgs $event)
   {
       echo PHP_EOL, " [preUpdate Event]";
   }
   public function postUpdate(LifecycleEventArgs $event)
   {
       echo PHP_EOL, " [postUpdate Event]";
   }
   public function preRemove(LifecycleEventArgs $event)
   {
       echo PHP_EOL, " [preRemove Event]";
   }
   public function postRemove(LifecycleEventArgs $event)
   {
       echo PHP_EOL, " [postUpdate Event]";
   }
   public function preFlush(PreFlushEventArgs $event)
   {
       echo PHP_EOL, " [preFlush Event] ";
       $uow = $event->getEntityManager()->getUnitOfWork();
       echo PHP_EOL, '      ',count($uow->getScheduledEntityInsertions()),' for insert ';
       echo PHP_EOL, '      ',count($uow->getScheduledEntityUpdates()),' for update ';
       foreach($uow->getScheduledEntityUpdates() as $e){
          $changeSet = $uow->getEntityChangeSet($e);
          print_r($changeSet);
       }
       echo PHP_EOL, '      ',count($uow->getScheduledEntityDeletions()),' for delete ';
   }
   public function onFlush(OnFlushEventArgs $event)
   {
       echo PHP_EOL, " [onFlush Event] ";
       $uow = $event->getEntityManager()->getUnitOfWork();
       $uow = $event->getEntityManager()->getUnitOfWork();
       echo PHP_EOL, '      ',count($uow->getScheduledEntityInsertions()),' for insert ';
       echo PHP_EOL, '      ',count($uow->getScheduledEntityUpdates()),' for update ';
       foreach($uow->getScheduledEntityUpdates() as $e){
            $changeSet = $uow->getEntityChangeSet($e);
            print_r($changeSet);
       }
       echo PHP_EOL, '      ',count($uow->getScheduledEntityDeletions()),' for delete ';

   }
   public function postFlush(PostFlushEventArgs $event)
   {
       echo PHP_EOL, " [postFlush Event]";
   }
}

$em->getEventManager()->addEventSubscriber(new EchoSubscriber);


$author = new Author;
$author->setFirstName('TEST');
$author->setLastName('TEST');
$author->setBirthDate(new DateTime('2000-01-01'));

echo PHP_EOL, 'BEFORE CALLING PERSIST ON AUTHOR ',PHP_EOL;
$em->persist($author);
echo PHP_EOL, 'AFTER CALLING PERSIST ON AUTHOR ',PHP_EOL;

$book=new Book();
$book->setTitle('TEST');
$book->setIsbn('test');
$book->setPublicationDate(new DateTime('2000-01-01'));
$book->setAuthor($author);

echo PHP_EOL, 'BEFORE CALLING PERSIST ON BOOK ',PHP_EOL;
$em->persist($book);
echo PHP_EOL, 'AFTER CALLING PERSIST ON BOOK ',PHP_EOL;

echo PHP_EOL, 'BEFORE CALLING FLUSH for Insert',PHP_EOL;
$em->flush();
echo PHP_EOL, 'AFTER CALLING FLUSH for Insert' ,PHP_EOL;

$author->setDeathDate(new \DateTime('-1day'));
$author->setLastName('TEST2');

echo PHP_EOL, 'BEFORE CALLING FLUSH for UPDATE',PHP_EOL;
$em->flush();
echo PHP_EOL, 'AFTER CALLING FLUSH for UPDATE',PHP_EOL;

$em->remove($author);
$em->remove($book);
echo PHP_EOL, 'BEFORE CALLING FLUSH for DELETE',PHP_EOL;
$em->flush();
echo PHP_EOL, 'AFTER CALLING FLUSH for DELETE',PHP_EOL;


// foreach($em->getRepository(Book::class)->findBy(['title'=>'TEST']) as $a){
//     $em->remove($a);
// }
// foreach($em->getRepository(Author::class)->findBy(['firstName'=>'TEST']) as $a){
//     $em->remove($a);
// }
// $em->flush();