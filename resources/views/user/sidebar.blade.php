<div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
    <div class="card mb-5 mb-xl-8">
        <div class="card-body pt-15">
            <div class="d-flex flex-center flex-column mb-5">
                <div class="symbol symbol-100px symbol-circle mb-7">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                    </svg>
                </div>
                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1"> {{ auth()->user()->name }} </a>
                <div class="fs-5 fw-semibold text-muted mb-6"> {{ auth()->user()->email }} </div>
            </div>
            <div class="d-flex flex-stack fs-4 py-3">
                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_customer_view_details" role="button" aria-expanded="false" aria-controls="kt_customer_view_details"> Details
                    <span class="ms-2 rotate-180">
                        <span class="svg-icon svg-icon-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                            </svg>
                        </span>
                    </span>
                </div>
                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Add the events">
                    <button type="button" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_event">
                        <span class="svg-icon svg-icon-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        Add event
                    </button>
                </span>
            </div>
            <div class="separator separator-dashed my-3"></div>
            <div id="kt_customer_view_details" class="collapse show">
                <div class="py-5 fs-6">
                    <div class="text-gray-400 fw-bold mt-5">Total Wealth</div>
                    <h1 class="mt-2 display-5"> ${{ number_format($totalWealth) }} </h1>
                </div>
            </div>
            <div class="separator separator-solid border-success my-6"></div>
            <div id="kt_table_clients_events">
                @foreach($wealthEvents as $wealthEvent)
                    <div class="m-0">
                        @if($wealthEvent->eventName != null)
                            <div class="d-flex flex-stack mb-5">
                                <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                    <div class="me-5">
                                        <h4 class="fw-bold m-0 mb-2 text-primary"><a href="" data-bs-toggle="modal" data-bs-target="#kt_modal_add_event">{{ $wealthEvent->eventName }}</a></h4>
                                    </div>
                                    <div class="d-flex">
                                        <div class="text-gray-600">CAD ${{ $wealthEvent->event_budget }}</div>
                                    </div>
                                </div>
                            </div>                                                
                        @endif
                        @if($wealthEvent->event_start_year != null && $wealthEvent->event_end_year)
                            <div class="d-flex flex-stack">
                                <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                    <div class="me-5">
                                        <div class="text-gray-800 fw-bold fs-6">Start Year to End Year</div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="text-gray-600">{{ $wealthEvent->event_start_year }} - {{ $wealthEvent->event_end_year }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($wealthEvent->interest != null)
                            <div class="d-flex flex-stack">
                                <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                    <div class="me-5">
                                        <div class="text-gray-800 fw-bold fs-6">Interest</div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="text-gray-600">{{ $wealthEvent->interest }}%</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($wealthEvent->rate_return != null)
                            <div class="d-flex flex-stack">
                                <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                    <div class="me-5">
                                        <div class="text-gray-800 fw-bold fs-6">Return Rate</div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="text-gray-600">{{ $wealthEvent->rate_return }}%</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($wealthEvent->down_payment != null)
                            <div class="d-flex flex-stack">
                                <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                    <div class="me-5">
                                        <div class="text-gray-800 fw-bold fs-6">Down Payment</div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="text-gray-600">{{ $wealthEvent->down_payment }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="separator separator-dashed my-6"></div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card mb-5 mb-xl-8 d-none">
        <div class="card-body d-flex flex-column flex-center">
            <div class="mb-2">
                <h1 class="fw-semibold text-gray-800 text-center lh-lg">
                    What's your <span class="fw-bolder"> Net Worth ?</span>
                </h1>
                <p class="text-center">Link your account to find out. Track it here to help it grow.</p>
                <div class="py-10 text-center">
                    <img src="{{ asset('assets/media/svg/illustrations/easy/1.svg') }}" class="theme-light-show w-200px" alt="" />
                    <img src="{{ asset('assets/media/svg/illustrations/easy/1-dark.svg') }}" class="theme-dark-show w-200px" alt="" />
                </div>
            </div>
            <div class="text-center mb-1">
                <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_new_card" data-bs-toggle="modal"> Show Me </a>
            </div>
        </div>
    </div>
</div>