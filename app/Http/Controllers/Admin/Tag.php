<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag as Data;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Tag extends Component
{
    public $tag_id = NULL;
    public $tag = NULL;

    protected function rules()
    {
        return [
            // 'category' => ['required', Rule::unique('categories')->ignore($this->category_id)]
            'tag' => 'required|unique:tags,name,' . $this->tag_id
        ];
    }

    protected $messages = [
        'tag.required' => 'nama kategori wajib diisi',
        'tag.unique' => 'kategori sudah ada',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('admin.tag.index', ['tags' => Data::paginate(5)])
            ->extends('layouts.master')->section('content');
    }

    public function editTag($tag)
    {
        $this->tag_id = $tag['id'];
        $this->tag = $tag['name'];
    }

    public function updateTag()
    {
        $this->validate();
        $update = Data::where('id', $this->tag_id)->first();
        $update->update(['name' => $this->tag, 'slug' => Str::slug($this->tag)]);
        toastr('Tag berhasil diubah');
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->tag_id = NULL;
        $this->tag = NULL;
    }

    public function deleteTag($tagId)
    {
        Data::where('id', $tagId)->delete();
        toastr('Tag berhasil dihapus', 'success');
    }
}
