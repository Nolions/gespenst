<?php

namespace App\Services;

use App\Models\Tag as TagModel;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Model;

class Tag
{
    private TagRepository $tagRepo;

    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepo = $tagRepo;
    }

    function Create(string $name): Model
    {
        $tag = $this->tagRepo->findByName($name);

        if ($tag == null) {
            $tag = new TagModel();
            $tag->name = $name;
            $tag->save();
        }

        return $tag;
    }
}
