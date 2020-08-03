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
use Sylius\Component\Resource\Model\ResourceInterface;

interface RecurringPaymentInterface extends ResourceInterface
{
    const STATE_NEW = 'new';
    const STATE_ACTIVE = 'active';
    const STATE_UNKNOWN = 'unknown';

    /**
     * @return CustomerInterface|null
     */
    public function getCustomer(): ?CustomerInterface;

    /**
     * @param CustomerInterface|null $customer
     */
    public function setCustomer(?CustomerInterface $customer): void;

    /**
     * @return string|null
     */
    public function getMollieCustomerId(): ?string;

    /**
     * @param string|null $customerId
     */
    public function setMollieCustomerId(?string $customerId): void;

    /**
     * @return string
     */
    public function getState(): string;

    /**
     * @param string $state
     */
    public function setState(string $state): void;
}
