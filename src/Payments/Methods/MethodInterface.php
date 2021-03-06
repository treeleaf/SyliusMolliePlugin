<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusMolliePlugin\Payments\Methods;

use BitBag\SyliusMolliePlugin\Entity\MollieMethodImageInterface;

interface MethodInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function isEnabled(): bool;

    public function setEnabled(bool $enabled): void;

    public function getImage(): array;

    public function setImage(array $image): void;

    public function getMinimumAmount(): array;

    public function setMinimumAmount(array $minimumAmount): void;

    public function getMaximumAmount(): array;

    public function setMaximumAmount(array $maximumAmount): void;

    public function getPaymentType(): string;

    public function setPaymentType(string $paymentType): void;

    public function getCountry(): array;

    public function setCountry(array $country): void;

    public function isCanRefunded(): bool;

    public function setCanRefunded(bool $canRefunded): void;

    public function getIssuers(): array;

    public function setIssuers(array $issuers): void;
}
