<!-- delivery-form.blade.php -->

<form action="/send-delivery-data" method="POST">
    @csrf

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 12px;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>

    <div class="form-group">
        <label for="courier">Выберите курьерскую службу:</label>
        <select name="courier" id="courier">
            <option value="nova_poshta">Новая почта</option>
            <option value="ukr_poshta">Укрпочта</option>
            <option value="courier">Другая курьерская служба</option>
        </select>
    </div>

    <div class="form-group">
        <label for="width">Ширина:</label>
        <input type="text" name="width" id="width" required>
    </div>

    <div class="form-group">
        <label for="height">Высота:</label>
        <input type="text" name="height" id="height" required>
    </div>

    <div class="form-group">
        <label for="length">Длина:</label>
        <input type="text" name="length" id="length" required>
    </div>

    <div class="form-group">
        <label for="weight">Вес:</label>
        <input type="text" name="weight" id="weight" required>
    </div>

    <div class="form-group">
        <label for="customer_name">ФИО получателя:</label>
        <input type="text" name="customer_name" id="customer_name" required>
    </div>

    <div class="form-group">
        <label for="phone_number">Номер телефона получателя:</label>
        <input type="text" name="phone_number" id="phone_number" required>
    </div>

    <div class="form-group">
        <label for="email">Email получателя:</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="delivery_address">Адрес доставки:</label>
        <input type="text" name="delivery_address" id="delivery_address" required>
    </div>

    <button type="submit">Отправить</button>
</form>
