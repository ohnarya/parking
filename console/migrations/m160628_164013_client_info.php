<?php

use yii\db\Migration;

class m160628_164013_client_info extends Migration
{
    public function up()
    {
        $this->createTable('TB_CLIENT', [
            'id'        => $this->primaryKey(),
            'userid'    => $this->integer(),
            'ip'        => $this->string()->notNull(),
            'key'       => $this->string(),
            'created_at' => $this->dateTime()
        ]);         
    }

    public function down()
    {
        $this->dropTable('TB_CLIENT');

        return true;
    }

}
