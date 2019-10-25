<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusMolliePlugin\Repository;

use BitBag\SyliusMolliePlugin\Entity\RecurringPaymentInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class RecurringPaymentRepository extends EntityRepository implements RecurringPaymentRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findOneByOrderId($orderId): ?RecurringPaymentInterface
    {
        return $this->createQueryBuilder('r')
            ->where('r.order = :orderId')
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByCustomerId($customerId): ?RecurringPaymentInterface
    {
        return $this->createQueryBuilder('r')
            ->innerJoin('r.order', 'o', 'WITH', 'r.order_id = o.id')
            ->innerJoin('o.customer', 'c', 'WITH', 'o.customer_id = c.id')
            ->where('c.id = :customerId')
            ->setParameter('customerId', $customerId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
