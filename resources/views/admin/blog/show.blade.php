@extends('admin.admin_layout')

@section('title', 'Chi tiết Blog - ' . $blog->title)

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.blogs.index') }}" 
               class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">
                <i class="fas fa-arrow-left mr-2"></i>
                Quay lại
            </a>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Chi tiết bài viết</h1>
                <p class="text-gray-600">Quản lý và trả lời câu hỏi từ người dùng</p>
            </div>
        </div>
        
        <!-- Status Update -->
        <div class="flex items-center space-x-3">
            <form action="{{ route('admin.blogs.update-status', $blog->id) }}" method="POST" class="inline-flex">
                @csrf
                <select name="status" onchange="this.form.submit()" 
                        class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="pending" {{ $blog->status == 'pending' ? 'selected' : '' }}>Chờ giải đáp</option>
                    <option value="solved" {{ $blog->status == 'solved' ? 'selected' : '' }}>Đã giải quyết</option>
                    <option value="closed" {{ $blog->status == 'closed' ? 'selected' : '' }}>Đã đóng</option>
                </select>
            </form>
            
            <!-- Delete Button -->
            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline" 
                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    <i class="fas fa-trash mr-2"></i>
                    Xóa bài viết
                </button>
            </form>
        </div>
    </div>

    <!-- Blog Content -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <!-- Status and Tags -->
            <div class="flex flex-wrap items-center gap-2 mb-4">
                @if($blog->status == 'pending')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>
                        Chờ giải đáp
                    </span>
                @elseif($blog->status == 'solved')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check mr-1"></i>
                        Đã giải quyết
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-times mr-1"></i>
                        Đã đóng
                    </span>
                @endif

                @if($blog->device_type)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-mobile-alt mr-1"></i>
                        {{ $blog->device_type }}
                    </span>
                @endif

                @if($blog->error_type)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        {{ $blog->error_type }}
                    </span>
                @endif
            </div>

            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $blog->title }}</h2>

            <!-- Author and Date -->
            <div class="flex items-center text-sm text-gray-600 mb-6 pb-6 border-b border-gray-200">
                <div class="flex items-center mr-6">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                    <div>
                        <span class="font-medium">{{ $blog->user->fullname }}</span>
                        <div class="text-xs">{{ $blog->user->email }}</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar mr-1"></i>
                    {{ $blog->created_at->format('d/m/Y H:i') }} ({{ $blog->created_at->diffForHumans() }})
                </div>
            </div>            <!-- Content -->
            <div class="prose max-w-none text-gray-800">
                {!! nl2br(e($blog->content)) !!}
            </div>            <!-- Images -->
            @if($blog->images && count($blog->images) > 0)
            <div class="mt-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">
                    <i class="fas fa-images mr-2"></i>
                    Ảnh minh họa ({{ count($blog->images) }})
                </h4>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($blog->images as $index => $image)
                    <div class="group relative overflow-hidden rounded-lg bg-gray-100">
                        <div class="aspect-square cursor-pointer" onclick="openImageModal('{{ asset('uploads/blogs/' . $image) }}', {{ $index }})">
                            <img src="{{ asset('uploads/blogs/' . $image) }}" 
                                 alt="Ảnh minh họa {{ $index + 1 }}" 
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                            
                            <!-- Overlay chỉ hiện khi hover -->
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-opacity duration-300 flex items-center justify-center">
                                <div class="bg-white bg-opacity-20 rounded-full p-3">
                                    <i class="fas fa-search-plus text-white text-lg"></i>
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
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">
                Bình luận và giải pháp ({{ $blog->comments->count() }})
            </h3>

            <!-- Admin Reply Form -->
            <form action="{{ route('admin.blogs.comments.store', $blog->id) }}" method="POST" class="mb-8 p-4 bg-blue-50 rounded-lg">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Trả lời bài viết (Admin)
                    </label>
                    <textarea id="content" 
                              name="content" 
                              rows="4" 
                              placeholder="Nhập giải pháp hoặc hướng dẫn chi tiết..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                              required></textarea>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="is_solution" 
                               name="is_solution" 
                               value="1"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_solution" class="ml-2 text-sm text-gray-700">
                            Đánh dấu là giải pháp chính thức
                        </label>
                    </div>
                    
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">
                        <i class="fas fa-reply mr-2"></i>
                        Gửi trả lời
                    </button>
                </div>
            </form>

            <!-- Comments List -->
            @if($blog->comments->count() > 0)
            <div class="space-y-6">
                @foreach($blog->comments->sortBy('created_at') as $comment)
                <div class="border-l-4 {{ $comment->is_solution ? 'border-green-500 bg-green-50' : ($comment->admin ? 'border-blue-500 bg-blue-50' : 'border-gray-200 bg-gray-50') }} pl-4 py-4 rounded-r-lg">
                    @if($comment->is_solution)
                    <div class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span class="text-sm font-medium text-green-800">Giải pháp chính thức</span>
                    </div>
                    @endif

                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 {{ $comment->admin ? 'bg-blue-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center mr-3">
                                @if($comment->admin)
                                    <i class="fas fa-shield-alt text-white"></i>
                                @else
                                    <i class="fas fa-user text-gray-600"></i>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">
                                    {{ $comment->author_name }}
                                    @if($comment->admin)
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-crown mr-1"></i>
                                            Admin
                                        </span>
                                    @endif
                                </p>
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $comment->created_at->format('d/m/Y H:i') }} ({{ $comment->created_at->diffForHumans() }})
                                </p>
                            </div>
                        </div>
                        
                        <!-- Delete Comment Button -->
                        @if($comment->admin)
                        <form action="{{ route('admin.blogs.comments.destroy', $comment->id) }}" method="POST" class="inline" 
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </form>
                        @endif
                    </div>

                    <div class="text-gray-800 leading-relaxed">
                        {!! nl2br(e($comment->content)) !!}
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-comments text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-600">Chưa có bình luận nào. Hãy là người đầu tiên trả lời!</p>
            </div>
            @endif
        </div>
    </div>
</div>

@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
    </div>
</div>
<script>
    setTimeout(function() {
        document.querySelector('.fixed.bottom-4').style.display = 'none';
    }, 3000);
</script>
@endif

@if(session('error'))
<div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    <div class="flex items-center">
        <i class="fas fa-exclamation-circle mr-2"></i>
        {{ session('error') }}
    </div>
</div>
<script>
    setTimeout(function() {
        document.querySelector('.fixed.bottom-4').style.display = 'none';
    }, 3000);
</script>
@endif

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-5xl max-h-full">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10 bg-black bg-opacity-50 rounded-full p-2">
            <i class="fas fa-times text-xl"></i>
        </button>
        
        <img id="modalImage" src="" alt="Ảnh phóng to" class="max-w-full max-h-full object-contain rounded-lg">
        
        <!-- Navigation buttons -->
        @if($blog->images && count($blog->images) > 1)
        <button id="prevBtn" onclick="previousImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-3">
            <i class="fas fa-chevron-left text-xl"></i>
        </button>
        
        <button id="nextBtn" onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-3">
            <i class="fas fa-chevron-right text-xl"></i>
        </button>
        
        <!-- Image counter -->
        <div id="imageCounter" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white bg-black bg-opacity-75 px-4 py-2 rounded-full text-sm">
            <span id="currentImageIndex">1</span> / <span id="totalImages">{{ count($blog->images ?? []) }}</span>
        </div>
        @endif
    </div>
</div>

<!-- Include Admin Blog JavaScript -->
<script src="{{ asset('js/admin-blog.js') }}"></script>
<script>
    // Initialize admin image modal with blog images
    initializeAdminImageModal(@json($blog->images ?? []));
</script>
@endsection
