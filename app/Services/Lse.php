<?php

namespace App\Services;

use App\Models\KolbStyle;
use App\Models\LseAnswer;
use App\Repositories\KolbStyleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lse
{
    /**
     * @var KolbStyleRepository
     */
    private KolbStyleRepository $kolbStyleRepo;

    public function __construct(KolbStyleRepository $kolbStyleRepo)
    {
        $this->kolbStyleRepo = $kolbStyleRepo;
    }

    /**
     * 取得lse問卷
     *
     * @return array
     */
    public function questions(): array
    {
        return lse()->questionList();
    }

    /**
     * 填寫問卷&學習風格分析
     *
     * @param string $userId
     * @param array $answers
     * @return array
     */
    public function reply(string $userId, array $answers): array
    {
        $scoreCE = 0; // 分散者
        $scoreRO = 0; // 同化者
        $scoreAC = 0; // 收斂者
        $scoreAE = 0; // 調適者

        DB::beginTransaction();
        foreach ($answers as $key => $value) {
            // 儲存使用者LSE問卷答案
            $answer = $this->createAnswerModel($userId, $key, $value);
            if (!$answer->save()) {
                DB::rollBack();
//             TODO Exception
            }

            // 計算Kolb Learn Style各個面向得分
            $score = lse()->score($value);
            switch (lse()->questionStyle($key)['id']) {
                case 1:
                    $scoreCE = $scoreCE + $score;
                    break;
                case 2:
                    $scoreRO += $score;
                    break;
                case 3:
                    $scoreAC += $score;
                    break;
                case 4:
                    $scoreAE += $score;
                    break;
            }
        }

        // 儲存Kolb Learn Style風格
        $kolbStyleModel = $this->createKolbStyleModel($userId, $scoreCE, $scoreRO, $scoreAC, $scoreAE);
        if (!$kolbStyleModel->save()) {
            DB::rollBack();
            // TODO Exception
        }

        DB::commit();

        return [
            'CE' => $scoreCE,
            'RO' => $scoreRO,
            'AC' => $scoreAC,
            'AE' => $scoreAE,
        ];
    }

    /**
     * 取得會員學習風格評估結果
     *
     * @param string $userId
     * @return array
     */
    public function getUserStyle(string $userId): array
    {
        $style = $this->kolbStyleRepo->getStyleByUser($userId);
        if (is_null($style)) {
            return [];
        }
        return $style->toArray();
    }

    /**
     * 列出管理者以外學習者學習風格
     *
     * @param string|null $style
     * @return array
     */
    public function allUsers(?string $style = ""): array
    {
        $data = $this->kolbStyleRepo->getAll($style);
        $items = collect($data->items())->map(function ($scores) {
            $styles = [
                'ce' => $scores->ce_score,
                'ro' => $scores->ro_score,
                'ac' => $scores->ac_score,
                'ae' => $scores->ae_score,
            ];

            $style = array_search(max($styles), $styles);
            $data = $scores->toArray();
            $data['style'] = getStyleName($style);

            return $data;
        })->filter(function ($item) {
            return $item['user_id'] != 'administrator';
        })->toArray();
        return [
            'users' => $items,
            'paginate' => $data,
        ];
    }

    /**
     * 建立LseAnswer Model
     *
     * @param string $userId
     * @param int $questionId
     * @param int $ansOptionId
     * @return Model
     */
    private function createAnswerModel(string $userId, int $questionId, int $ansOptionId): Model
    {
        $model = new LseAnswer();
        $model->user_id = $userId;
        $model->question_id = $questionId;
        $model->ansOption_id = $ansOptionId;

        return $model;
    }

    /**
     * 建立KolbStyle Model
     *
     * @param string $userId
     * @param int $scoreCE
     * @param int $scoreRO
     * @param int $scoreAC
     * @param int $scoreAE
     * @return Model
     */
    private function createKolbStyleModel(string $userId, int $scoreCE, int $scoreRO, int $scoreAC, int $scoreAE): Model
    {
        $model = new KolbStyle();
        $model->user_id = $userId;
        $model->ce_score = $scoreCE;
        $model->ro_score = $scoreRO;
        $model->ac_score = $scoreAC;
        $model->ae_score = $scoreAE;

        return $model;
    }
}
