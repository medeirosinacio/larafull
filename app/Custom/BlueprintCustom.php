<?php

namespace App\Custom;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BlueprintCustom
{

    public function commonFields()
    {

    }

    public static function register()
    {
        Blueprint::macro('commonFields', function () {
            $this->timestamp('created_at')->useCurrent()->comment('Data de criação');
            $this->timestamp('updated_at')->nullable()->comment('Data de modificação');
            $this->timestamp('deleted_at')->nullable()->comment('Data de exclusão');

        });

        Blueprint::macro('userControl', function () {
            if (Schema::hasColumn('users', 'id')) {
                $this->unsignedBigInteger('created_by')->comment('Criado por');
                $this->unsignedBigInteger('updated_by')->nullable()->comment('Atualizado por');
                $this->unsignedBigInteger('deleted_by')->nullable()->comment('Excluido por');
                $this->foreign('created_by')->references('id')->on('users');
                $this->foreign('updated_by')->references('id')->on('users');
                $this->foreign('deleted_by')->references('id')->on('users');
            }
        });
    }

}
