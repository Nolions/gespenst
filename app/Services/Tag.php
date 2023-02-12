<?php

namespace App\Services;

use App\Models\Tag as TagModel;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

class Tag
{
    /**
     * @var TagRepository
     */
    private TagRepository $tagRepo;


    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepo = $tagRepo;
    }

    /**
     * 建立標籤
     * ==============
     * 當標籤不存在時則建立新標籤
     *
     * @param string $name
     * @return Model
     */
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

    public function all():array
    {
        return $this->tagRepo->all()->toArray();
    }
}
