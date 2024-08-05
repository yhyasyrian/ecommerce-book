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
            @foreach($options as $option)
                @php([$value,$title] = $option)
                <option value="{{$value}}"
                        @if(in_array($value,$optionSelected))
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
            >{{$oldData}}</textarea>
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
            "autocomplete"=>($type != 'password') ? $name : 'false',
            'value'=>($type != 'password') ? $oldData : '',
            ...$otherAttributes
            ])}}
        >
    @endif
    @error($name)
    <small class="form-text font-weight-bold text-danger">{{$message}}</small>
    @enderror
</div>
