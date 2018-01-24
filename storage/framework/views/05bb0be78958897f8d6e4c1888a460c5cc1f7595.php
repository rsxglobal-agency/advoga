 <?php if(Auth::user()->rate >=1 ): ?>
    <span><i class="icon_star"></i></span>
    <?php else: ?> 
    <span><i class="icon_star_alt"></i></span>
    <?php endif; ?>

    <?php if(Auth::user()->rate >=2 ): ?>
    <span><i class="icon_star"></i></span>
    <?php else: ?> 
    <span><i class="icon_star_alt"></i></span>
    <?php endif; ?>
    
    <?php if(Auth::user()->rate >=3 ): ?>
    <span><i class="icon_star"></i></span>
    <?php else: ?> 
    <span><i class="icon_star_alt"></i></span>
    <?php endif; ?>
    
    <?php if(Auth::user()->rate >=4 ): ?>
    <span><i class="icon_star"></i></span>
    <?php else: ?> 
    <span><i class="icon_star_alt"></i></span>
    <?php endif; ?>
    
    <?php if(Auth::user()->rate >=5 ): ?>
    <span><i class="icon_star"></i></span>
    <?php else: ?> 
    <span><i class="icon_star_alt"></i></span>
    <?php endif; ?>
  </div>