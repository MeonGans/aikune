<?php

namespace App\Http\Controllers;

use App\Http\Resources\SurveyCollection;
use App\Http\Resources\SurveyResource;
use Illuminate\Http\Request;
use App\Models\Survey;
use function MongoDB\BSON\toJSON;

class SurveyController extends Controller
{
    protected Survey $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    /**
     * Display a listing of the resource.
     *
     * @return SurveyResource
     */
    public function index(Request $request): SurveyCollection
    {
        return new SurveyCollection($this->survey->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): SurveyResource
    {
        // Проверяем есть ли запись с таким device_id.
//        Если нет - создаём новую запись учитывая переменные $step $value $device_id
        // Если есть - обновляем существующую запись, а точнее ячейку $step и меняем значение на $value

        $survey = Survey::query()->updateOrCreate(
            ['device_id' => $request->device_id],
            [$request->step => $request->value],
        );
//        if(Survey::query()->where('device_id', $request->device_id)->exists()) {
//            $survey = $this->survey->query()->where('device_id', $request->device_id)->update([$request->step => $request->value]);
//            $survey = $this->survey->query()->where('device_id', $request->device_id)->updateOrCreate([$request->step => $request->value]);
//        } else {
//            $survey = $this->survey->query()->create([
//                'device_id' => $request->device_id ?? 111,
//                $request->step => $request->value]);
//        }

        return new SurveyResource($survey);
    }

    public function info(Request $request): SurveyResource
    {
        // Проверяем есть ли запись с таким device_id.
//        Если нет - создаём новую запись учитывая переменные $step $value $device_id
        // Если есть - обновляем существующую запись, а точнее ячейку $step и меняем значение на $value

        $survey = Survey::query()->updateOrCreate(
            ['device_id' => $request->device_id],
            [
                'age' => $request->age,
                'weight' => $request->weight,
                'height' => $request->height,
            ],
        );
//        if(Survey::query()->where('device_id', $request->device_id)->exists()) {
//            $survey = $this->survey->query()->where('device_id', $request->device_id)->update([$request->step => $request->value]);
//            $survey = $this->survey->query()->where('device_id', $request->device_id)->updateOrCreate([$request->step => $request->value]);
//        } else {
//            $survey = $this->survey->query()->create([
//                'device_id' => $request->device_id ?? 111,
//                $request->step => $request->value]);
//        }

        return new SurveyResource($survey);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SurveyResource
     */
    public function show(Request $request): SurveyResource
    {
        $survey = Survey::query()->where('device_id', $request->device_id)->first();
        return new SurveyResource($survey);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
