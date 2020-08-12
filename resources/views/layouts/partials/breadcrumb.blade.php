{{--

# Breadcrumbs Blade Component
Componente responsavel pela criação dos breadcrumbs da pagina,
você pode definir uma lista ou um unico objeto.

Como usar:

    // Use como uma lista de breadcrumbs:
    @component('layouts.partials.breadcrumb')
        @slot('breadcrumbs', [
            ['name' => 'cliente', 'link' => '/painel/cliente'],
            ['name' => 'cadastrar', 'link' => '/painel/cadastrar']
        ])
    @endcomponent

    // Use como um unico breadcrumb:
    @component('layouts.partials.breadcrumb')
        @slot('breadcrumb',[
        'name' => 'cliente',
        'link' => '/painel/cliente'
        ])
    @endcomponent

--}}
@if(!empty($breadcrumbs))
    {{-- $breadcrumbs = [ [ 'name' => 'home', 'link' => '/home' ] ] --}}
    @foreach($breadcrumbs as $breadcrumb)
        @push('breadcrumb-stack')
            <li class="breadcrumb-item">
                @if(!empty($breadcrumb['link']))
                    <a href="{!! $breadcrumb['link'] ?? '#' !!}">{!! $breadcrumb['name'] ?? '' !!}</a>
                @else
                    {!! $breadcrumb['name'] ?? '' !!}
                @endif
            </li>
        @endpush
    @endforeach
@else
    {{-- $breadcrumb = [ 'name' => 'home', 'link' => '/home' ] --}}
    @push('breadcrumb-stack')
        <li class="breadcrumb-item">
            @if(!empty($breadcrumb['link']))
                <a href="{!! $breadcrumb['link'] ?? '#' !!}">{!! $breadcrumb['name'] ?? '' !!}</a>
            @else
                {!! $breadcrumb['name'] ?? '' !!}
            @endif
        </li>
    @endpush
@endif
