<?php

use Illuminate\Database\Seeder;

class OperationssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Illuminate\Support\Facades\DB::insert("insert into \"operations\"(\"Operation\",\"Zone\",\"Type\") values
        ('A Reparer','Z02',''),
('A Meuler','Z02',''),
('A Reparer','Z03',''),
('Rebut','Z02',''),
('Déclassé','Z03',''),
('A MEULE','Z09',''),
('RX1','Z03',''),
('CF','Z09',''),
('Déclassé En Epaiss','Z02',''),
('Meulé','Z04',''),
('Déclassé','Z02',''),
('Rev.Int Bon','Z11',''),
('OK','Z09',''),
('Rev. Int Refusé','Z11',''),
('Revetus','Z12',''),
('D.T.P','Z02',''),
('En Instance','Z02',''),
('Contrôlé','Z02',''),
('A Meuler','Z03',''),
('Consigné Acier','Z12',''),
('Réparé','Z04',''),
('Revetus.Int','Z11',''),
('Reparé','Z02',''),
('Rebuté','Z03',''),
('Déclassé','Z04',''),
('CB HT','Z12',''),
('Meuler','Z03',''),
('Debloqué PE','Z12',''),
('A Chuté','Z02',''),
('Meulé','Z02',''),
('R.A.S','Z02',''),
('A Decortiquer','Z12',''),
('Vérification de lEpaisseur','Z09',''),
('SD Ok','Z03',''),
('A REPARE','Z09',''),
('Consigné PE','Z12',''),
('A CHUTE','Z09',''),
('OK','Z02',''),
('Rev. Ext. Bon','Z12',''),
('Chuté','Z03',''),
('Decortiqué','Z12',''),
('A Réparer','Z10','Soudure'),
('A Chuter','Z10','Soudure'),
('A Meuler','Z10','Soudure')

        ");
    }
}
