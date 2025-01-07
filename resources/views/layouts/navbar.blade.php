<nav class="navbar navbar-expand-lg" style="background-color: #0F172A">
    <div class="container-fluid">


        <div class="home-content">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="d-flex">
            <div class="btn-group mb-1">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                @if (App::getLocale() == 'ar')
                {{ LaravelLocalization::getCurrentLocaleName() }}
                <img src="{{ URL::asset('assets/flags/EG.png') }}" alt="">
                @else
                {{ LaravelLocalization::getCurrentLocaleName() }}
                <img src="{{ URL::asset('assets/flags/US.png') }}" alt="">
                @endif
                </button>
                <div class="dropdown-menu">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                    @endforeach
                </div>
            </div>
            <i class="fa-solid fa-bell bell_icon"></i>
            <div id="notifications_count">
            @if (auth()->user()->unreadNotifications->count()>0)
            <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="left: 35px;" >
                {{auth()->user()->unreadNotifications->count() }}
                <span class="visually-hidden">unread messages</span>
            </span>
            @endif
        </div>

            <div class="notification">
                <div id="unreadNotifications">
                    @foreach (auth()->user()->unreadNotifications as $notification)
                        <div class="Message">
                            <div class="Message-icon">
                                <i class="fa-solid fa-bell"></i>
                            </div>
                            <div class="Message-body">
                                <a href="{{ url('InvoiceDetail') }}/{{ $notification->data['id'] }}">
                                    <h5>
                                        {{ $notification->data['title'] }}
                                        {{ $notification->data['user'] }}
                                    </h5>
                                </a>
                            </div>
                            <button class="Message-close js-messageClose"><i class="fa fa-times"></i></button>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</nav>
