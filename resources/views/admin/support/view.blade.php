@extends('admin.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> View Support </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminSupport') }}" class="text-muted text-hover-primary"> All Support </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> View Support </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card card-flush">
                <div class="card-header pt-7" id="kt_chat_contacts_header">
                    <div class="card-title">
                        <h2>Support Chat</h2>
                    </div>
                </div>
                <div class="card" id="kt_chat_messenger">

                    <div class="card-body" id="kt_chat_messenger_body">
                        <div 
                            class="scroll-y me-n5 pe-5 h-300px h-lg-auto"
                            data-kt-element="messages"
                            data-kt-scroll="true"     
                            data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                            data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body" 
                            data-kt-scroll-offset="5px">
                            <div class="d-flex justify-content-start mb-10 " >
                                <div class="d-flex flex-column align-items-start">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol  symbol-35px symbol-circle ">
                                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                                            </svg>
                                        </div>
                                        <div class="ms-3">
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">{{ $data->user->name }}</a>
                                            {{-- <span class="text-muted fs-7 mb-1">2 mins</span> --}}
                                        </div>
                                    </div>
                                    <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">
                                        {{ $data->details }}            
                                    </div>
                                </div>
                            </div>
                            @foreach($data->replies as $val)
                                @if($val->user_id == Auth::user()->id)
                                    <div class="d-flex justify-content-end mb-10" data-kt-element="template-out">
                                    {{-- <div class="d-flex justify-content-end mb-10 d-none" data-kt-element="template-out"> --}}
                                        <div class="d-flex flex-column align-items-end">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="me-3">
                                                    {{-- <span class="text-muted fs-7 mb-1">5 mins</span> --}}
                                                    <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>  
                                                </div>
                                                <div class="symbol  symbol-35px symbol-circle ">
                                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                                                    </svg>
                                                </div>              
                                            </div>
                                            <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">
                                                {{ $val->details  }}            
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-start mb-10" data-kt-element="template-in">
                                    {{-- <div class="d-flex justify-content-start mb-10 d-none" data-kt-element="template-in"> --}}
                                        <div class="d-flex flex-column align-items-start">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="symbol  symbol-35px symbol-circle ">
                                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                                                    </svg>
                                                </div>
                                                <div class="ms-3">
                                                    <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">{{ $val->user->name }}</a>
                                                    {{-- <span class="text-muted fs-7 mb-1">2 mins</span> --}}
                                                </div>
                                            </div>
                                            <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">
                                                {{ $val->details  }}           
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                        <span id="msg_errors" style="color: red"></span>
                        <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
                        <input type="hidden" data-kt-element="ticket_id" name="ticket_id" value="{{ $data->id }}"/>
                        <div class="d-flex flex-stack">
                            <div class="d-flex align-items-center me-2">
                                <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon"><i class="ki-duotone ki-paper-clip fs-2x"></i></button>
                            </div>
                            <button class="btn btn-primary" type="button" data-kt-element="send">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="{{ asset('assets/js/custom/apps/customers/view/events-table.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
@endsection