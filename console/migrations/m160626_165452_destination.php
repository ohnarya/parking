<?php

use yii\db\Migration;

class m160626_165452_destination extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('TB_DESTINATION', [
            'id'                   => $this->primaryKey(),
            'name'                 => $this->string(50)->notNull()->unique(),
            'address'              => $this->string(),
            'lat'                  => $this->string(),
            'lng'                  => $this->string(),
            'active'               => $this->boolean()->defaultValue(true),
            'created_at'           => $this->integer()->notNull(),
            'updated_at'           => $this->integer()->notNull(),
        ]);        
    }

    public function safeDown()
    {
        $this->dropTable('TB_DESTINATION');
    }  
}
