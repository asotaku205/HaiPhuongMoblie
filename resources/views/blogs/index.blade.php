@extends('layouts.main')

@section('title', 'Blog Sửa Chữa')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Blog Sửa Chữa</h1>
                    <p class="mt-2 text-gray-600">Chia sẻ và tìm giải pháp cho các vấn đề kỹ thuật</p>
                </div>
                @auth
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('blogs.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tạo bài viết mới
                    </a>
                </div>
                @else
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                        Đăng nhập để tạo bài viết
                    </a>
                </div>
                @endauth
            </div>
        </div>

        <!-- Blog List -->
        @if($blogs->count() > 0)
        <div class="space-y-6">
            @foreach($blogs as $blog)
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between">                        <div class="flex-1">
                            <!-- Status Badge -->
                            <div class="flex items-center space-x-3 mb-3">
                                @if($blog->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Chờ giải đáp
                                    </span>
                                @elseif($blog->status == 'solved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Đã giải quyết
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Đã đóng
                                    </span>
                                @endif

                                @if($blog->device_type)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $blog->device_type }}
                                    </span>
                                @endif

                                @if($blog->error_type)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $blog->error_type }}
                                    </span>
                                @endif

                                @if($blog->images && count($blog->images) > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ count($blog->images) }} ảnh
                                    </span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">
                                <a href="{{ route('blogs.show', $blog->id) }}" class="hover:text-blue-600 transition-colors">
                                    {{ $blog->title }}
                                </a>
                            </h2>

                            <!-- Content Preview -->
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($blog->content), 200) }}
                            </p>

                            <!-- Image Preview -->
                            @if($blog->images && count($blog->images) > 0)
                            <div class="mb-4">
                                <div class="flex space-x-2 overflow-x-auto">
                                    @foreach(array_slice($blog->images, 0, 3) as $image)
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('uploads/blogs/' . $image) }}" 
                                             alt="Preview" 
                                             class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                                    </div>
                                    @endforeach
                                    @if(count($blog->images) > 3)
                                    <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                        <span class="text-xs text-gray-500 font-medium">+{{ count($blog->images) - 3 }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Meta Info -->
                            <div class="flex items-center text-sm text-gray-500 space-x-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $blog->user->fullname }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    {{ $blog->comments->count() }} bình luận
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $blog->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-4 lg:mt-0 lg:ml-6">
                            <a href="{{ route('blogs.show', $blog->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                Xem chi tiết
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $blogs->links() }}
        </div>
        @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Chưa có bài viết nào</h3>
            <p class="text-gray-600 mb-6">Hãy là người đầu tiên chia sẻ vấn đề và tìm giải pháp!</p>
            @auth
            <a href="{{ route('blogs.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Tạo bài viết đầu tiên
            </a>
            @else
            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                Đăng nhập để tạo bài viết
            </a>
            @endauth
        </div>
        @endif
    </div>
</div>
@endsection
