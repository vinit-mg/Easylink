@isset($usersmenu)
@php
     $menuid = "";
@endphp
<ul class="sidebar-nav" id="sidebar-nav">
    @foreach($usersmenu as $menu)
        
        @php
            $menuclass = (request()->is(ltrim($menu['link'], '/'))) ? 'nav-link' :'collapsed';
            $areaexpend = false;
            $childclass = '';
            if(!$menu['children']->isEmpty()){
                foreach($menu['children'] as $child){
                    if(request()->is(ltrim($child['link'], '/'))){
                        $menuclass = 'nav-link';
                        $areaexpend =  true;
                        $childclass = 'show';
                        break;
                    }
                }
            }
        @endphp
        @if(!$menu['children']->isEmpty())
            @php
                // Convert to lowercase
            
                $string = strtolower($menu['name']);
                
                // Replace spaces and special characters with hyphens
                $string = preg_replace('/[^a-z0-9-_]/', '-', $string);
                
                // Ensure the ID starts with a letter or underscore
                if (!preg_match('/^[a-z_]/', $string)) {
                    $string = 'id-' . $string;
                }

                // Remove duplicate hyphens
                $string = preg_replace('/-+/', '-', $string);

                // Trim hyphens from the start and end
                $menuid = trim($string, '-');
               
            @endphp
        
        @endif
        <li class="nav-item">
            <a 
                href="{{ $menu['link'] }}" 
                class="{{ $menuclass }}  
                        nav-link  
                        @if(!$menu['children']->isEmpty()) nav-dropdown @endif
                "
                @if(!$menu['children']->isEmpty())
                    data-bs-target="#{{$menuid}}" 
                    data-bs-toggle="collapse"
                @endif
                aria-expanded = {{$areaexpend}}
            >
                @if($menu['icon'])
                    <x-admin.base-icon path="{{$menu['icon']}}" />
                @endif
                <span>{{ __($menu['name']) }}</span>
                @if(!$menu['children']->isEmpty())
                    <i class="bi bi-chevron-down ms-auto"></i>
                @endif
            </a>
            @if(!$menu['children']->isEmpty())
                <ul id={{$menuid}} class="nav-content collapse {{$childclass}}" data-bs-parent="#sidebar-nav">
                    @foreach($menu['children'] as $child)
                        <li>
                            <a href="{{ $child['link'] }}" class="{{ (request()->is(ltrim($child['link'], '/'))) ? 'active' : '' }}"><i class="bi bi-circle"></i><span>{{ $child['name'] }}</span></a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
@endisset
    