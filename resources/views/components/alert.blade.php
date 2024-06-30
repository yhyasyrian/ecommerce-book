@php
$colors = match($type ?? ""){
    "error"=> "bg-red-600 text-white",
    "success"=> "bg-green-600 text-white",
    default => "bg-orange-600 text-white"
};
@endphp
<div {{$attributes->merge(['class'=>"p-4 w-3/4 mx-auto rounded-md relative {$colors}"])}}>
    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xl cursor-pointer remove-paren-when-click">
        <i class="fa-solid fa-close"></i>
    </span>
    {{$slot}}
</div>
