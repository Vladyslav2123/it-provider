<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Нова заявка на підключення</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1a56db;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Нова заявка на підключення</h1>
    </div>
    
    <div class="content">
        <p>Отримано нову заявку на підключення від клієнта:</p>
        
        <div class="info-item">
            <span class="label">ПІБ:</span> {{ $connectionRequest->name }}
        </div>
        
        <div class="info-item">
            <span class="label">Email:</span> {{ $connectionRequest->email }}
        </div>
        
        <div class="info-item">
            <span class="label">Телефон:</span> {{ $connectionRequest->phone }}
        </div>
        
        <div class="info-item">
            <span class="label">Адреса:</span> {{ $connectionRequest->address }}
        </div>
        
        @if($connectionRequest->tariff)
        <div class="info-item">
            <span class="label">Обраний тариф:</span> {{ $connectionRequest->tariff->name }} ({{ $connectionRequest->tariff->price }} грн/{{ $connectionRequest->tariff->period }})
        </div>
        @endif
        
        @if($connectionRequest->message)
        <div class="info-item">
            <span class="label">Додаткова інформація:</span>
            <p>{{ $connectionRequest->message }}</p>
        </div>
        @endif
        
        <div class="info-item">
            <span class="label">Дата заявки:</span> {{ $connectionRequest->created_at->format('d.m.Y H:i') }}
        </div>
    </div>
    
    <div class="footer">
        <p>Це автоматичне повідомлення, будь ласка, не відповідайте на нього.</p>
    </div>
</body>
</html>
