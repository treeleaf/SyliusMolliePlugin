<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusMolliePlugin\Action\Api;

use BitBag\SyliusMolliePlugin\Entity\RecurringPaymentInterface;
use BitBag\SyliusMolliePlugin\Request\Api\CreateRecurringPayment;
use BitBag\SyliusMolliePlugin\Request\Api\CreateRecurringRecurringPayment;
use BitBag\SyliusMolliePlugin\Request\StateMachine\StatusRecurringRecurringPayment;
use Doctrine\ORM\EntityManagerInterface;
use Mollie\Api\Resources\Customer;
use Mollie\Api\Resources\RecurringPayment;
use Mollie\Api\Types\MandateMethod;
use Payum\Core\Action\ActionInterface;
use Payum\Core\ApiAwareInterface;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\GatewayAwareInterface;
use Payum\Core\GatewayAwareTrait;
use SM\Factory\FactoryInterface as SateMachineFactoryInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class CreateRecurringPaymentAction extends BaseApiAwareAction implements ActionInterface, GatewayAwareInterface, ApiAwareInterface
{
    use GatewayAwareTrait;

    /**
     * @var FactoryInterface
     */
    private $recurringPaymentFactory;

    /**
     * @var EntityManagerInterface
     */
    private $recurringPaymentManager;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @param FactoryInterface $recurringPaymentFactory
     * @param EntityManagerInterface $recurringPaymentManager
     * @param SateMachineFactoryInterface $recurringPaymentSateMachineFactory
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        FactoryInterface $recurringPaymentFactory,
        EntityManagerInterface $recurringPaymentManager,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->recurringPaymentFactory = $recurringPaymentFactory;
        $this->recurringPaymentManager = $recurringPaymentManager;
        $this->orderRepository = $orderRepository;
    }

    /**
     * {@inheritdoc}
     *
     * @param CreateRecurringRecurringPayment $request
     */
    public function execute($request): void
    {
        RequestNotSupportedException::assertSupports($this, $request);

        $model = ArrayObject::ensureArrayObject($request->getModel());

        if (false === isset($model['customer_mollie_id'])) {
            return;
        }

        /** @var Customer $customer */
        $customer = $this->mollieApiClient->customers->get($model['customer_mollie_id']);

        /** @var RecurringPaymentInterface $recurringPayment */
        $recurringPayment = $this->recurringPaymentFactory->createNew();

        /** @var OrderInterface $order */
        $order = $this->orderRepository->find($model['metadata']['order_id']);

        $recurringPayment->setMollieCustomerId($model['customer_mollie_id']);
        $recurringPayment->setCustomer($order->getCustomer());

        $this->recurringPaymentManager->persist($recurringPayment);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($request): bool
    {
        return
            $request instanceof CreateRecurringPayment &&
            $request->getModel() instanceof \ArrayAccess
        ;
    }
}
