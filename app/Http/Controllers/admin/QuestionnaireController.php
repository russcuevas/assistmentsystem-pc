<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use App\Models\Riasec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionnaireController extends Controller
{
    public function QuestionnairePage()
    {
        $riasecs = Riasec::all();
        $questions = DB::table('questions')
            ->join('riasecs', 'questions.riasec_id', '=', 'riasecs.id')
            ->select('questions.id', 'questions.question_text', 'questions.riasec_id', 'riasecs.description as riasec_description')
            ->get();
    
        $options = DB::table('options')->get();
    
        return view('admin.questionnaire.questionnaire', compact('riasecs', 'questions', 'options'));
    }

    public function AddQuestionnaire(Request $request)
    {
        $validatedData = $request->validate([
            'question_text' => 'required|string|max:255',
            'riasec_id' => 'required|exists:riasecs,id',
            'option_text' => 'required|string|max:1',
            'is_correct' => 'required|boolean',
        ]);

        $question = Question::create([
            'question_text' => $validatedData['question_text'],
            'riasec_id' => $validatedData['riasec_id'],
        ]);

        Option::create([
            'question_id' => $question->id,
            'option_text' => $validatedData['option_text'],
            'is_correct' => $validatedData['is_correct'],
        ]);

        return redirect()->back()->with('success', 'Question added successfully!');
    }

    public function EditQuestionnaire($id)
    {
        $riasecs = Riasec::all();
        $question = DB::table('questions')->where('id', $id)->first();
        $options = DB::table('options')->where('question_id', $id)->get();

        return view('admin.questionnaire.edit_questionnaire', compact('riasecs', 'question', 'options'));
    }

    public function UpdateQuestionnaire(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question_text' => 'required|string|max:255',
            'riasec_id' => 'required|exists:riasecs,id',
            'option_text' => 'required|string|max:1',
        ]);

        DB::table('questions')->where('id', $id)->update([
            'question_text' => $validatedData['question_text'],
            'riasec_id' => $validatedData['riasec_id'],
        ]);

        DB::table('options')->where('question_id', $id)->update([
            'option_text' => $validatedData['option_text'],
            'is_correct' => 1,
        ]);

        return redirect()->route('admin.questionnaire.page')->with('success', 'Question updated successfully!');
    }



    public function DeleteQuestionnaire($id)
    {
        $options = DB::table('options')->where('question_id', $id)->pluck('id');
        DB::table('responses')->whereIn('selected_option_id', $options)->delete();
        DB::table('options')->where('question_id', $id)->delete();
        DB::table('questions')->where('id', $id)->delete();
    
        return redirect()->back()->with('success', 'Question deleted successfully!');
    }
    
}
