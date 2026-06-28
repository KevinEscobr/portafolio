<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'description', 'tags', 'image_path', 'github_url', 'live_url', 'order'])]
class Project extends Model
{
    use HasFactory;

    /**
     * Get tags as an array.
     *
     * @return array
     */
    public function getTagsArrayAttribute(): array
    {
        if (empty($this->tags)) {
            return [];
        }
        return array_filter(array_map('trim', explode(',', $this->tags)));
    }
}
