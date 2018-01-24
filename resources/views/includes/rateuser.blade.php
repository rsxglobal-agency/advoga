 @if (Auth::user()->rate >=1 )
    <span><i class="icon_star"></i></span>
    @else 
    <span><i class="icon_star_alt"></i></span>
    @endif

    @if (Auth::user()->rate >=2 )
    <span><i class="icon_star"></i></span>
    @else 
    <span><i class="icon_star_alt"></i></span>
    @endif
    
    @if (Auth::user()->rate >=3 )
    <span><i class="icon_star"></i></span>
    @else 
    <span><i class="icon_star_alt"></i></span>
    @endif
    
    @if (Auth::user()->rate >=4 )
    <span><i class="icon_star"></i></span>
    @else 
    <span><i class="icon_star_alt"></i></span>
    @endif
    
    @if (Auth::user()->rate >=5 )
    <span><i class="icon_star"></i></span>
    @else 
    <span><i class="icon_star_alt"></i></span>
    @endif
  </div>