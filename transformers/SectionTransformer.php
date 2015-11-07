<?php
namespace app\transformers;

use app\models\gii\Section;
use League\Fractal;

class SectionTransformer
{
    public function transform(Section $s)
    {
        return [
            'meta' => json_decode($s->meta),
            'landing_id' => $s->landing_id,
            'type' => strtolower($s->sectionTemplate->title)
        ];
    }
}
