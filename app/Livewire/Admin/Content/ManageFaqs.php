<?php

namespace App\Livewire\Admin\Content;

use App\Models\Faq;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ManageFaqs extends Component
{
    public $faqs;
    public $question, $answer, $category;
    public $faqId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    public function render()
    {
        $this->faqs = Faq::all();
        return view('livewire.admin.content.manage-faqs');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->question = '';
        $this->answer = '';
        $this->category = 'General';
        $this->faqId = null;
    }

    public function store()
    {
        $this->validate([
            'question' => 'required',
            'answer' => 'required',
            'category' => 'required',
        ]);

        Faq::updateOrCreate(['id' => $this->faqId], [
            'question' => $this->question,
            'answer' => $this->answer,
            'category' => $this->category,
        ]);

        session()->flash('success', $this->faqId ? 'FAQ updated successfully.' : 'FAQ created successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $this->faqId = $id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->category = $faq->category;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteOpen = true;
    }

    public function closeDeleteModal()
    {
        $this->isDeleteOpen = false;
        $this->deleteId = null;
    }

    public function delete()
    {
        if ($this->deleteId) {
            Faq::find($this->deleteId)->delete();
            session()->flash('success', 'FAQ deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
