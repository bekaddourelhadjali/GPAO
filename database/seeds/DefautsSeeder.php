<?php

use Illuminate\Database\Seeder;

class DefautsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::insert("insert into \"defauts\"(\"Defaut\",\"Zone\",\"Type\") values
('Arach Sur Rive','Z04','Metal'),
('SI','Z02','Soudure'),
('SI/SCVXE','Z03','Soudure'),
('MM','Z02','Metal'),
('PRC/Y','Z02','Soudure'),
('MB','Z02','Metal'),
('OVL','Z02','Metal'),
('EPT','Z02','Metal'),
('MM','Z04','Metal'),
('F','Z02','Soudure'),
('GM Ext','Z02','Metal'),
('MM Ext','Z02','Metal'),
('PRC/E','Z03','Soudure'),
('GB','Z04','Metal'),
('décortiqué','Z12',''),
('EPROUV','Z05',''),
('SI','Z04','Soudure'),
('GM HT/F','Z02','Metal'),
('Diam HT (-)/F','Z02','Metal'),
('BUC','Z03','Soudure'),
('Mauv Asp Cor','Z02','Metal'),
('Rep < Diam','Z02','Metal'),
('Ouvert Tole','Z02','Metal'),
('E','Z04','Soudure'),
('HTC Ext','Z02','Metal'),
('BUC/Y','Z03','Soudure'),
('RAS','Z11',''),
('SD','Z09',''),
('F Ext','Z02','Soudure'),
('BU','Z09',''),
('Empreinte Int','Z04','Metal'),
('DL/E','Z03','Soudure'),
('ND/F','Z02','Metal'),
('Test(2)','Z02','Metal'),
('Diam HT (+)','Z02','Metal'),
('DL','Z03','Soudure'),
('Test','Z02','Metal'),
('Hauteur Cord In','Z04','Soudure'),
('Empreinte Ext','Z04','Metal'),
('Enfoncement Int','Z04','Metal'),
('SCVEX','Z09',''),
('EY','Z02','Soudure'),
('EY','Z04','Soudure'),
('DL/Y','Z03','Soudure'),
('PRC/Y','Z04','Soudure'),
('RB+Defor/F','Z02','Metal'),
('PRC','Z04','Soudure'),
('PRC/E','Z02','Soudure'),
('BUC','Z04','Soudure'),
('Enfoncement Int','Z02','Metal'),
('Fin','Z02',''),
('SP','Z04','Soudure'),
('Y Long','Z03','Soudure'),
('SI/SCVE','Z02','Soudure'),
('ND','Z05',''),
('PRC/EY','Z05','Soudure'),
('GM HT/D','Z02','Metal'),
('MM HT/F','Z02','Metal'),
('Effet De Toil (B2)','Z04','Metal'),
('MB','Z04','Metal'),
('PRS','Z09',''),
('Rep > Diam/D','Z02','Soudure'),
('Z','Z09',''),
('Y Long','Z04','Soudure'),
('MAC','Z09',''),
('RB','Z05',''),
('F','Z09',''),
('SCVE','Z03','Soudure'),
('BU/E','Z03','Soudure'),
('BU','Z03','Soudure'),
('Serie DF','Z03','Soudure'),
('BA/E','Z03','Soudure'),
('DL/EY','Z03','Soudure'),
('SP','Z02','Soudure'),
('E','Z03','Soudure'),
('SCVXE','Z03','Soudure'),
('Y Long','Z02','Soudure'),
('Deformation (ok)','Z04','Metal'),
('Corrosion','Z02','Metal'),
('Hauteur Cord In','Z03','Soudure'),
('EB','Z09',''),
('HC','Z09',''),
('Corrosion','Z04','Metal'),
('Effet De Toil (B1)','Z02','Metal'),
('GM Int','Z02','Metal'),
('Hauteur Cord Ex','Z03','Soudure'),
('Enfoncement Ext','Z04','Metal'),
('Serie DF','Z04','Soudure'),
('Empreinte Ext','Z02','Metal'),
('RB /D','Z02','Metal'),
('ND HT','Z02','Metal'),
('SD Long Int','Z03','Soudure'),
('Rep > Diam','Z02','Metal'),
('PRC','Z02','Soudure'),
('RB+Defor/D','Z02','Metal'),
('BUC','Z09',''),
('Debut','Z02',''),
('BAC','Z03','Soudure'),
('OXYC.M','Z05',''),
('SD','Z04','Soudure'),
('BA','Z03','Soudure'),
('SCVXE','Z04','Soudure'),
('AA','Z09',''),
('VISUEL','Z05',''),
('MM HT/D','Z02','Metal'),
('BUC/EY','Z03','Soudure'),
('BAC/E','Z03','Soudure'),
('MB Ext','Z02','Metal'),
('BAC/Y','Z03','Soudure'),
('Aucun','Z09',''),
('PRC','Z09',''),
('PRC Ext','Z02','Soudure'),
('PRC/EY','Z02','Soudure'),
('GB','Z02','Metal'),
('DDB','Z04','Metal'),
('Empreinte Int','Z02','Metal'),
('Retour Grenaillage','Z11',''),
('Hauteur Cord Ex','Z02','Soudure'),
('OXM /F','Z02','Metal'),
('HT','Z05',''),
('SD Long Ext','Z03','Soudure'),
('SD Long Int','Z04','Soudure'),
('SD Long Ext','Z02','Soudure'),
('HTC Ext','Z04','Metal'),
('SD','Z03','Soudure'),
('SD Long Int','Z02','Soudure'),
('RAS','Z12',''),
('Tube Instance','Z02','Metal'),
('RB /F','Z02','Metal'),
('EA','Z09',''),
('BUC/E','Z03','Soudure'),
('GM','Z04','Metal'),
('E Long','Z03','Soudure'),
('DRSC','Z03','Soudure'),
('E Long','Z04','Soudure'),
('U','Z03','Soudure'),
('OXM /D','Z02','Metal'),
('BA Allongée','Z09',''),
('RB-â','Z02','Metal'),
('RB','Z02','Metal'),
('EPT/F','Z02','Metal'),
('BA','Z09',''),
('Y','Z02','Soudure'),
('SI/SCVE','Z03','Soudure'),
('R.A.S','Z02',''),
('E Long','Z02','Soudure'),
('Diam HT (-)/D','Z02','Metal'),
('Effet De Toil (B1)','Z04','Metal'),
('PRC Int','Z02','Soudure'),
('BU/EY','Z03','Soudure'),
('Hauteur Cord In','Z02','Soudure'),
('BU','Z04','Soudure'),
('HTC Int','Z02','Metal'),
('SCVE','Z09','Soudure'),
('DDB','Z05',''),
('DL','Z04','Soudure'),
('Diam HT (+)/F','Z02','Metal'),
('FT','Z04','Metal'),
('SD Long Ext','Z04','Soudure'),
('FT','Z05',''),
('Diam HT (+)/D','Z02','Metal'),
('Rep > Diam/F','Z02','Soudure'),
('AMC/D','Z02','Metal'),
('F','Z03','Soudure'),
('SCVE','Z02','Soudure'),
('GM','Z02','Metal'),
('F','Z04','Soudure'),
('N.D','Z04','Metal'),
('EY','Z03','Soudure'),
('AN','Z09',''),
('MB Int','Z02','Metal'),
('Rep > Diam','Z04','Soudure'),
('Enfoncement Ext','Z02','Metal'),
('BAC','Z04','Soudure'),
('C','Z09',''),
('BA','Z04','Soudure'),
('FT','Z02','Metal'),
('Ouver Tole','Z02','Metal'),
('Rep > Diam','Z03','Soudure'),
('AA Allongée','Z09',''),
('ND/D','Z02','Metal'),
('ND/Rep','Z02','Metal'),
('Long','Z02','Metal'),
('Arach Sur Rive','Z02','Metal'),
('DT','Z02','Metal'),
('Effet De Toil (B2)','Z02','Metal'),
('SD','Z02','Soudure'),
('E','Z02','Soudure'),
('HTC Int','Z04','Metal'),
('Test(1)','Z02','Metal'),
('BU/Y','Z03','Soudure'),
('N.D','Z02','Metal'),
('Diam HT (-)','Z02','Metal'),
('SCOPE','Z05',''),
('Y','Z03','Soudure'),
('Hauteur Cord Ex','Z04','Soudure'),
('SCVE','Z04','Soudure'),
('Serie DF','Z02','Soudure'),
('BAC/EY','Z03','Soudure'),
('DDB','Z02','Metal'),
('SD Ok','Z03','Soudure'),
('SP','Z03','Soudure'),
('SI','Z03','Soudure'),
('Y','Z04','Soudure'),
('PRC','Z03','Soudure'),
('BAC','Z09',''),
('ND','Z02','Metal'),
('MM Int','Z02','Metal'),
('DRSC','Z04','Soudure'),
('BA/EY','Z03','Soudure'),
('FINAL','Z05',''),
('DL','Z09',''),
('Deformation','Z02','Metal'),
('AMC /F','Z02','Metal'),
('F Int','Z02','Soudure'),
('SCVXE','Z02','Soudure'),
('BA/Y','Z03','Soudure'),
('AAC','Z09','Soudure'),
('D','Z10','Soudure'),
('F','Z10','Soudure'),
('CF','Z10','Soudure'),
('AMC','Z10','Soudure'),
('ND','Z10','Soudure'),
('OVAL','Z10','Soudure'),
('ENFONC','Z10','Soudure'),
('Diam HT','Z10','Soudure'),
('FT','Z10','Soudure'),
('MM Int','Z10','Soudure'),
('MM Ext','Z10','Soudure'),
('MB','Z10','Soudure'),
('Série Déf','Z10','Soudure'),
('SCVE','Z10','Soudure'),
('SCVXE','Z10','Soudure')

        ");
    }
}
