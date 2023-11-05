@if(isset($hijo['hijos']) && count($hijo['hijos']) > 0)
    @foreach($hijo['hijos'] as $subhijo)
        <th>{{ $subhijo['nombre'] }}</th>
        @include('subheader', ['hijo' => $subhijo])
    @endforeach
@endif
