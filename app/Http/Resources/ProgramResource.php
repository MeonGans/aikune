<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //Блок цели и дополнительный блок с информацией для двух целей
        $aim = [
            1 => [
                'aim_title' => 'Исправить осанку',
                'aim_extra_view' => false,
            ],
            2 => [
                'aim_title' => 'Убрать боль в спине',
                'aim_extra_view' => false,
            ],
            3 => [
                'aim_title' => 'Красивая фигура',
                'aim_extra_view' => true,
                'extra_text' => 'Сутулость выглядит некрасиво визуально,создаёт чувство неуверенности в себе и своей красоте, а с возрастом появляется горб и холка со вторым подбородком',
            ],
            4 => [
                'aim_title' => 'Энергия и продуктивность',
                'aim_extra_view' => true,
                'aim_extra_text' => 'Нарушения и зажатости в позвоночнике являются главной причиной хронической усталости, отсутствию сил и упадку настроения. Через пару лет человек не может думать ни о чём, кроме болей в спине.',
            ],
        ];

        $pain_extra_info_map = [
            2 => [
                'title' => 'Шея',
                'text' => 'Перенапряжение  в шейном отделе приводит к головным болям, нарушению зрению. Хруст и постоянный дискомфорт в шее являют причиной появления мигрени, панических атак, остеохондроза и других заболеваний',
            ],
            5 => [
                'title' => 'Живот',
                'text' => 'Кривая спина и неправильное перераспределение веса являются главной причиной торящего живота, который нельзя убрать с помощью диет и обычных тренировок',
            ],
            6 => [
                'title' => 'Поясница',
                'text' => 'Постоянное напряжение и тянущая боль в пояснице может привести к появлению грыж,  протрузии и других осложнений',
            ],
            8 => [
                'title' => 'Колени',
                'text' => 'Из-за нарушения осанки с годами появляется тяжесть в ногах, боль в коленях и суставах при ходьбе',
            ],
        ];

        $pain = [];
        $pain['pain_extra_info_check'] = false;
        //Блок области боли, вывод только в случае четырех вариантов
        for ($i = 1; $i <= 8; $i++) {
            if ($this->s8_attention == $i) {
                $pain['v' . $i] = true;
                if ($i == 2 or $i == 5 or $i == 6 or $i == 8) {
                    $pain['pain_extra_info_check'] = true;
                    $pain['pain_extra_info'] = $pain_extra_info_map[$i]['text'];
                    $pain['pain_extra_title'] = $pain_extra_info_map[$i]['title'];
                }
            } else {
                $pain['v' . $i] = false;
            }
        }


        return [
            'id' => $this->id,
            'device_id' => $this->device_id,
            'aim' => $aim[$this->aim],
            'pain' => $pain,
        ];
    }
}
