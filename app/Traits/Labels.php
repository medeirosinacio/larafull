<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Labels
{
    public function getAttributeLabel(string $attribute): string
    {
        return $this->hasDefinedLabel($attribute) ?
            $this->getDefinedLabel($attribute) : $this->createLabelFromAttribute($attribute);
    }


    private function attributes(): array
    {
        return [
            'id' => 'ID'
        ];
    }


    private function getDefinedLabel(string $attribute): string
    {
        return $this->attributes()[$attribute];
    }


    private function hasDefinedLabel(string $attribute): string
    {
        return !empty($this->attributes()[$attribute]);
    }


    private function createLabelFromAttribute(string $attribute): string
    {
        return Str::of($attribute)->replace('_', ' ')->ucfirst()->trans();
    }

}
