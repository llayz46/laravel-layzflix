<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Review extends Component
{
    use WithPagination;

    public $movie;

    #[Validate('required', message: 'Please write a comment, it can\'t be empty.')]
    #[Validate('min:3', message: 'Please write a comment with at least 3 characters.')]
    #[Validate('max:255', message: 'Please write a comment with a maximum of 255 characters.')]
    #[Validate('string')]
    public $comment;

    #[Validate('required', message: 'Please select a note before post your comment.')]
    #[Validate('numeric')]
    #[Validate('min:1', message: 'Please select a note.')]
    #[Validate('max:5', message: 'Please select a note between 1 and 5.')]
    public $note;

    public $movieId;
    public $movieTitle;
    public $movieMediaType;

    public function mount($movie)
    {
        $this->movieId = $movie['id'];
        $this->movieTitle = $movie['normalized_title'];
        $this->movieMediaType = $movie['media_type'];

        if (auth()->check()) {
            $userReview = auth()->user()->reviews()->whereJsonContains('movie->id', (string)$this->movieId)->first();
            if ($userReview) {
                $this->comment = $userReview->comment;
                $this->note = $userReview->note;
            }
        }
    }

    public function save()
    {
        $data = $this->validate();

        $data['user_id'] = auth()->id();
        $data['movie'] = [
            'id' => (string)$this->movieId,
            'title' => $this->movieTitle,
            'mediaType' => $this->movieMediaType,
        ];

        $existingReview = auth()->user()->reviews()->whereJsonContains('movie->id', $data['movie']['id'])->first();

        if ($existingReview) {
            $review = auth()->user()->reviews()->whereJsonContains('movie->id', $data['movie']['id'])->first();
            $review->update($data);

            auth()->user()->userLevel();

            session()->flash('reviewSuccess', 'Review saved successfully.');
        } else {
            $review = \App\Models\Review::create($data);
            $review->save();

            auth()->user()->userLevel();

            session()->flash('reviewSuccess', 'Review added successfully.');

            $this->reset('note');
        }
    }

    public function delete(\App\Models\Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return back()->with('error', 'You are not authorized to delete this review.');
        }

        $review->delete();

        auth()->user()->userLevel();

        session()->flash('reviewSuccess', 'Review deleted successfully.');

        $this->reset('note', 'comment');
    }

    public function render()
    {
        return view('livewire.review',  [
            'reviews' => \App\Models\Review::with('user:id,username,avatar')->whereJsonContains('movie->id', (string)$this->movie['id'])->paginate(5)
        ]);
    }
}
