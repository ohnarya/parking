<?php

use yii\db\Migration;

class m160623_154104_parkinglot extends Migration
{
    // public function up()
    // {

    // }

    // public function down()
    // {
    //     echo "m160623_154104_parkinglot cannot be reverted.\n";

    //     return false;
    // }

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('TB_PARKING_LOT', [
            'id'                   => $this->primaryKey(),
            // 'symbol'               => $this->string()->notNull()->unique(),
            'name'                 => $this->string(50)->notNull()->unique(),
            'lat'                  => $this->string(),
            'lng'                  => $this->string(),
            'night'                => $this->boolean()->defaultValue(true),
            'summer'               => $this->boolean()->defaultValue(true),
            'football'             => $this->boolean()->defaultValue(true),
            'construction'         => $this->boolean()->defaultValue(false),
            'active'               => $this->boolean()->defaultValue(true),
            'created_at'           => $this->integer()->notNull(),
            'updated_at'           => $this->integer()->notNull(),
        ], $tableOptions);        
    }

    public function safeDown()
    {
        $this->dropTable('TB_PARKING_LOT');
    }   
}
