<?php

use yii\db\Migration;

class m160623_154104_parkinglot extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('TB_PARKING_LOT', [
            'id'                   => $this->primaryKey(),
            'permit'               => $this->string(50)->notNull()->unique(),
            'address'              => $this->string(),
            'place'                => $this->string(),
            'night'                => $this->boolean()->defaultValue(true),
            'summer'               => $this->boolean()->defaultValue(true),
            'football'             => $this->boolean()->defaultValue(true),
            'construction'         => $this->boolean()->defaultValue(false),
            'easyparking'          => $this->boolean()->defaultValue(false),
            'active'               => $this->boolean()->defaultValue(true),
            'created_at'           => $this->integer()->notNull(),
            'updated_at'           => $this->integer()->notNull(),
        ]);        
    }

    public function safeDown()
    {
        $this->dropTable('TB_PARKING_LOT');
    }   
}
