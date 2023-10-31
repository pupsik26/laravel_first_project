<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Text extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'user_id',
        'title_id',
    ];


    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function title(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Title::class, 'id', 'title_id');
    }

    public static function getGroupTexts()
    {
        /* @var Text $item */
        $data = [];
        foreach (self::all() as $item) {
            if (!isset($data[$item->title->id][$item->title->title])) {
                $data[$item->title->id][$item->title->title][] = $item->text;
                $data[$item->title->id][$item->title->title]['author'] = $item->user->name;
                $data[$item->title->id][$item->title->title]['created_at'] = $item->title->created_at;
            } else {
                $data[$item->title->id][$item->title->title][] = $item->text;
            }
        }
        return $data;
    }

    public static function saveArray(array $texts, int $title_id)
    {
        foreach ($texts as $text) {

            if (empty(strip_tags($text))) {
                continue;
            }

            $model = new self([
                'text' => $text,
                'user_id' => Auth::id(),
                'title_id' => $title_id
            ]);
            $model->save();
        }
    }

}
