<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DeliveryService
{
    public function sendToNovaPoshta($parcelData, $recipientData)
    {
        $response = Http::post('https://novaposhta.test/api/delivery', [
            'customer_name' => $recipientData['customer_name'],
            'phone_number' => $recipientData['phone_number'],
            'email' => $recipientData['email'],
            'sender_address' => config('app.sender_address'),
            'delivery_address' => $recipientData['delivery_address']
        ]);

        // Обработка ответа от сервера Новой почты

        if ($response->successful()) {
            return true; // или возврат полезных данных
        }

        return false; // или обработка ошибки
    }

    // Добавьте методы для отправки данных на другие курьерские службы (Укрпочта, Джастин и т.д.)
    public function sendToUkrPoshta($parcelData, $recipientData)
    {
        // Создать запрос к API Укрпочты
        $requestData = [
            'parcel' => [
                'width' => $parcelData['width'],
                'height' => $parcelData['height'],
                'length' => $parcelData['length'],
                'weight' => $parcelData['weight']
            ],
            'recipient' => [
                'customer_name' => $recipientData['customer_name'],
                'phone_number' => $recipientData['phone_number'],
                'email' => $recipientData['email'],
                'delivery_address' => $recipientData['delivery_address']
            ]
        ];

        // Дополнительные запросы или преобразования данных, если необходимо

        // Отправить запрос к API Укрпочты
        $response = Http::post('https://api.ukrposhta.ua/barcode', $requestData);

        // Обработка ответа от API Укрпочты

        if ($response->successful()) {
            return true; // или возврат полезных данных
        }

        return false; // или обработка ошибки
    }

    public function sendToJustin($parcelData, $recipientData)
    {
        // Создать запрос к API Justin
        $requestData = [
            'parcel' => [
                'width' => $parcelData['width'],
                'height' => $parcelData['height'],
                'length' => $parcelData['length'],
                'weight' => $parcelData['weight']
            ],
            'recipient' => [
                'customer_name' => $recipientData['customer_name'],
                'phone_number' => $recipientData['phone_number'],
                'email' => $recipientData['email'],
                'delivery_address' => $recipientData['delivery_address']
            ]
        ];

        // Дополнительные запросы или преобразования данных, если необходимо

        // Отправить запрос к API Justin
        $response = Http::post('https://api.justin.ua/delivery', $requestData);

        // Обработка ответа от API Justin

        if ($response->successful()) {
            return true; // или возврат полезных данных
        }

        return false; // или обработка ошибки
    }

    public function sendToCourier($parcelData, $recipientData, $courierName)
    {
        // Получить информацию о курьерской службе по ее имени
        $courierInfo = $this->getCourierInfo($courierName);

        // Создать запрос к API курьерской службы
        $requestData = [
            'parcel' => [
                'width' => $parcelData['width'],
                'height' => $parcelData['height'],
                'length' => $parcelData['length'],
                'weight' => $parcelData['weight']
            ],
            'recipient' => [
                'customer_name' => $recipientData['customer_name'],
                'phone_number' => $recipientData['phone_number'],
                'email' => $recipientData['email'],
                'delivery_address' => $recipientData['delivery_address']
            ]
        ];

        // Дополнительные запросы или преобразования данных, если необходимо

        // Отправить запрос к API курьерской службы
        $response = Http::post($courierInfo['api_url'], $requestData);

        // Обработка ответа от API курьерской службы

        if ($response->successful()) {
            return true; // или возврат полезных данных
        }

        return false; // или обработка ошибки
    }

    // и так далее
}
