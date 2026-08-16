<div class="header-navi">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark p-0">
            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbarNav" aria-controls="mainNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Items -->
            <div class="collapse navbar-collapse" id="mainNavbarNav">
                <ul class="navbar-nav mr-auto">
                    <!-- Home -->
                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{ url('/') }}" class="nav-link font-weight-bold">
                            <i class="fa fa-home mr-1"></i> Home
                        </a>
                    </li>

                    <!-- Dynamic Categories from Database -->
                    @if(isset($globalCategories) && $globalCategories->count() > 0)
                        @foreach($globalCategories as $cat)
                            @if($cat->subCategories && $cat->subCategories->count() > 0)
                                <li class="nav-item dropdown {{ request()->is('product-category/' . $cat->slug . '*') ? 'active' : '' }}">
                                    <a href="{{ route('category.show', $cat->slug) }}" class="nav-link dropdown-toggle font-weight-bold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $cat->name }}
                                    </a>
                                    <div class="dropdown-menu shadow">
                                        <a class="dropdown-item font-weight-bold text-primary" href="{{ route('category.show', $cat->slug) }}">
                                            All {{ $cat->name }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        @foreach($cat->subCategories as $sub)
                                            <a class="dropdown-item" href="{{ route('category.show', ['category' => $cat->slug, 'subcategory' => $sub->slug]) }}">
                                                {{ $sub->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </li>
                            @else
                                <li class="nav-item {{ request()->is('product-category/' . $cat->slug . '*') ? 'active' : '' }}">
                                    <a href="{{ route('category.show', $cat->slug) }}" class="nav-link font-weight-bold">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif

                    <!-- Promo Highlight Nav -->
                    <li class="nav-item special-nav">
                        <a href="{{ route('category.show', 'fashion-women') }}" class="nav-link">
                            Celebration <span class="badge badge-warning text-dark ml-1">New</span>
                        </a>
                    </li>
                </ul>

                <!-- Phone Hotline -->
                <div class="navbar-hotline d-none d-xl-flex align-items-center text-white">
                    <i class="fa fa-phone mr-2 text-warning" style="font-size: 18px;"></i>
                    <span>Hotline: <strong>{{ $globalSetting->phone ?? '+8801700000000' }}</strong></span>
                </div>
            </div>
        </nav>
    </div>
</div>
