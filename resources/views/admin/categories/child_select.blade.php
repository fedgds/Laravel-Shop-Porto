@if(isset($children) && count($children) > 0)
    @foreach($children as $child)
        <option value="{{ $child->id }}">{{ $prefix }} {{ $child->name }}</option>
        @if(count($child->childrenRecursive) > 0)
            @include('admin.categories.child_select', ['children' => $child->childrenRecursive, 'prefix' => $prefix . '---'])
        @endif
    @endforeach
@endif
