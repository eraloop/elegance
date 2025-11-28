<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ManageContacts extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = ''; // 'read', 'unread'
    public $filterType = ''; // 'all', 'manual', 'automated'
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $selectedContact;
    public $deleteId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Contact::latest();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('subject', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterStatus === 'read') {
            $query->where('is_read', true);
        } elseif ($this->filterStatus === 'unread') {
            $query->where('is_read', false);
        }

        // Filter by type (manual vs automated)
        if ($this->filterType === 'automated') {
            $query->where('subject', 'like', '%Appointment%');
        } elseif ($this->filterType === 'manual') {
            $query->where('subject', 'not like', '%Appointment%');
        }

        return view('livewire.admin.contacts.manage-contacts', [
            'contacts' => $query->paginate(10)
        ]);
    }

    public function viewDetails($id)
    {
        $this->selectedContact = Contact::findOrFail($id);

        if (!$this->selectedContact->is_read) {
            $this->selectedContact->update(['is_read' => true]);
        }

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->selectedContact = null;
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
            Contact::find($this->deleteId)->delete();
            session()->flash('success', 'Message deleted successfully.');
            $this->closeDeleteModal();
        }
    }

    public function markAsUnread($id)
    {
        Contact::find($id)->update(['is_read' => false]);
        session()->flash('success', 'Message marked as unread.');
    }
}
