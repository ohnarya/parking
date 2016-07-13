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
            'place'                => $this->string(),
            'history'              => $this->string(),
            'active'               => $this->boolean()->defaultValue(true),
            'created_at'           => $this->integer(),
            'updated_at'           => $this->integer(),
        ]);  

        $this->insert('TB_DESTINATION',['name'=>'ARCC',
                         'address'=>'Architecture Center Bldg C, 3137 TAMU, College Station',
                         'place'=>'{"lat":30.61928178569322,"lng":-96.33798748254776}',
                                 ]);   
                                 
        $this->insert('TB_DESTINATION',['name'=>'HRBB',
                         'address'=>'Harvey R. "Bum" Bright Building, College Station',
                         'place'=>'{"lat":30.618963249372637,"lng":-96.33888334035873}',
                                 ]);   
        $this->insert('TB_DESTINATION',['name'=>'KYLE',
                         'address'=>'161 Wellborn Rd, College Station',
                         'place'=>'{"lat":30.610048423790147,"lng":-96.3405168056488} ',
                                 ]);   
                                 
        $this->insert('TB_DESTINATION',['name'=>'EVANS',
                         'address'=>'Sterling C. Evans Library, 0468 Spence St, College Station',
                         'place'=>'{"lat":30.61672423261684,"lng":-96.33948147296906}',
                                 ]);   
        $this->insert('TB_DESTINATION',['name'=>'REC Center',
                         'address'=>'1544 Wellborn Rd, College Station',
                         'place'=>'{"lat":30.607278243529223,"lng":-96.34266257286072}',
                                 ]);  
    }

    public function safeDown()
    {
        $this->dropTable('TB_DESTINATION');
    }  
}
