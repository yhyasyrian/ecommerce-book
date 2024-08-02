<div class="form-group">
    <label for="{{$name}}" class="font-weight-bold">{{$label}}:</label>
    @if($type === "select")
        <select
            class="form-control {{$attributes->get('class')}} @error($name) is-invalid @enderror"
            {{
        $attributes->merge([
            'id'=>$name,
            'name'=>(in_array('multiple',array_keys($otherAttributes)) ? $name.'[]' : $name),
            "placeholder"=>$label,
            "aria-placeholder"=>$label,
            "autocomplete"=>$name,
            ...$otherAttributes
            ])}}
            >
            @php($lastSelected = old($name))
            @foreach($options as $option)
                @php([$value,$title] = $option)
                <option value="{{$value}}"
                        @if(is_string($lastSelected) and $lastSelected === $value or
                            is_array($lastSelected) and in_array($value,[...old($name)]))
                            selected
                    @endif
                >{{$title}}</option>
            @endforeach
        </select>
    @elseif($type === "textarea")
        <textarea
            class="form-control {{$attributes->get('class')}} @error($name) is-invalid @enderror"
            {{$attributes->merge([
            'id'=>$name,
            'name'=>$name,
            "placeholder"=>$label,
            "aria-placeholder"=>$label,
            "autocomplete"=>$name,
            ...$otherAttributes
            ])}}
            >{{old($name)}}</textarea>
    @else
        <input
            class="form-control {{$attributes->get('class')}} @error($name) is-invalid @enderror"
            {{
        $attributes->merge([
            'type'=>$type,
            'id'=>$name,
            'name'=>$name,
            "placeholder"=>$label,
            "aria-placeholder"=>$label,
            "autocomplete"=>$name,
            'value'=>old($name),
            ...$otherAttributes
            ])}}
        >
    @endif
    @error($name)
    <small class="form-text font-weight-bold text-danger">{{$message}}</small>
    @enderror
</div>
