<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonCloseCollection;
use App\Http\Resources\LessonOpenCollection;
use App\Http\Resources\LessonOpenResource;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return LessonOpenCollection
     */
    public function indexOpen()
    {
        //Вернуть только пройденные лекции и следующую если надо
        return new LessonOpenCollection( Lesson::query()->where('id', '<=', self::checkLastLesson())->get());
    }

    public function indexClose()
    {
        //Вернуть только закрытые лекции и следующую если надо
        return new LessonCloseCollection( Lesson::query()->where('id', '>', self::checkLastLesson())->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return LessonOpenResource
     */
    public function show(Lesson $lesson)
    {
        return new LessonOpenResource($lesson);
    }

    public function rate(Lesson $lesson, Request $request)
    {
        switch ($request->value) {
            case 'bad':
                $lesson->update(['bad' => DB::raw('bad+1')]);
                break;
            case 'normal':
                $lesson->update(['normal' => DB::raw('normal+1')]);
                break;
            case 'great':
                $lesson->update(['great' => DB::raw('great+1')]);
                break;
            default:
                break;
        }
    }

    //Фиксация просмотра лекции
    public function view($lesson_id)
    {
        //Проверяем есть ли лекция в базе просмотренных, если нет - добавляем. Если есть - игнорируем
        $check = Auth::user()->lessons->where('id', $lesson_id);
        if(!$check->count()) {
            Auth::user()->lessons()->attach([$lesson_id]);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }

    static function checkLastLesson()
    {
        $correct_user_id = Auth::id(); //Берём текущего пользователя

        $last_lesson = User::query()->find($correct_user_id)->lessons->last(); //Ищем последнюю пройденную лекцию этого пользователя
        //dd($last_lesson = User::query()->find($correct_user_id)->lessons->sortByDesc('created_at')->toArray());

        $id_last_lesson = $last_lesson->id ?? null; //Фиксируем id найденной лекции, а если такой нет - ставим null

        if($id_last_lesson !== null) {
            //Если последняя лекция найдена - мы проверяем дату сдачи
            $date_last_lesson = $last_lesson->pivot->created_at->format('d-m-Y');
            $today = Date::now()->format('d-m-Y');

            if($date_last_lesson < $today) {
                //Если дата сдачи последней лекции меньше за сегодня - мы открываем доступ к следующей лекции
                $last_open_lesson_id = $id_last_lesson + 1;
            } else {
                //Если нет оставляем последней открытой эту лекцию
                $last_open_lesson_id = $id_last_lesson;
            }
        } else {
            //Если последняя лекция не найдена, значит даём доступ только к первой лекции.
            $last_open_lesson_id = 1;
        }
        return $last_open_lesson_id;
    }
}
