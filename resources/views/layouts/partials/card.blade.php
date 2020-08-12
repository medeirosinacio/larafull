{{--

# Card Bootstrap Template

bol $header - Define se o card tera um cabeçalho
bol $footer -Define se o card tera um rodape
string $color - cor do detahle do card ['primary', 'danger', ...]
string $title - titulo do card
array header_btn - array com informações dos botoes do cabeçalho,
                   o array pode conter ['name', 'link', 'icon', 'submenu' =>  ['name', 'link', 'icon']]

Como usar:
 @include('layouts.partials.card', [
         ...
        'header' => true,
        'color' => 'info',
        'title' => 'title da box 3',
        'header_buttons' => [
            [
                'name' => 'Editar',
                'icon' => 'fas fa-pencil-alt',
                'submenu' => [
                    [
                        'name' => 'Editar menu a',
                        'icon' => 'fas fa-pencil-alt',
                        'link' => 'painel/a'
                    ],
                 ],
            ],
        ],
        ...
    ])
--}}

<div class="card card-outline card-{{ $color ?? "primary" }}">
    @if(!empty($header ?? true))
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? ''}}</h3>
            <div class="card-tools custom {{ $btn['color'] ?? "primary" }}">
                @if(!empty($header_buttons ?? false))
                    <div class="btn-group">
                        @foreach($header_buttons as $btn)
                            @if(empty($btn['submenu']))
                                <button type="button"
                                        title="{{$btn['name'] ?? ''}}"
                                        onclick="location.href='/{{$btn['link'] ?? ''}}';"
                                        class="btn btn-{{ $btn['color'] ?? "primary" }} {{ $btn['class'] ?? "" }}">
                                    {!! $btn['icon'] ? "<i class='{$btn['icon']} fa-xs mr-1'></i>" : "" !!}
                                    {{$btn['name'] ?? ''}}
                                </button>
                            @else
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-{{ $btn['color'] ?? "primary" }} dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-expanded="false">
                                        {!! $btn['icon'] ? "<i class='{$btn['icon']} fa-xs mr-1'></i>" : "" !!}
                                        {{$btn['name'] ?? ''}} <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach($btn['submenu'] as $sub_btn)
                                            <li>
                                                <a href="/{{ $sub_btn['link'] ?? "" }}"
                                                   class="{{ $sub_btn['class'] ?? "" }}"
                                                   title="{{$sub_btn['name'] ?? ''}}"
                                                >
                                                    {!! $btn['icon'] ? "<i class='{$btn['icon']} fa-xs mr-1'></i>" : "" !!}
                                                    {{$sub_btn['name'] ?? ''}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- /.card-tools -->
        </div>
    @endif

<!-- /.card-header -->
    <div class="card-body">
        {{ $content ?? "" }}
        <div class="clearfix"></div>
    </div>
    <!-- /.card-body -->
    @if(!empty($footer ?? false))
        <div class="card-footer">
            {{ $content_footer ?? "" }}
        </div>
@endif
<!-- /.card-footer -->
</div>
