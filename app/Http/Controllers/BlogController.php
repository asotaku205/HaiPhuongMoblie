<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['user', 'comments'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::with(['user', 'comments.user', 'comments.admin'])
            ->findOrFail($id);

        return view('blogs.show', compact('blog'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để tạo bài viết.');
        }

        return view('blogs.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để tạo bài viết.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'device_type' => 'nullable|string|max:50',
            'error_type' => 'nullable|string|max:50',
            'images' => 'nullable|array|max:5', // Tối đa 5 ảnh
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072', // Tối đa 3MB mỗi ảnh
        ], [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Nội dung là bắt buộc.',
            'content.min' => 'Nội dung phải có ít nhất 10 ký tự.',
            'images.max' => 'Bạn chỉ có thể tải lên tối đa 5 ảnh.',
            'images.*.image' => 'File tải lên phải là hình ảnh.',
            'images.*.mimes' => 'Chỉ chấp nhận các định dạng: JPEG, PNG, JPG, GIF, WebP.',
            'images.*.max' => 'Mỗi ảnh không được vượt quá 3MB.',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            // Tạo thư mục nếu chưa tồn tại
            $uploadPath = public_path('uploads/blogs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    // Generate unique filename with timestamp and random string
                    $filename = time() . '_' . uniqid() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '', $image->getClientOriginalName());
                    
                    try {
                        // Move to public/uploads/blogs/
                        $image->move($uploadPath, $filename);
                        $imagePaths[] = $filename;
                    } catch (\Exception $e) {
                        // Log error but continue with other images
                        \Log::error('Failed to upload image: ' . $e->getMessage());
                    }
                }
            }
        }

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'images' => !empty($imagePaths) ? $imagePaths : null,
            'device_type' => $request->device_type,
            'error_type' => $request->error_type,
            'user_id' => Auth::id(),
            'status' => 'pending'
        ]);

        return redirect()->route('blogs.show', $blog->id)->with('success', 'Bài viết đã được tạo thành công và đang chờ duyệt!');
    }

    public function storeComment(Request $request, $blogId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để bình luận.');
        }

        $request->validate([
            'content' => 'required',
        ]);

        BlogComment::create([
            'content' => $request->content,
            'blog_id' => $blogId,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('blogs.show', $blogId)->with('success', 'Bình luận đã được thêm!');
    }
}
