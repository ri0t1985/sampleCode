<?php

namespace Erik\Sample\Controller;

use Erik\Sample\Supplier\Service\Exception\OrderFailedException;
use Erik\Sample\Supplier\Service\ValueObjects\OrderRequest;
use Erik\Sample\Supplier\SupplierFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

final class OrderController
{
    /** @var SupplierFactory */
    private $supplierFactory;

    /**
     * @param SupplierFactory $supplierFactory
     */
    public function __construct(SupplierFactory $supplierFactory)
    {
        $this->supplierFactory = $supplierFactory;
    }

    /**
     * @param string|null $brandName
     * @return JsonResponse
     */
    public function placeOrder(?string $brandName = null): JsonResponse
    {
        try {
            $orderService = $this->supplierFactory->getOrderServiceByBrandName($brandName);
            $orderRequest = new OrderRequest();
            $orderRequest
                ->setProductNumber('P1231231')
                ->setCustomerNumber('C12314511')
                ->setQuantity(12);
            $result = $orderService->placeOrder($orderRequest);

        } catch (OrderFailedException $ex) {
            return new JsonResponse(
                [
                    'result' => false,
                    'message' => $ex->getMessage(),
                ],
                JsonResponse::HTTP_BAD_REQUEST);
        } catch (\InvalidArgumentException $ex) {
            return new JsonResponse(
                [
                    'result' => false,
                    'message' => $ex->getMessage(),
                ],
                JsonResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $ex) {
            return new JsonResponse(
                [
                    'result' => false,
                    'message' => $ex->getMessage(),
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }


        return new JsonResponse(
            [
                'result' => true,
                'message' => 'Order successfully placed',
                'orderNr' => $result->getOrderNr(),
            ],
            JsonResponse::HTTP_ACCEPTED);
    }
}
