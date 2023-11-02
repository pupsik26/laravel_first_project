<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Text
 *
 * @property int $id
 * @property string $text Текст
 * @property int $user_id Кто создал
 * @property int $title_id Название текста
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Title|null $title
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\TextFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Text newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Text newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Text query()
 * @method static \Illuminate\Database\Eloquent\Builder|Text whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Text whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Text whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Text whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Text whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Text whereUserId($value)
 * @mixin \Eloquent
 */
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
