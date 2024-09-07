<x-app-layout>
    <x-slot:head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </x-slot:head>
    <x-slot:header>
        الدفع بإستخدام بطاقة ائتمانية
    </x-slot:header>
    <div class="container mx-auto mt-8">
        <div class="flex justify-center">
            <div class="w-full md:w-1/2">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="border-b pb-4 mb-4">
                        <h2 class="text-lg font-semibold">معلومات الدفع</h2>
                    </div>
                    <div>
                        @if (Session::has('success'))
                            <div class="bg-green-100 text-green-700 text-center p-4 mb-4 rounded relative">
                                <button class="close text-lg absolute top-1 right-2" onclick="this.parentElement.style.display='none'">
                                    &times;
                                </button>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                            @if (Session::has('fail'))
                                <div class="bg-red-100 text-red-700 text-center p-4 mb-4 rounded relative">
                                    <button class="close text-lg absolute top-1 right-2" onclick="this.parentElement.style.display='none'">
                                        &times;
                                    </button>
                                    <p>{{ Session::get('fail') }}</p>
                                </div>
                            @endif
                        <form id='checkout-form' method='post' action="{{ route('store.stripe') }}">
                            @csrf
                            <input type='hidden' name='stripeToken' id='stripe-token-id'>
                            <br>
                            <div id="card-element"
                                 class="form-control p-3 border border-gray-300 rounded-md mb-4"></div>
                            <button
                                id='pay-btn'
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded w-full"
                                type="button"
                                onclick="createToken()">دفع {{$price}}$
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot:script>
        <script src="https://js.stripe.com/v3/"></script>
        <script type="text/javascript">
                var stripe = Stripe('{{ config('cashier.key') }}')
                var elements = stripe.elements();
                var cardElement = elements.create('card');
                cardElement.mount('#card-element');

                /*------------------------------------------
                --------------------------------------------
                Create Token Code
                --------------------------------------------
                --------------------------------------------*/
                function createToken() {
                    document.getElementById("pay-btn").disabled = true;
                    stripe.createToken(cardElement).then(function(result) {

                        if (typeof result.error != 'undefined') {
                            document.getElementById("pay-btn").disabled = false;
                            alert(result.error.message);
                        }

                        /* creating token success */
                        if (typeof result.token != 'undefined') {
                            document.getElementById("stripe-token-id").value = result.token.id;
                            document.getElementById('checkout-form').submit();
                        }
                    });
                }
        </script>
    </x-slot:script>
</x-app-layout>
