
@if (is_string($item))
  @if(auth()->user()->tipo == 0)
    <li class="header">{{ $item }}</li>
  @elseif (auth()->user()->tipo == 1)
    @if ($item == 'INICIO' || $item == 'MENU DE TRAMITES')
        <li class="header">{{ $item }}</li>
    @endif
  @elseif (auth()->user()->tipo == 2)
    @if ($item == 'INICIO' || $item == 'MENU DE TRAMITES')
        <li class="header">

          @if ($item == 'MENU DE TRAMITES')
            <?php echo "MESA DE PARTES"; ?>
          @else
            {{$item}}
          @endif
        </li>
    @endif
  @endif

@else


      <!--   ********************************-->
      <!--       MENU DE ADMINSITRADOR       -->
      <!--   ********************************-->

    @if(auth()->user()->tipo == 0)
      <li class="{{ $item['class'] }}">
          <a href="{{ $item['href'] }}"
             @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
          >
              <i class="fa fa-fw fa-{{ isset($item['icon']) ? $item['icon'] : 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
              <span>{{ $item['text'] }}</span>
              @if (isset($item['label']))
                  <span class="pull-right-container">
                      <span class="label label-{{ isset($item['label_color']) ? $item['label_color'] : 'primary' }} pull-right">{{ $item['label'] }}</span>
                  </span>
              @elseif (isset($item['submenu']))
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
              @endif
          </a>
          @if (isset($item['submenu']))
              <ul class="{{ $item['submenu_class'] }}">
                  @each('adminlte::partials.menu-item', $item['submenu'], 'item')
              </ul>
          @endif
      </li>


    <!--   ********************************-->
    <!--   MENU DE TRABAJADORES EN EL AREAS-->
    <!--   ********************************-->
    @elseif (auth()->user()->tipo == 1)
      @if ($item['text'] == 'Inicio' || $item['text'] == 'Documentos')

            <li class="{{ $item['class'] }}">
                <a href="{{ $item['href'] }}"
                   @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
                >
                    <i class="fa fa-fw fa-{{ isset($item['icon']) ? $item['icon'] : 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                    <span>{{ $item['text'] }}</span>
                    @if (isset($item['label']))
                        <span class="pull-right-container">
                            <span class="label label-{{ isset($item['label_color']) ? $item['label_color'] : 'primary' }} pull-right">{{ $item['label'] }}</span>
                        </span>
                    @elseif (isset($item['submenu']))
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    @endif
                </a>
                @if (isset($item['submenu']))
                    <ul class="{{ $item['submenu_class'] }}">
                        @each('adminlte::partials.menu-item', $item['submenu'], 'item')
                    </ul>
                @endif
            </li>
      @endif


          <!--   ********************************-->
          <!--   MENU DE MESA DE PARTES-->
          <!--   ********************************-->

    @elseif (auth()->user()->tipo == 2)
      @if ($item['text'] == 'Inicio' || $item['text'] == 'Documentos')

            <li class="{{ $item['class'] }}">
                <a href="{{ $item['href'] }}"
                   @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
                >
                    <i class="fa fa-fw fa-{{ isset($item['icon']) ? $item['icon'] : 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                    <span>
                    @if ($item['text'] == 'Documentos')
                      <?php echo "Mesa de partes"; ?>
                    @else
                      {{$item['text']}}
                    @endif

                    </span>
                    @if (isset($item['label']))
                        <span class="pull-right-container">
                            <span class="label label-{{ isset($item['label_color']) ? $item['label_color'] : 'primary' }} pull-right">{{ $item['label'] }}</span>
                        </span>
                    @elseif (isset($item['submenu']))
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    @endif
                </a>
                @if (isset($item['submenu']))
                    <ul class="{{ $item['submenu_class'] }}">
                        @each('adminlte::partials.menu-item', $item['submenu'], 'item')
                    </ul>
                @endif
            </li>
      @endif
    @endif

@endif
