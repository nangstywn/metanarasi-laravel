<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category as Data;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Category extends Component
{
    public $category_id = NULL;
    public $category = NULL;

    protected function rules()
    {
        return [
            // 'category' => ['required', Rule::unique('categories')->ignore($this->category_id)]
            'category' => 'required|unique:categories,name,' . $this->category_id
        ];
    }

    protected $messages = [
        'category.required' => 'nama kategori wajib diisi',
        'category.unique' => 'kategori sudah ada',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('admin.category.index', ['categories' => Data::paginate(10)])
            ->extends('layouts.master')->section('content');
    }

    public function editCategory($category)
    {
        $this->category_id = $category['id'];
        $this->category = $category['name'];
    }

    public function updateCategory()
    {
        $this->validate();
        $update = Data::where('id', $this->category_id)->first();
        $update->update(['name' => $this->category, 'slug' => Str::slug($this->category)]);
        toastr('Kategori berhasil diubah', 'success');
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->category_id = NULL;
        $this->category = NULL;
    }

    // public function deleteCategory($categoryId)
    // {
    //     Data::where('id', $categoryId)->delete();
    //     toastr('Kategori berhasil dihapus', 'success');
    // }
}
