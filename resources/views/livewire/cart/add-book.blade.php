<div class="mt-8 flex flex-row gap-x-6 items-center">
    <label for="" class="block font-bold text-lg">إضافة للسلة:</label>
    <div class="w-fit">
        <x-input class="p-1 w-32" wire:model="copies" min="0" step="1" type="number" max="100" />
        <p class="font-medium text-red-600 w-full block">{{$this->error}}</p>
    </div>
    <button class="bg-green-400 text-white px-6 py-1 rounded transition ease-linear hover:bg-green-500 border-2 border-transparent hover:border-green-700 font-bold"
        wire:click="addToCart"
    >
        إضافة للسلة
        <i class="fa-solid fa-cart-plus"></i>
    </button>
</div>
