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
            'easyexit'             => $this->boolean()->defaultValue(false),
            'active'               => $this->boolean()->defaultValue(true),
            'created_at'           => $this->integer(),
            'updated_at'           => $this->integer()
        ]);        

        $this->insert('TB_PARKING_LOT',['permit'=>'Lot 54',
                                 'address'=>'Bizzell St, College Station',
                                 'place'=>'{"lat":30.61959570451994,"lng":-96.33708894252777}',
                                 'night'=>1,
                                 'summer'=>1,
                                 'football'=>0,
                                 'construction'=>0,
                                 'easyparking'=>1,
                                 'easyexit'=>1
                                 ]);
        $this->insert('TB_PARKING_LOT',['permit'=>'Lot 55',
                                 'address'=>'Lamar St, College Station',
                                 'place'=>'{"lat":30.6178045069597,"lng":-96.3355815410614}',
                                 'night'=>1,
                                 'summer'=>1,
                                 'football'=>1,
                                 'construction'=>0,
                                 'easyparking'=>1,
                                 'easyexit'=>1
                                 ]);
                                 
        $this->insert('TB_PARKING_LOT',['permit'=>'Lot 47',
                                 'address'=>'Polo Rd, College Station',
                                 'place'=>'{"lat":30.621700780938745,"lng":-96.33723378181458}',
                                 'night'=>1,
                                 'summer'=>1,
                                 'football'=>1,
                                 'construction'=>0,
                                 'easyparking'=>0,
                                 'easyexit'=>1
                                 ]);
                                 
        $this->insert('TB_PARKING_LOT',['permit'=>'Lot 65',
                                 'address'=>'161 Wellborn Rd, College Station',
                                 'place'=>'{"lat":30.60933741841523,"lng":-96.34209930896759}',
                                 'night'=>1,
                                 'summer'=>0,
                                 'football'=>0,
                                 'construction'=>0,
                                 'easyparking'=>1,
                                 'easyexit'=>0
                                 ]);
        $this->insert('TB_PARKING_LOT',['permit'=>'Lot 50',
                         'address'=>'Polo Rd, College Station',
                         'place'=>'{"lat":30.623381116101353,"lng":-96.33749127388} ',
                         'night'=>1,
                         'summer'=>1,
                         'football'=>0,
                         'construction'=>0,
                         'easyparking'=>1,
                         'easyexit'=>1
                                 ]);    
    }

    public function safeDown()
    {
        $this->dropTable('TB_PARKING_LOT');
    }   
}
