<div>
    <div>
        <div class="card shadow-sm">
            <div class="card-header bg-primary bg-gradient d-flex justify-content-between align-items-center py-3">
                <div>
                    <h4 class="card-title text-white mb-0">
                        <i class="bi bi-robot me-2"></i> Traffic Assistant
                    </h4>
                    <p class="text-white-50 mb-0 small">Get real-time traffic insights and suggestions</p>
                </div>
                <div class="bg-light rounded-circle p-2">
                    <i class="bi bi-graph-up text-primary"></i>
                </div>
            </div>

            <div class="card-body">
                <div class="chat-container overflow-auto mb-4" style="height: 200px;">
                    @foreach($chatMessages as $msg)
                        <div
                            class="d-flex mb-3 {{ $msg['role'] === 'assistant' ? 'justify-content-start' : 'justify-content-end' }} animate__animated animate__fadeIn">
                            @if($msg['role'] === 'assistant')
                                <div class="d-flex align-items-start">
                                    <div class="avatar rounded-circle bg-light p-2 me-2 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-robot fs-5 text-primary"></i>
                                    </div>
                                    <div class="message bg-light rounded-3 p-3 shadow-sm" style="max-width: 75%;">
                                        <p class="mb-1">{{ $msg['content'] }}</p>
                                        <small class="text-muted">{{ now()->format('h:i A') }}</small>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-start flex-row-reverse">
                                    <div class="avatar rounded-circle bg-primary p-2 ms-2 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-person-fill text-white"></i>
                                    </div>
                                    <div class="message bg-primary text-white rounded-3 p-3 shadow-sm" style="max-width: 75%;">
                                        <p class="mb-1">{{ $msg['content'] }}</p>
                                        <small class="text-white-50">{{ now()->format('h:i A') }}</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    @if($loading)
                        <div class="d-flex justify-content-start mb-3">
                            <div class="d-flex align-items-start">
                                <div class="avatar rounded-circle bg-light p-2 me-2 d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <i class="bi bi-robot fs-5 text-primary"></i>
                                </div>
                                <div class="message bg-light rounded-3 p-3 shadow-sm">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="spinner-grow spinner-grow-sm text-primary" role="status"
                                            style="animation-delay: 0s">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <div class="spinner-grow spinner-grow-sm text-primary" role="status"
                                            style="animation-delay: 0.2s">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <div class="spinner-grow spinner-grow-sm text-primary" role="status"
                                            style="animation-delay: 0.4s">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <form wire:submit.prevent="sendMessage" class="mt-4">
                    <div class="input-group">
                        <input type="text" wire:model="message" class="form-control form-control-lg"
                            placeholder="Ask about traffic conditions..." aria-label="Message" :disabled="loading">
                        <button class="btn btn-primary btn-lg d-flex align-items-center" type="submit"
                            :disabled="loading || !message">
                            <i class="bi bi-send-fill me-2"></i>
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

        <style>
            .chat-container {
                scrollbar-width: thin;
                scrollbar-color: #dee2e6 #ffffff;
            }

            .chat-container::-webkit-scrollbar {
                width: 6px;
            }

            .chat-container::-webkit-scrollbar-track {
                background: #ffffff;
            }

            .chat-container::-webkit-scrollbar-thumb {
                background-color: #dee2e6;
                border-radius: 20px;
            }

            .message {
                word-break: break-word;
            }

            .animate__animated {
                animation-duration: 0.3s;
            }

            .animate__fadeIn {
                animation-name: fadeIn;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .avatar {
                transition: transform 0.2s ease;
            }

            .avatar:hover {
                transform: scale(1.1);
            }

            .message {
                transition: all 0.2s ease;
            }

            .message:hover {
                box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
            }
        </style>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</div>
</div>