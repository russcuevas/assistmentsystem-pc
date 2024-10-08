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
            ->select('questions.id', 'questions.question_text', 'questions.riasec_id', 'riasecs.riasec_name as riasec_name',  'riasecs.description as riasec_description')
            ->get();

        $options = DB::table('options')->get();

        return view('admin.questionnaire.questionnaire', compact('riasecs', 'questions', 'options'));
    }

    public function AddQuestionnaire(Request $request)
    {
        $validated_data = $request->validate([
            'question_text' => 'required|string|max:255',
            'riasec_id' => 'required|exists:riasecs,id',
            'option_text' => 'required|string|max:1',
            'is_correct' => 'required|boolean',
        ]);

        $question = Question::create([
            'question_text' => $validated_data['question_text'],
            'riasec_id' => $validated_data['riasec_id'],
        ]);

        Option::create([
            'question_id' => $question->id,
            'option_text' => $validated_data['option_text'],
            'is_correct' => $validated_data['is_correct'],
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
        $validated_data = $request->validate([
            'question_text' => 'required|string|max:255',
            'riasec_id' => 'required|exists:riasecs,id',
            'option_text' => 'required|string|max:1',
        ]);

        DB::table('questions')->where('id', $id)->update([
            'question_text' => $validated_data['question_text'],
            'riasec_id' => $validated_data['riasec_id'],
        ]);

        DB::table('options')->where('question_id', $id)->update([
            'option_text' => $validated_data['option_text'],
            'is_correct' => 1,
        ]);

        return redirect()->route('admin.questionnaire.page')->with('success', 'Question updated successfully!');
    }



    public function DeleteQuestionnaire($id)
    {
        DB::table('responses')->where('question_id', $id)->delete();
        DB::table('options')->where('question_id', $id)->delete();
        DB::table('questions')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Question deleted successfully!');
    }
}
