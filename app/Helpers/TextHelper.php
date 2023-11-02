<?php


namespace App\Helpers;


use App\Models\Text;
use App\Models\Title;

final class TextHelper
{

    /**
     * @param $titleId
     * @return array[]
     */
    public static function getOneTextArrayByTitleId($titleId): array
    {
        $text = [
            'text' => Text::where('title_id', $titleId)
                ->pluck('text')
                ->toArray()
        ];
        $title = Title::find($titleId);
        return self::getArrayTextByView($text, $title->title,'test', $title->created_at);
    }

    /**
     * @param $texts
     * @param $title
     * @return array[]
     */
    public static function getArrayTextByView($texts, $title, $author = null, $created_at = null): array
    {
        $items = [$title => []];

        foreach ($texts as $text) {
            $items[$title] += $text;
        }

        $items[$title]['author'] = $author;
        $items[$title]['created_at'] = $created_at;

        return $items;
    }
}
