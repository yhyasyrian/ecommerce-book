<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h1 {
            width: 100%;
            color: #333;
            text-align: right;
        }

        p {
            width: 100%;
            text-align: right;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: right;
        }

        th {
            background-color: #f2f2f2;
        }
        main {
            margin: 10px;
            padding: 2px;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
<main>
    <h1>{{config('app.name')}}</h1>
    <p>مرحباً {{$user->name}}، لديك طلب مكتمل وهذه تفاصيل هذا الطلب:</p>

    <table>
        <tr>
            <th>الكتاب</th>
            <th>الكمية</th>
            <th>سعر الواحد</th>
            <th>إجمالي السعر</th>
        </tr>
        @foreach($user->booksInCart()->get() as $book)
            <tr>
                <td>{{$book->title}}</td>
                <td>{{$book->pivot->copies}}</td>
                <td>{{$book->price}}$</td>
                <td>{{$book->pivot->price}}$</td>
            </tr>
        @endforeach
    </table>
</main>
</body>
</html>
