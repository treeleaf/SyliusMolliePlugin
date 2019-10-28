<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusMolliePlugin\Entity;

use Sylius\Component\Core\Model\CustomerInterface;

class RecurringPayment implements RecurringPaymentInterface
{
    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var CustomerInterface|null
     */
    protected $customer;

    /**
     * @var string|null
     */
    protected $mollieCustomerId;

    /**
     * @var string
     */
    protected $state = RecurringPaymentInterface::STATE_NEW;

    /**
     * {@inheritdoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomer(): ?CustomerInterface
    {
        return $this->customer;
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomer(?CustomerInterface $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * {@inheritdoc}
     */
    public function getMollieCustomerId(): ?string
    {
        return $this->mollieCustomerId;
    }

    /**
     * {@inheritdoc}
     */
    public function setMollieCustomerId(?string $mollieCustomerId): void
    {
        $this->mollieCustomerId = $mollieCustomerId;
    }
}
