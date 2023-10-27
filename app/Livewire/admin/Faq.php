<?php

namespace App\Livewire\Admin;

use App\Models\Faq as ModelsFaq;
use Livewire\WithPagination;

use Livewire\Component;

class Faq extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $edit_faq_id;
    public $question;
    public $answer;

    public $button_text = "Create FAQ";

    public function add_new_faq()
    {
        if ($this->edit_faq_id) {
            $this->update($this->edit_faq_id);
        } else {
            $this->validate([
                'question' => 'required',
                'answer' => 'required',
            ]);
            ModelsFaq::create([
                'question' => $this->question,
                'answer' => $this->answer,
            ]);


            $this->question="";
            $this->answer="";

            session()->flash('message','FAQ Created successfully.');
        }
    }

    public function edit($id)
    {
        $faq = ModelsFaq::findOrFail($id);
        $this->edit_faq_id = $id;

        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->button_text="Update FAQ";
    }

    public function update($id)
    {
        $this->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = ModelsFaq::findOrFail($id);
        $faq->question = $this->question;
        $faq->answer = $this->answer;
        $faq->save();

        $this->question="";
        $this->answer="";
        $this->edit_faq_id="";
        session()->flash('message', 'FAQ Updated Successfully.');

        $this->button_text = "Create FAQ";

    }

    public function delete($id) {
        ModelsFaq::findOrFail($id)->delete();

        $this->question="";
        $this->answer="";

        session()->flash('message','FAQ Deleted Successfully.');
    }

    public function render()
    {
        return view('livewire.admin.faq',[
            'faqs' => ModelsFaq::latest()->paginate(30)
        ])->layout('admin.layouts.wire_app');
    }
}
