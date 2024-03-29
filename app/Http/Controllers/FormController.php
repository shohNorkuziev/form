<?php

namespace App\Http\Controllers;

use App\Exports\FormExport;
use App\Models\Answer;
use App\Models\Form;
use App\Models\Otvet;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class FormController extends Controller
{

    public function index()
    {
        $form=Form::orderBy('created_at', 'desc')->get();
        $user = Auth::user();
        $data=[
            'naw'=>true,
            'background'=>$user->theme->image->path,
            'active'=>'form',
            'form'=>$form->map(function($item) {
                return[
                    'id'=>$item->id,
                    'title'=>$item->title,
                    'author'=>$item->user->first_name.' '.$item->user->last_name,
                    'background'=>$item->theme->image->path,
                    'created_at'=>$item->created_at,
                ];
            })
        ];
        return view('admin.index')->with('data',$data);
    }

    public function create()
    {
        $user = Auth::user();
        $theme=Theme::all();
        $data=[
            'naw'=>true,
            'background'=>$user->theme->image->path,
            'theme'=>$theme,
        ];
        return view('admin.create')->with('data',$data);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Form $form)
    {
        $user = Auth::user();
        $data=[
            'naw'=>true,
            'background'=>$user->theme->image->path,
            'title'=> $form->title,
            'questionnaires'=> $form->questionnaire->map(function($item) {
                return [
                    'id' => $item->id,
                    'answers'=>$item->answer->map(function($item1) {
                        return[
                            'answer'=>$item1->answer,
                            'question'=>$item1->question->question
                        ];
                    })
                ];
            })
        ];
        return view('admin.show')->with('data',$data);
    }

    public function edit(Form $form)
    {
        //
    }

    public function update(Request $request, Form $form)
    {

    }

    public function destroy(Form $form)
    {
        $form->delete();

        return redirect()->route('index');
    }
    public function showform(Form $form)
    {
        $data=[
            'footer'=>true,
            'id' => $form->id,
            'title' => $form->title,
            'background' => $form->theme->image->path,
            'page'=>$form->page->map(function($item) {
                return[
                    'page'=>$item->page,
                    'questions' => $item->question->map(function($item1) {
                        return [
                            'id' => $item1->id,
                            'question' => $item1->question,
                            'required' => $item1->required,
                            'comment' => $item1->comment,
                            'type' => $item1->type,
                            'option'=>$item1->option->map(function($item2) {
                                return $item2->option;
                            })
                        ];
                    })
                ];
            })

        ];
        return view('user.form')->with('data',$data);
    }
    public function questionnaire(Request $request){
        $questionnaire=Questionnaire::create(["form_id"=>$request->id]);
        foreach($request->question as $key => $value){
            $answer='';
            if(isset($value['value'])){
                foreach($value['value'] as $key1 => $value1){
                    $answer.=($key1==0?$value1:'|'.$value1);
                }
            }
            Answer::create(["questionnaire_id"=>$questionnaire->id,"question_id"=>$value['id'],"answer"=>$answer]);
        }
        return redirect()->route('successform',['form' => $request->id]);
    }

    public function export(Form $form)
    {
        return Excel::download(new FormExport($form), $form->title.'.xlsx');
    }
    public function successform(Form $form){
        $data=[
            'id' => $form->id,
            'title' => 'Спасибо!',
            'background' => $form->theme->image->path,
        ];
        return view('user.successform')->with('data',$data);
    }

    //добавление форм
    public function saveData(Request $request)
    {
        // Проверка и валидация данных формы
        $validatedData = $request->validate([
            'title' => 'required|string',
            'theme_id' => 'required|integer',
        ]);

        // Сохранение основной информации о форме
        $form = Form::create([
            'title' => $validatedData['title'],
            'theme_id' => $validatedData['theme_id'],
            'user_id'=>1
        ]);

        // Добавление вопросов
        foreach ($request->question_text as $key => $questionText) {
            $question = Question::create([
                'question' => $questionText,
                'comment'=> $request->question_comment,
                'type' => $request->field_type[$key],
                'required' => $request->required[$key],
            ]);

            // Добавление ответов на вопросы
            if ($request->field_type[$key] == 'select') {
                foreach ($request->field_values[$key] as $index => $value) {
                    Otvet::create([
                        'question_id' => $question->id,
                        'answer_text' => $value,
                        'points' => $request->points[$key][$index],
                    ]);
                }
            }
        }

        // Вернуть успешный ответ или перенаправить пользователя
        return redirect()->back()->with('success', 'Данные формы успешно сохранены.');
    }
}
