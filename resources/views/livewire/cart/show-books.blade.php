<div class="max-w-6xl mx-auto px-2 mt-8">
    <table class="table-fixed style-table w-full bg-white">
        <thead>
            <th>#</th>
            <th>الاسم</th>
            <th>السعر</th>
            <th>الكمية</th>
            <th>السعر الكلي</th>
            <th>الأوامر</th>
        </thead>
        <tbody>
            @php($i=0)
            @php($totalPrice = 0)
            @foreach($books as $book)
                @php($totalPrice += $book->price * $book->pivot->copies)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->price}}$</td>
                    <td>{{$book->pivot->copies}}</td>
                    <td>{{$book->pivot->copies * $book->price}}$</td>
                    <td class="text-center">
                        <div class="flex flex-col gap-y-2">
                            <span class="button bg-blue-500" wire:click="add({{$book->id}})">
                                إضافة واحد
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span class="button bg-orange-600" wire:click="minus({{$book->id}})">
                            إزالة واحد
                            <i class="fa-solid fa-minus"></i>
                        </span>
                            <span class="button bg-red-600" wire:click="delete({{$book->id}})">
                            حذف الكل
                            <i class="fa-solid fa-trash"></i>
                        </span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2 class="text-center text-xl font-bold my-2">إجمالي المبلغ: {{$totalPrice}}$</h2>
    <div class="container mx-auto my-6 flex justify-evenly">
        <div class="inline-block w-32" id="paypal-button-container"></div>
        <a class="block h-full button bg-yellow-500 w-fit px-4 py-2 rounded" href="{{route('show.stripe')}}">بطاقة ائتمانية
            <i class="fa-solid fa-credit-card"></i>
        </a>
    </div>
    @if(!empty($this->error))
        <p class="text-center max-w-4xl font-bold text-red-500">{{$this->error}}</p>
    @endif
    <x-slot:script>
        <script src="https://www.paypal.com/sdk/js?client-id={{config('paypal.'.config('paypal.mode').'.client_id')}}&currency={{config('paypal.currency')}}"></script>
        <script>
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return fetch('{{route('v'.config('paypal.version_api').'.create.order.paypal')}}', {
                        method: 'POST',
                        body:JSON.stringify({
                            'userId' : "{{auth()->user()->id}}",
                        }),
                        headers:{
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    }).then(function(res) {
                        return res.json();
                    }).then(function(orderData) {
                        return orderData.id;
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return fetch('{{route('v'.config('paypal.version_api').'.create.order.paypal')}}' , {
                        method: 'POST',
                        body :JSON.stringify({
                            orderId : data.orderID,
                            userId: "{{ auth()->user()->id }}",
                        }),
                        headers:{
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    }).then(function(res) {
                        return res.json();
                    }).then(function(orderData) {
                        Livewire.dispatch('setData', { title: "نجاح الدفع",description:"تمت عملية الدفع بنجاح" })
                        Livewire.dispatch('refreshCart')
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </x-slot:script>
</div>
