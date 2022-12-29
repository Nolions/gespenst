<?php

namespace App\Services;

use App\Models\KolbStyle;
use App\Models\LseAnswer;
use App\Repositories\KolbStyleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lse
{
    private KolbStyleRepository $kolbStyleRepo;

    public function __construct(KolbStyleRepository $kolbStyleRepo)
    {
        $this->kolbStyleRepo = $kolbStyleRepo;
    }

    /**
     * 取得lse問券
     *
     * @return array
     */
    public function questions(): array
    {
        return lse()->questionList();
    }

    /**
     * 填寫問券&學習風格分析
     *
     * @param string $userId
     * @param array $answers
     * @return array
     */
    public function reply(string $userId, array $answers): array
    {
        $scoreCE = 0; // 具體的經驗
        $scoreRO = 0; // 省思的觀察
        $scoreAC = 0; // 抽象的概念
        $scoreAE = 0; // 主動的實驗

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
        return $this->kolbStyleRepo->getStyleByUser($userId)->toArray();
    }


    private function createAnswerModel(string $userId, int $questionId, int $ansOptionId): Model
    {
        $model = new LseAnswer();
        $model->user_id = $userId;
        $model->question_id = $questionId;
        $model->ansOption_id = $ansOptionId;

        return $model;
    }

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
