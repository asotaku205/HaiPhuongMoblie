@extends('layouts.main')

@section('title', $blog->title)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('blogs.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Quay lại danh sách
            </a>
        </div>

        <!-- Blog Content -->
        <div class="bg-white rounded-lg shadow-sm mb-8">
            <div class="p-6">
                <!-- Status and Tags -->
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    @if($blog->status == 'pending')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Chờ giải đáp
                        </span>
                    @elseif($blog->status == 'solved')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Đã giải quyết
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Đã đóng
                        </span>
                    @endif

                    @if($blog->device_type)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            {{ $blog->device_type }}
                        </span>
                    @endif

                    @if($blog->error_type)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            {{ $blog->error_type }}
                        </span>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $blog->title }}</h1>

                <!-- Author and Date -->
                <div class="flex items-center text-sm text-gray-600 mb-6 pb-6 border-b border-gray-200">
                    <div class="flex items-center mr-6">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <span class="font-medium">{{ $blog->user->fullname }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $blog->created_at->format('d/m/Y H:i') }} ({{ $blog->created_at->diffForHumans() }})
                    </div>
                </div>                <!-- Content -->
                <div class="prose prose-lg max-w-none text-gray-800">
                    {!! nl2br(e($blog->content)) !!}
                </div>                <!-- Images -->
                @if($blog->images && count($blog->images) > 0)
                <div class="mt-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Ảnh minh họa</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($blog->images as $index => $image)
                        <div class="group relative overflow-hidden rounded-lg bg-gray-100">
                            <div class="aspect-square cursor-pointer" onclick="openImageModal('{{ asset('uploads/blogs/' . $image) }}', {{ $index }})">
                                <img src="{{ asset('uploads/blogs/' . $image) }}" 
                                     alt="Ảnh minh họa {{ $index + 1 }}" 
                                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                
                                <!-- Overlay chỉ hiện khi hover -->
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-opacity duration-300 flex items-center justify-center">
                                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">
                    Bình luận ({{ $blog->comments->count() }})
                </h2>

                <!-- Add Comment Form -->
                @auth
                <form action="{{ route('blogs.comments.store', $blog->id) }}" method="POST" class="mb-8">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            Thêm bình luận
                        </label>
                        <textarea id="content" 
                                  name="content" 
                                  rows="4" 
                                  placeholder="Chia sẻ ý kiến hoặc giải pháp của bạn..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                  required></textarea>
                    </div>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Gửi bình luận
                    </button>
                </form>
                @else
                <div class="mb-8 p-4 bg-gray-50 rounded-lg text-center">
                    <p class="text-gray-600 mb-3">Bạn cần đăng nhập để bình luận</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Đăng nhập
                    </a>
                </div>
                @endauth

                <!-- Comments List -->
                @if($blog->comments->count() > 0)
                <div class="space-y-6">
                    @foreach($blog->comments->sortBy('created_at') as $comment)
                    <div class="border-l-4 {{ $comment->is_solution ? 'border-green-500 bg-green-50' : ($comment->admin ? 'border-blue-500 bg-blue-50' : 'border-gray-200') }} pl-4 py-3">
                        @if($comment->is_solution)
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm font-medium text-green-800">Giải pháp được đề xuất</span>
                        </div>
                        @endif

                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 {{ $comment->admin ? 'bg-blue-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center mr-3">
                                    @if($comment->admin)
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ $comment->author_name }}
                                        @if($comment->admin)
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                Admin
                                            </span>
                                        @endif
                                    </p>
                                    <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-800 leading-relaxed">
                            {!! nl2br(e($comment->content)) !!}
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p class="text-gray-600">Chưa có bình luận nào. Hãy là người đầu tiên chia sẻ ý kiến!</p>
                </div>
                @endif
            </div>        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4" onclick="closeImageModal()">
    <div class="relative max-w-5xl max-h-full" onclick="event.stopPropagation()">
        <!-- Close button -->
        <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        
        <!-- Image container -->
        <div class="relative">
            <img id="modalImage" src="" alt="Ảnh phóng to" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
            
            <!-- Loading indicator -->
            <div id="imageLoading" class="absolute inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 rounded-lg hidden">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
            </div>
        </div>
        
        <!-- Navigation buttons -->
        @if($blog->images && count($blog->images) > 1)
        <button id="prevBtn" onclick="previousImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 hover:scale-110 transition-all duration-200 bg-black bg-opacity-30 rounded-full p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        
        <button id="nextBtn" onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 hover:scale-110 transition-all duration-200 bg-black bg-opacity-30 rounded-full p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
        
        <!-- Image counter -->
        <div id="imageCounter" class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 text-white bg-black bg-opacity-50 px-4 py-2 rounded-full text-sm">
            <span id="currentImageIndex">1</span> / <span id="totalImages">{{ count($blog->images ?? []) }}</span>
        </div>
        @endif    </div>
</div>

<!-- Include Blog Show JavaScript -->
<script src="{{ asset('js/blog-show.js') }}"></script>
<script>
    // Initialize image modal with blog images
    initializeImageModal(@json($blog->images ?? []));
</script>
@endsection
