<?php

namespace App\Http\Controllers;

use App\Services\DeliveryService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    private $deliveryService;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    public function sendDeliveryData(Request $request)
    {
        $parcelData = $request->only(['width', 'height', 'length', 'weight']);
        $recipientData = $request->only(['customer_name', 'phone_number', 'email', 'delivery_address']);

        // Отправка данных на курьерскую службу Новая почта
        $resultNovaPoshta = $this->deliveryService->sendToNovaPoshta($parcelData, $recipientData);
        if ($resultNovaPoshta) {
            return response()->json(['message' => 'Данные успешно отправлены на сервер Новой почты']);
        }

        // Отправка данных на курьерскую службу Укрпочта
        $resultUkrPoshta = $this->deliveryService->sendToUkrPoshta($parcelData, $recipientData);
        if ($resultUkrPoshta) {
            return response()->json(['message' => 'Данные успешно отправлены на сервер Укрпочты']);
        }

        // Отправка данных на другую курьерскую службу
        $courierName = 'courier_name';
        $resultCourier = $this->deliveryService->sendToCourier($parcelData, $recipientData, $courierName);
        if ($resultCourier) {
            return response()->json(['message' => 'Данные успешно отправлены на сервер курьерской службы']);
        }

        return response()->json(['error' => 'Произошла ошибка при отправке данных на сервер курьерской службы'], 500);
    }
}

