<?php

namespace App\Livewire\Admin;

use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
class Candidates extends Component
{
    use WithFileUploads;

    public string $name = '';

    public string $details = '';

    public $photo;

    public ?int $editingId = null;

    public function save(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'details' => ['nullable', 'string', 'max:1000'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $candidate = $this->editingId
            ? Candidate::findOrFail($this->editingId)
            : new Candidate;

        $candidate->name = $this->name;
        $candidate->details = $this->details;

        if ($this->photo) {
            if ($candidate->image) {
                Storage::disk('public')->delete($candidate->image);
            }

            $candidate->image = $this->photo->store('candidates', 'public');
        }

        $candidate->save();

        $this->reset(['name', 'details', 'photo', 'editingId']);
        session()->flash('success', 'Candidate saved.');
    }

    public function edit(int $id): void
    {
        $candidate = Candidate::findOrFail($id);

        $this->editingId = $candidate->id;
        $this->name = $candidate->name;
        $this->details = (string) $candidate->details;
        $this->photo = null;
    }

    public function cancelEdit(): void
    {
        $this->reset(['name', 'details', 'photo', 'editingId']);
    }

    public function delete(int $id): void
    {
        $candidate = Candidate::findOrFail($id);

        // Don't let a candidate with recorded votes silently disappear -
        // that would quietly corrupt the results/turnout numbers.
        if ($candidate->votes()->exists()) {
            session()->flash('error', 'This candidate already has votes and can\'t be deleted. Close voting first if you need to remove them.');

            return;
        }

        if ($candidate->image) {
            Storage::disk('public')->delete($candidate->image);
        }

        $candidate->delete();
        session()->flash('success', 'Candidate removed.');
    }

    public function render()
    {
        return view('livewire.admin.candidates', [
            'candidates' => Candidate::withCount('votes')->orderBy('name')->get(),
        ]);
    }
}
