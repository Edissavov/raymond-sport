<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class BlogPosts extends Component
{
    public $perPage = 6;
    public $search = '';

    protected $queryString = ['search'];

    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function render()
    {
        $posts = Post::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.blog-posts', ['posts' => $posts]);
    }
}