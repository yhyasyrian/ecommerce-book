<div
    @class(['shadow-lg border rounded-md fixed top-10 start-10 z-[9999] py-4 w-96 ps-2 bg-white pt-4','hidden'=>empty($this->title),'animate-[top-to-down_1s_linear]'=>!empty($this->title)])
    data-alert-toggle="{{!empty($this->title)}}"
>
    <h2 class="mb-2 font-bold">{{$this->title}}</h2>
    <p class="leading-6 text-gray-600 font-medium">{{$this->description}}</p>
    <span class="absolute top-1/2 -translate-y-1/2 end-4 leading-0">
        <i class="fa-solid fa-check text-green-500 border-2 border-green-500 p-1 rounded-full"></i>
    </span>
    <span class="hidden close" wire:click="hiddenValue">s</span>
</div>
