<?php

namespace App\Http\Controllers;

use App\Mail\NewPost;
use Illuminate\Http\Request;
use App\Models\NewslatterMail;
use App\Models\Post;
use App\Models\PostContent;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.create', compact( 'categories', 'tags'));
    }

    public function show($slug)
    {
        $post = Post::with(['categories', 'content', 'author', 'comments'])->where('slug', $slug)->firstOrFail();
        if(empty($post)) {
            return redirect()->route('posts.create')->with('error', 'Post not found');
        }

        return view('public.read', compact('post'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                // img_header pode ser base64 (string grande) ou arquivo
                'img_header' => ['nullable', function ($attribute, $value, $fail) {
                    // Aceitar base64 ou arquivo de imagem válido
                    if (is_string($value)) {
                        // Validar base64 mínimo: começa com data:image
                        if (!preg_match('/^data:image\/(png|jpg|jpeg|gif|webp);base64,/', $value)) {
                            $fail('O campo ' . $attribute . ' deve ser uma imagem base64 válida.');
                        }
                    } elseif ($value instanceof \Illuminate\Http\UploadedFile) {
                        // Validar o arquivo como imagem
                        $validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                        if (!in_array($value->getMimeType(), $validMimeTypes)) {
                            $fail('O arquivo enviado deve ser uma imagem válida.');
                        }

                    } elseif ($value !== null) {
                        $fail('Formato de imagem inválido.');
                    }
                }],
                'description' => 'nullable|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }
        // Criar o slug
        $validatedData['slug'] = str_slug($validatedData['title'], '_', 'pt-BR');
        $validatedData['status'] = 'draft'; // Status padrão
        $validatedData['created_at'] = now();
        $validatedData['updated_at'] = now();
        $validatedData['published_at'] = null;
        $validatedData['author'] = 1; // ID do autor logado
    
        // Criar o post
        $post = Post::create($validatedData);
    
        // Relacionar categorias
        $post->categories()->sync($request->input('categories'));
    
        $content = new PostContent();
        $content->content = $request->input('content');
        $content->video = $request->input('video') ?? null;
        $content->post_id = $post->id;
    
        // Processar a imagem do conteúdo (base64 ou upload)
        $r = $request->all();
        $imgHeader = $r['img_header'] ?? null;
        
        if ($imgHeader instanceof \Illuminate\Http\UploadedFile) {
            // Converter upload para base64
            $imageContent = file_get_contents($imgHeader->getRealPath());
            $base64Image = 'data:' . $imgHeader->getMimeType() . ';base64,' . base64_encode($imageContent);
            $content->image = $base64Image;
    
        } elseif (is_string($imgHeader) && preg_match('/^data:image\/(png|jpg|jpeg|gif|webp);base64,/', $imgHeader)) {
            // Já é base64 válido, salva direto
            $content->image = $imgHeader;
    
        } else {
            // Sem imagem ou imagem inválida
            $content->image = null;
        }
    
        if ($content->save()) {
            $post->content()->save($content);
        } else {
            return redirect()->back()->with('error', 'Erro ao salvar o conteúdo');
        }


        $mail = NewslatterMail::where('active', true)->get();
        foreach ($mail as $m) {
            Mail::to($m->email)->send(new NewPost($request,$m->email, $imgHeader, $validatedData['slug']));
        }

    
        return redirect()->route('posts.show', ['slug' => $post->slug]);
    }
    
    public function list()
    {
        $posts = Post::with(['categories', 'content', 'author'])->get();
        return view('admin.post.list', compact('posts'));
    }

    public function edit($slug)
    {
        $post = Post::with(['categories', 'content', 'author'])->where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function delete($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->delete();

        return redirect()->route('posts.list')->with('success', 'Post deleted successfully');
    }

    public function update(Request $request)
    {
        $post = Post::where('id', $request->post_id)->firstOrFail();
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'nullable|string|max:255',
        ]);

        // Atualizar o slug
        $validatedData['slug'] = str_slug($validatedData['title'], '_', 'pt-BR');
        $validatedData['updated_at'] = now();
    
        // Atualizar o post
        $post->update($validatedData);
    
        // Relacionar categorias
        $post->categories()->sync($request->input('categories'));
    
        // Atualizar conteúdo
        $content = PostContent::where('post_id', $post->id)->first();

        if ($content) {
            $content->content = $request->content;
            $content->video = $request->video ?? null;
        
            $imgHeader = $request->img_header;
            if ($imgHeader instanceof \Illuminate\Http\UploadedFile) {
                $imageContent = file_get_contents($imgHeader->getRealPath());
                $content->image = 'data:' . $imgHeader->getMimeType() . ';base64,' . base64_encode($imageContent);
            } elseif (is_string($imgHeader) && preg_match('/^data:image\/(png|jpg|jpeg|gif|webp);base64,/', $imgHeader)) {
                $content->image = $imgHeader;
            }
            if (!$content->update()) {
                return redirect()->back()->with('error', 'Erro ao salvar o conteúdo');
            }
        }
            
        return redirect()->route('posts.show', ['slug' => $post->slug]);
    }
}
